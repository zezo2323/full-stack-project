<?php
// بدء الجلسة
session_start();

// عرض معلومات الجلسة
echo "<h2>Session Information</h2>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

// عرض معلومات ملفات تعريف الارتباط
echo "<h2>Cookie Information</h2>";
echo "<pre>";
print_r($_COOKIE);
echo "</pre>";

// التحقق من وجود جلسة مستخدم
if (isset($_SESSION['user_id'])) {
    echo "<p style='color:green'>User is logged in with ID: " . $_SESSION['user_id'] . "</p>";
    
    // التحقق من نوع المستخدم
    if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
        echo "<p>User is an admin</p>";
        echo "<p>Admin should be redirected to: <a href='Admin Dashboard/dashboard.php'>Admin Dashboard</a></p>";
    } else {
        echo "<p>User is a regular user</p>";
        echo "<p>User should be redirected to: <a href='user_profile.php'>User Profile</a></p>";
    }
} else {
    echo "<p style='color:red'>No user is logged in</p>";
    echo "<p>User should be redirected to: <a href='login/Login1.html'>Login Page</a></p>";
}

// عرض معلومات PHP
echo "<h2>PHP Information</h2>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Session Save Path: " . session_save_path() . "</p>";
echo "<p>Session Name: " . session_name() . "</p>";
echo "<p>Session ID: " . session_id() . "</p>";

// التحقق من إعدادات الجلسة
echo "<h2>Session Settings</h2>";
echo "<pre>";
print_r(ini_get_all('session'));
echo "</pre>";
?>