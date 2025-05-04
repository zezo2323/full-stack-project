<?php
// استيراد ملف التكوين الرئيسي
require_once '../login/config.php';

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['session_token'])) {
        $token = $_COOKIE['session_token'];
        $db = Database::getInstance();
        
        $session = $db->fetchOne(
            "SELECT * FROM sessions WHERE session_token = ? AND expires_at > NOW()",
            [$token]
        );
        
        if ($session) {
            if ($session['user_id']) {
                $user = $db->fetchOne(
                    "SELECT * FROM users WHERE id = ?",
                    [$session['user_id']]
                );
                
                if ($user) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['is_admin'] = false;
                    $_SESSION['username'] = $user['username'];
                }
            } elseif ($session['admin_id']) {
                
                $admin = $db->fetchOne(
                    "SELECT * FROM admins WHERE id = ?",
                    [$session['admin_id']]
                );
                
                if ($admin) {
                    $_SESSION['user_id'] = $admin['id'];
                    $_SESSION['is_admin'] = true;
                    $_SESSION['username'] = $admin['full_name'];
                }
            }
        }
    }
    
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login/Login1.html");
        exit;
    }
}

// التحقق من أن المستخدم هو مشرف
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: ../index.php");
    exit;
}
?>