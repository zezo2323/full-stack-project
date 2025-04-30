<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? sanitize($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    if (empty($username) || empty($password)) {
        $error = "يرجى إدخال اسم المستخدم وكلمة المرور";
        header("Location: ../Login1.html?error=" . urlencode($error));
        exit;
    }
    $db = Database::getInstance();
    $user = $db->fetchOne(
        "SELECT * FROM users WHERE username = ? OR email = ?",
        [$username, $username]
    );

    if (!$user) {
        $user = $db->fetchOne(
            "SELECT * FROM admins WHERE email = ?",
            [$username]
        );
        
        if ($user) {
            $user['is_admin'] = true;
        }
    } else {
        $user['is_admin'] = false;
    }
    
    if ($user && verifyPassword($password, $user['password'])) {
        if ($user['is_admin']) {
            $db->execute(
                "UPDATE admins SET last_login = CURRENT_TIMESTAMP WHERE id = ?",
                [$user['id']]
            );
        } else {
            $db->execute(
                "UPDATE users SET last_login = CURRENT_TIMESTAMP WHERE id = ?",
                [$user['id']]
            );
        }
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_admin'] = $user['is_admin'];
        $_SESSION['username'] = $user['is_admin'] ? $user['full_name'] : $user['username'];
        
        $token = generateSessionToken();
        $ip = $_SERVER['REMOTE_ADDR'];
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $expiresAt = date('Y-m-d H:i:s', strtotime('+30 days'));
        
        if ($user['is_admin']) {
            $db->insert(
                "INSERT INTO sessions (admin_id, session_token, ip_address, user_agent, expires_at) 
                 VALUES (?, ?, ?, ?, ?)",
                [$user['id'], $token, $ip, $userAgent, $expiresAt]
            );
        } else {
            $db->insert(
                "INSERT INTO sessions (user_id, session_token, ip_address, user_agent, expires_at) 
                 VALUES (?, ?, ?, ?, ?)",
                [$user['id'], $token, $ip, $userAgent, $expiresAt]
            );
        }
        
        setcookie('session_token', $token, time() + 60 * 60 * 24 * 30, '/', '', false, true);
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "اسم المستخدم أو كلمة المرور غير صحيحة";
        header("Location: ../Login1.html?error=" . urlencode($error));
        exit;
    }
} else {
    header("Location: ../Login1.html");
    exit;
}
?>
