<?php

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = isset($_POST['name']) ? sanitize($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitize($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? sanitize($_POST['phone']) : '';
    $birthdate = isset($_POST['birthdate']) ? sanitize($_POST['birthdate']) : '';
    $age = isset($_POST['age']) ? filter_var(sanitize($_POST['age']), FILTER_VALIDATE_INT) : '';
    $gender = isset($_POST['gender']) ? sanitize($_POST['gender']) : '';
    $city = isset($_POST['city']) ? sanitize($_POST['city']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirmPassword = isset($_POST['confirm-password']) ? $_POST['confirm-password'] : '';
    $profilePicture = isset($_FILES['profile-picture']) ? $_FILES['profile-picture'] : null;

    if (empty($fullName) || empty($email) || empty($phone) || empty($birthdate) || $age === false || empty($gender) || empty($city) || empty($password) || empty($confirmPassword)) {
        $error = "يرجى ملء جميع الحقول المطلوبة بشكل صحيح";
        header("Location: ../Admin.html?error=" . urlencode($error));
        exit;
    }

    if ($password !== $confirmPassword) {
        $error = "كلمتا المرور غير متطابقتين";
        header("Location: ../Admin.html?error=" . urlencode($error));
        exit;
    }

    if (!isValidEmail($email)) {
        $error = "يرجى إدخال بريد إلكتروني صحيح";
        header("Location: ../Admin.html?error=" . urlencode($error));
        exit;
    }

    if (strlen($password) < 6) {
        $error = "يجب أن تكون كلمة المرور 6 أحرف على الأقل";
        header("Location: ../Admin.html?error=" . urlencode($error));
        exit;
    }

    if (!in_array($gender, ['male', 'female'])) {
        $error = "يرجى اختيار نوع الجنس بشكل صحيح";
        header("Location: ../Admin.html?error=" . urlencode($error));
        exit;
    }

    $profilePicturePath = null;
    if ($profilePicture && $profilePicture['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = uniqid() . '_' . basename($profilePicture['name']);
        $targetPath = $uploadDir . $fileName;
        
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($profilePicture['type'], $allowedTypes) && $profilePicture['size'] < 5000000) { // 5MB limit
            if (move_uploaded_file($profilePicture['tmp_name'], $targetPath)) {
                $profilePicturePath = 'uploads/' . $fileName; 
            } else {
                $error = "حدث خطأ أثناء رفع الصورة";
                header("Location: ../Admin.html?error=" . urlencode($error));
                exit;
            }
        } else {
            $error = "نوع الملف غير مسموح به أو حجم الملف كبير جداً";
            header("Location: ../Admin.html?error=" . urlencode($error));
            exit;
        }
    }

    $db = Database::getInstance();

    try {
        $existingAdmin = $db->fetchOne(
            "SELECT id FROM admins WHERE email = ?",
            [$email]
        );

        if ($existingAdmin) {
            $error = "البريد الإلكتروني مستخدم بالفعل";
            header("Location: ../Admin.html?error=" . urlencode($error));
            exit;
        }

        $hashedPassword = hashPassword($password);

        $adminId = $db->insert(
            "INSERT INTO admins (profile_picture, full_name, email, phone, birthdate, age, gender, city, password) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [$profilePicturePath, $fullName, $email, $phone, $birthdate, $age, $gender, $city, $hashedPassword]
        );

        if ($adminId) {
            $_SESSION['user_id'] = $adminId;
            $_SESSION['is_admin'] = true;
            $_SESSION['username'] = $fullName;

            $token = generateSessionToken();
            $ip = $_SERVER['REMOTE_ADDR'];
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            $expiresAt = date('Y-m-d H:i:s', strtotime('+30 days'));

            $db->insert(
                "INSERT INTO sessions (admin_id, session_token, ip_address, user_agent, expires_at) 
                 VALUES (?, ?, ?, ?, ?)",
                [$adminId, $token, $ip, $userAgent, $expiresAt]
            );

            setcookie('session_token', $token, time() + 60 * 60 * 24 * 30, '/', '', false, true);

            header("Location: dashboard.php");
            exit;
        } else {
            $error = "حدث خطأ أثناء إنشاء الحساب. يرجى المحاولة مرة أخرى";
            header("Location: ../Admin.html?error=" . urlencode($error));
            exit;
        }
    } catch (mysqli_sql_exception $e) {
        error_log("Error during admin registration: " . $e->getMessage());
        $error = "حدث خطأ فني أثناء إنشاء الحساب. يرجى المحاولة مرة أخرى لاحقاً.";
        header("Location: ../Admin.html?error=" . urlencode($error));
        exit;
    }
} else {
    header("Location: ../Admin.html");
    exit;
}
?>
