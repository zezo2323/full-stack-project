<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['name']) ? sanitize($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitize($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirmPassword = isset($_POST['confirm-password']) ? $_POST['confirm-password'] : '';
    
    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        $error = "يرجى ملء جميع الحقول المطلوبة";
        header("Location: ../user_register.html?error=" . urlencode($error));
        exit;
    }
    
    if ($password !== $confirmPassword) {
        $error = "كلمتا المرور غير متطابقتين";
        header("Location: ../user_register.html?error=" . urlencode($error));
        exit;
    }
    
    if (!isValidEmail($email)) {
        $error = "يرجى إدخال بريد إلكتروني صحيح";
        header("Location: ../user_register.html?error=" . urlencode($error));
        exit;
    }
    
    if (strlen($password) < 6) {
        $error = "يجب أن تكون كلمة المرور 6 أحرف على الأقل";
        header("Location: ../user_register.html?error=" . urlencode($error));
        exit;
    }
    
    $db = Database::getInstance();
    
    try {
        $existingUser = $db->fetchOne(
            "SELECT id FROM users WHERE username = ? OR email = ?",
            [$username, $email]
        );
        
        if ($existingUser) {
            $error = "اسم المستخدم أو البريد الإلكتروني مستخدم بالفعل";
            header("Location: ../user_register.html?error=" . urlencode($error));
            exit;
        }
        
        $hashedPassword = hashPassword($password);
        
        $userId = $db->insert(
            "INSERT INTO users (username, email, password) VALUES (?, ?, ?)",
            [$username, $email, $hashedPassword]
        );
        
        if ($userId) {
            $_SESSION['user_id'] = $userId;
            $_SESSION['is_admin'] = false;
            $_SESSION['username'] = $username;
            $token = generateSessionToken();
            $ip = $_SERVER['REMOTE_ADDR'];
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            $expiresAt = date('Y-m-d H:i:s', strtotime('+30 days'));
            
            $db->insert(
                "INSERT INTO sessions (user_id, session_token, ip_address, user_agent, expires_at) 
                 VALUES (?, ?, ?, ?, ?)",
                [$userId, $token, $ip, $userAgent, $expiresAt]
            );
            
            setcookie('session_token', $token, time() + 60 * 60 * 24 * 30, '/', '', false, true);
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "حدث خطأ أثناء إنشاء الحساب. يرجى المحاولة مرة أخرى";
            header("Location: ../user_register.html?error=" . urlencode($error));
            exit;
        }
    } catch (mysqli_sql_exception $e) {
        error_log("Error during user registration: " . $e->getMessage());
        $error = "حدث خطأ فني أثناء إنشاء الحساب. يرجى المحاولة مرة أخرى لاحقاً.";
        header("Location: ../user_register.html?error=" . urlencode($error));
        exit;
    }
} else {
    header("Location: ../user_register.html");
    exit;
}
?>
