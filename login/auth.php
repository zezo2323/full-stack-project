<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'config.php';

$mode = isset($_GET['mode']) ? $_GET['mode'] : 'choose';
$error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
$success = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : '';

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    setcookie('session_token', '', time() - 3600, '/', '', false, true);
    header("Location: /login/auth.php?mode=login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login_submit'])) {
        $username = isset($_POST['username']) ? sanitize($_POST['username']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        if (empty($username) || empty($password)) {
            $error = "All fields are required";
            header("Location: /login/auth.php?mode=login&error=" . urlencode($error));
            exit;
        }

        $db = Database::getInstance();

        $user = $db->fetchOne(
            "SELECT * FROM users WHERE (username = ? OR email = ?)",
            [$username, $username]
        );

        $admin = $db->fetchOne(
            "SELECT * FROM admins WHERE (full_name = ? OR email = ?)",
            [$username, $username]
        );

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['is_admin'] = false;
            $_SESSION['username'] = $user['username'];
            $token = generateSessionToken();
            $ip = $_SERVER['REMOTE_ADDR'];
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            $expiresAt = date('Y-m-d H:i:s', strtotime('+30 days'));

            $db->insert(
                "INSERT INTO sessions (user_id, session_token, ip_address, user_agent, expires_at) VALUES (?, ?, ?, ?, ?)",
                [$user['user_id'], $token, $ip, $userAgent, $expiresAt]
            );

            $db->update(
                "UPDATE users SET last_login = NOW() WHERE user_id = ?",
                [$user['user_id']]
            );

            setcookie('session_token', $token, time() + 60 * 60 * 24 * 30, '/', '', false, true);
            header("Location: /index.php");
            exit;
        } elseif ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['user_id'] = $admin['admin_id'];
            $_SESSION['is_admin'] = true;
            $_SESSION['username'] = $admin['full_name'];
            $token = generateSessionToken();
            $ip = $_SERVER['REMOTE_ADDR'];
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            $expiresAt = date('Y-m-d H:i:s', strtotime('+30 days'));

            $db->insert(
                "INSERT INTO sessions (admin_id, session_token, ip_address, user_agent, expires_at) VALUES (?, ?, ?, ?, ?)",
                [$admin['admin_id'], $token, $ip, $userAgent, $expiresAt]
            );

            $db->update(
                "UPDATE admins SET last_login = NOW() WHERE admin_id = ?",
                [$admin['admin_id']]
            );

            setcookie('session_token', $token, time() + 60 * 60 * 24 * 30, '/', '', false, true);
            header("Location: /index.php");
            exit;
        } else {
            $error = "Invalid username/email or password";
            header("Location: /login/auth.php?mode=login&error=" . urlencode($error));
            exit;
        }
    } elseif (isset($_POST['register_user_submit'])) {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $error = "Invalid CSRF token";
            header("Location: ?mode=register_user&error=" . urlencode($error));
            exit;
        }

        $username = isset($_POST['username']) ? sanitize($_POST['username']) : '';
        $email = isset($_POST['email']) ? sanitize($_POST['email']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $confirmPassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

        if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
            $error = "All fields are required";
            header("Location: ?mode=register_user&error=" . urlencode($error));
            exit;
        }

        if (!isValidEmail($email)) {
            $error = "Invalid email address";
            header("Location: ?mode=register_user&error=" . urlencode($error));
            exit;
        }

        if (strlen($password) < 6) {
            $error = "Password must be at least 6 characters";
            header("Location: ?mode=register_user&error=" . urlencode($error));
            exit;
        }

        if ($password !== $confirmPassword) {
            $error = "Passwords do not match";
            header("Location: ?mode=register_user&error=" . urlencode($error));
            exit;
        }

        $db = Database::getInstance();
        $existingUser = $db->fetchOne(
            "SELECT * FROM users WHERE username = ? OR email = ?",
            [$username, $email]
        );

        if ($existingUser) {
            $error = "Username or email already in use";
            header("Location: ?mode=register_user&error=" . urlencode($error));
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $registrationDate = date('Y-m-d H:i:s');

        try {
            $userId = $db->insert(
                "INSERT INTO users (username, email, password, registration_date) VALUES (?, ?, ?, ?)",
                [$username, $email, $hashedPassword, $registrationDate]
            );

            if ($userId) {
                $success = "Registration successful! Please log in.";
                header("Location: /login/auth.php?mode=login&success=" . urlencode($success));
                exit;
            } else {
                $error = "Error creating account. Please try again";
                header("Location: ?mode=register_user&error=" . urlencode($error));
                exit;
            }
        } catch (Exception $e) {
            error_log("Registration error: " . $e->getMessage());
            $error = "Error creating account. Please try again";
            header("Location: ?mode=register_user&error=" . urlencode($error));
            exit;
        }
    } elseif (isset($_POST['register_admin_submit'])) {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $error = "Invalid CSRF token";
            header("Location: ?mode=register_admin&error=" . urlencode($error));
            exit;
        }

        $name = isset($_POST['name']) ? sanitize($_POST['name']) : '';
        $email = isset($_POST['email']) ? sanitize($_POST['email']) : '';
        $phone = isset($_POST['phone']) ? sanitize($_POST['phone']) : '';
        $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
        $age = isset($_POST['age']) ? (int)$_POST['age'] : 0;
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
        $city = isset($_POST['city']) ? sanitize($_POST['city']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $confirmPassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
        $profileImage = isset($_FILES['profile_image']) ? $_FILES['profile_image'] : null;

        if (empty($name) || empty($email) || empty($phone) || empty($birthdate) || $age < 18 || empty($gender) || empty($city) || empty($password) || empty($confirmPassword)) {
            $error = "All fields are required and age must be 18 or older";
            header("Location: ?mode=register_admin&error=" . urlencode($error));
            exit;
        }

        if (!isValidEmail($email)) {
            $error = "Invalid email address";
            header("Location: ?mode=register_admin&error=" . urlencode($error));
            exit;
        }

        if (strlen($password) < 6) {
            $error = "Password must be at least 6 characters";
            header("Location: ?mode=register_admin&error=" . urlencode($error));
            exit;
        }

        if ($password !== $confirmPassword) {
            $error = "Passwords do not match";
            header("Location: ?mode=register_admin&error=" . urlencode($error));
            exit;
        }

        $db = Database::getInstance();
        $existingAdmin = $db->fetchOne(
            "SELECT * FROM admins WHERE email = ?",
            [$email]
        );

        if ($existingAdmin) {
            $error = "Email already in use";
            header("Location: ?mode=register_admin&error=" . urlencode($error));
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $registrationDate = date('Y-m-d H:i:s');
        $imagePath = 'uploads/default.jpg';

        if ($profileImage && $profileImage['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $imageFileType = strtolower(pathinfo($profileImage['name'], PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($imageFileType, $allowedTypes)) {
                $maxFileSize = 5 * 1024 * 1024; // 5MB
                if ($profileImage['size'] > $maxFileSize) {
                    $error = "Image file is too large. Maximum size is 5MB.";
                    header("Location: ?mode=register_admin&error=" . urlencode($error));
                    exit;
                }

                $newImageName = time() . '_' . rand(1000, 9999) . '.' . $imageFileType;
                $targetFile = $uploadDir . $newImageName;
                if (move_uploaded_file($profileImage['tmp_name'], $targetFile)) {
                    $imagePath = $targetFile;
                } else {
                    $error = "Error uploading image. Please check folder permissions.";
                    header("Location: ?mode=register_admin&error=" . urlencode($error));
                    exit;
                }
            } else {
                $error = "Only JPG, JPEG, PNG, and GIF files are allowed";
                header("Location: ?mode=register_admin&error=" . urlencode($error));
                exit;
            }
        }

        try {
            $adminId = $db->insert(
                "INSERT INTO admins (full_name, email, phone, birthdate, age, gender, city, password, registration_date, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                [$name, $email, $phone, $birthdate, $age, $gender, $city, $hashedPassword, $registrationDate, $imagePath]
            );

            if ($adminId) {
                $success = "Admin registration successful! Please log in.";
                header("Location: /login/auth.php?mode=login&success=" . urlencode($success));
                exit;
            } else {
                $error = "Error creating admin account. Please try again";
                header("Location: ?mode=register_admin&error=" . urlencode($error));
                exit;
            }
        } catch (Exception $e) {
            error_log("Admin registration error: " . $e->getMessage());
            $error = "Error creating admin account. Please try again";
            header("Location: ?mode=register_admin&error=" . urlencode($error));
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XX E-commerce Authentication</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }
        h2 {
            text-align: center;
            color: #008000;
            margin-bottom: 20px;
        }
        .welcome-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }
        .tabs {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .tab-btn {
            background: none;
            border: none;
            color: #006400;
            cursor: pointer;
            padding: 10px;
            font-size: 16px;
        }
        .tab-btn.active {
            border-bottom: 2px solid #006400;
        }
        .form-section {
            display: none;
        }
        .form-section.active {
            display: block;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn {
            background-color: #006400;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #004d00;
        }
        .error-message {
            background-color: #ffebee;
            color: #c62828;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }
        .login-link {
            text-align: center;
            margin-top: 10px;
        }
        .login-link a {
            color: #008000;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>XX E-commerce Authentication</h2>

        <?php if (isset($_SESSION['user_id']) && isset($_SESSION['username'])): ?>
            <div class="welcome-message">مرحباً يا <?php echo htmlspecialchars($_SESSION['username']); ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success-message"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="login-link">
                <a href="/login/auth.php?action=logout">Logout</a>
            </div>
        <?php endif; ?>

        <div class="tabs">
            <button class="tab-btn <?php echo $mode === 'choose' || $mode === 'login' ? 'active' : ''; ?>" onclick="showSection('login')">Login</button>
            <button class="tab-btn <?php echo $mode === 'choose' ? 'active' : ''; ?>" onclick="showSection('choose')">Register</button>
        </div>

        <div id="login-section" class="form-section <?php echo $mode === 'login' ? 'active' : ''; ?>">
            <form method="POST" onsubmit="return validateLogin()">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generateCsrfToken()); ?>">
                <div class="form-group">
                    <label for="login-username">Username or Email</label>
                    <input type="text" id="login-username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" name="password" required>
                </div>
                <button type="submit" name="login_submit" class="btn">Login</button>
            </form>
            <div class="login-link">Forgot Password? <a href="#">Click here</a></div>
        </div>

        <div id="choose-section" class="form-section <?php echo $mode === 'choose' ? 'active' : ''; ?>">
            <button onclick="showSection('register_user')" class="btn" style="margin-bottom: 10px;">Register as User</button>
            <button onclick="showSection('register_admin')" class="btn">Register as Admin</button>
        </div>

        <div id="register-user-section" class="form-section <?php echo $mode === 'register_user' ? 'active' : ''; ?>">
            <form method="POST" onsubmit="return validateRegisterUser()">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generateCsrfToken()); ?>">
                <div class="form-group">
                    <label for="reg-user-username">Username</label>
                    <input type="text" id="reg-user-username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="reg-user-email">Email</label>
                    <input type="email" id="reg-user-email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="reg-user-password">Password</label>
                    <input type="password" id="reg-user-password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="reg-user-confirm-password">Confirm Password</label>
                    <input type="password" id="reg-user-confirm-password" name="confirm_password" required>
                </div>
                <button type="submit" name="register_user_submit" class="btn">Register User</button>
            </form>
        </div>

        <div id="register-admin-section" class="form-section <?php echo $mode === 'register_admin' ? 'active' : ''; ?>">
            <form method="POST" enctype="multipart/form-data" onsubmit="return validateRegisterAdmin()">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generateCsrfToken()); ?>">
                <div class="form-group">
                    <label for="reg-admin-name">Full Name</label>
                    <input type="text" id="reg-admin-name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="reg-admin-email">Email</label>
                    <input type="email" id="reg-admin-email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="reg-admin-phone">Phone</label>
                    <input type="tel" id="reg-admin-phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="reg-admin-birthdate">Birthdate</label>
                    <input type="date" id="reg-admin-birthdate" name="birthdate" required>
                </div>
                <div class="form-group">
                    <label for="reg-admin-age">Age</label>
                    <input type="number" id="reg-admin-age" name="age" min="18" required>
                </div>
                <div class="form-group">
                    <label for="reg-admin-gender">Gender</label>
                    <select id="reg-admin-gender" name="gender" required>
                        <option value="">-- Select --</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="reg-admin-city">City</label>
                    <input type="text" id="reg-admin-city" name="city" required>
                </div>
                <div class="form-group">
                    <label for="reg-admin-password">Password</label>
                    <input type="password" id="reg-admin-password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="reg-admin-confirm-password">Confirm Password</label>
                    <input type="password" id="reg-admin-confirm-password" name="confirm_password" required>
                </div>
                <div class="form-group">
                    <label for="profile_image">Profile Image</label>
                    <input type="file" id="profile_image" name="profile_image" accept="image/*">
                </div>
                <button type="submit" name="register_admin_submit" class="btn">Register Admin</button>
            </form>
        </div>
    </div>

    <script>
        function showSection(mode) {
            const sections = document.querySelectorAll('.form-section');
            sections.forEach(section => section.classList.remove('active'));

            if (mode === 'login') document.getElementById('login-section').classList.add('active');
            else if (mode === 'choose') document.getElementById('choose-section').classList.add('active');
            else if (mode === 'register_user') document.getElementById('register-user-section').classList.add('active');
            else if (mode === 'register_admin') document.getElementById('register-admin-section').classList.add('active');

            window.history.pushState({}, '', '/login/auth.php?mode=' + mode);
        }

        function validateLogin() {
            const username = document.getElementById('login-username').value;
            const password = document.getElementById('login-password').value;
            if (!username || !password) {
                alert('All fields are required');
                return false;
            }
            return true;
        }

        function validateRegisterUser() {
            const password = document.getElementById('reg-user-password').value;
            const confirmPassword = document.getElementById('reg-user-confirm-password').value;
            if (password.length < 6) {
                alert('Password must be at least 6 characters');
                return false;
            }
            if (password !== confirmPassword) {
                alert('Passwords do not match');
                return false;
            }
            return true;
        }

        function validateRegisterAdmin() {
            const age = document.getElementById('reg-admin-age').value;
            const password = document.getElementById('reg-admin-password').value;
            const confirmPassword = document.getElementById('reg-admin-confirm-password').value;
            if (age < 18) {
                alert('Age must be 18 or older');
                return false;
            }
            if (password.length < 6) {
                alert('Password must be at least 6 characters');
                return false;
            }
            if (password !== confirmPassword) {
                alert('Passwords do not match');
                return false;
            }
            return true;
        }

        window.onload = function() {
            showSection('<?php echo $mode; ?>');
        };
    </script>
</body>
</html>