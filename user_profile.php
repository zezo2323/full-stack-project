<?php
session_start();
require_once 'login/config.php';

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    header("Location: /login/auth.php?mode=login");
    exit;
}

// التحقق من أن المستخدم ليس مشرفًا
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
    header("Location: /Admin Dashboard/dashboard.php");
    exit;
}

$userId = $_SESSION['user_id'];
$db = Database::getInstance();

// جلب بيانات المستخدم
$userData = $db->fetchOne(
    "SELECT * FROM users WHERE user_id = ?", // تصحيح العمود إلى user_id بدلاً من id
    [$userId]
);

if (!$userData) {
    header("Location: /login/auth.php?action=logout");
    exit;
}

// معالجة تحديث البيانات
$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $errorMessage = "Invalid CSRF token";
    } else {
        $username = isset($_POST['username']) ? sanitize($_POST['username']) : $userData['username'];
        $email = isset($_POST['email']) ? sanitize($_POST['email']) : $userData['email'];
        
        // التحقق من عدم وجود مستخدم آخر بنفس اسم المستخدم أو البريد الإلكتروني
        $existingUser = $db->fetchOne(
            "SELECT * FROM users WHERE (username = ? OR email = ?) AND user_id != ?",
            [$username, $email, $userId]
        );
        
        if ($existingUser) {
            $errorMessage = "Username or email already in use";
        } else {
            $result = $db->update(
                "UPDATE users SET username = ?, email = ? WHERE user_id = ?",
                [$username, $email, $userId]
            );
            
            if ($result) {
                $_SESSION['username'] = $username;
                $userData['username'] = $username;
                $userData['email'] = $email;
                $successMessage = "Profile updated successfully";
            } else {
                $errorMessage = "Error updating profile";
            }
        }
    }
}

// معالجة تغيير كلمة المرور
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $errorMessage = "Invalid CSRF token";
    } else {
        $currentPassword = isset($_POST['current_password']) ? $_POST['current_password'] : '';
        $newPassword = isset($_POST['new_password']) ? $_POST['new_password'] : '';
        $confirmPassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
        
        if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
            $errorMessage = "All password fields are required";
        } elseif ($newPassword !== $confirmPassword) {
            $errorMessage = "New passwords do not match";
        } elseif (strlen($newPassword) < 6) {
            $errorMessage = "New password must be at least 6 characters";
        } elseif (!password_verify($currentPassword, $userData['password'])) { // استخدام password_verify بدلاً من verifyPassword
            $errorMessage = "Current password is incorrect";
        } else {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); // استخدام password_hash بدلاً من hashPassword
            $result = $db->update(
                "UPDATE users SET password = ? WHERE user_id = ?",
                [$hashedPassword, $userId]
            );
            
            if ($result) {
                $successMessage = "Password changed successfully";
            } else {
                $errorMessage = "Error changing password";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #006400;
            text-align: center;
        }
        .tabs {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        .tab {
            padding: 10px 20px;
            cursor: pointer;
            background-color: #f1f1f1;
            margin-right: 5px;
            border-radius: 5px 5px 0 0;
        }
        .tab.active {
            background-color: #006400;
            color: white;
        }
        .tab-content {
            display: none;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 0 0 5px 5px;
        }
        .tab-content.active {
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
        input[type="text"],
        input[type="email"],
        input[type="password"] {
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
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }
        .btn:hover {
            background-color: #004d00;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #006400;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Profile</h1>
        
        <?php if (!empty($successMessage)): ?>
            <div class="success-message"><?php echo htmlspecialchars($successMessage); ?></div>
        <?php endif; ?>
        
        <?php if (!empty($errorMessage)): ?>
            <div class="error-message"><?php echo htmlspecialchars($errorMessage); ?></div>
        <?php endif; ?>
        
        <div class="tabs">
            <div class="tab active" onclick="showTab('profile')">Account Information</div>
            <div class="tab" onclick="showTab('password')">Change Password</div>
        </div>
        
        <div id="profile" class="tab-content active">
            <form method="POST" action="">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generateCsrfToken()); ?>">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($userData['username']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="registration_date">Registration Date</label>
                    <input type="text" id="registration_date" value="<?php echo htmlspecialchars($userData['registration_date']); ?>" readonly>
                </div>
                
                <?php if (isset($userData['last_login']) && $userData['last_login']): ?>
                    <div class="form-group">
                        <label for="last_login">Last Login</label>
                        <input type="text" id="last_login" value="<?php echo htmlspecialchars($userData['last_login']); ?>" readonly>
                    </div>
                <?php endif; ?>
                
                <div class="form-group">
                    <button type="submit" name="update_profile" class="btn">Update Profile</button>
                </div>
            </form>
        </div>
        
        <div id="password" class="tab-content">
            <form method="POST" action="">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generateCsrfToken()); ?>">
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" id="current_password" name="current_password" required>
                </div>
                
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirm New Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                
                <div class="form-group">
                    <button type="submit" name="change_password" class="btn">Change Password</button>
                </div>
            </form>
        </div>
        
        <a href="/index.php" class="back-link">Back to Home</a>
    </div>
    
    <script>
        function showTab(tabId) {
            const tabs = document.querySelectorAll('.tab');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabs.forEach(tab => {
                tab.classList.remove('active');
            });
            
            tabContents.forEach(content => {
                content.classList.remove('active');
            });
            
            document.querySelector(`[onclick="showTab('${tabId}')"]`).classList.add('active');
            document.getElementById(tabId).classList.add('active');
        }
    </script>
</body>
</html>