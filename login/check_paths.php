<?php
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>فحص المسارات</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>فحص المسارات والروابط</h1>";

$html_files = [
    '../Login1.html',
    '../ChoAcc.html',
    '../user_register.html',
    '../Admin.html'
];

echo "<h2>ملفات HTML:</h2>";
foreach ($html_files as $file) {
    if (file_exists($file)) {
        echo "<p class='success'>✓ الملف $file موجود</p>";
    } else {
        echo "<p class='error'>✗ الملف $file غير موجود</p>";
    }
}

$php_files = [
    'config.php',
    'login.php',
    'user_register.php',
    'admin_register.php',
    'dashboard.php',
    'logout.php'
];

echo "<h2>ملفات PHP:</h2>";
foreach ($php_files as $file) {
    if (file_exists($file)) {
        echo "<p class='success'>✓ الملف $file موجود</p>";
    } else {
        echo "<p class='error'>✗ الملف $file غير موجود</p>";
    }
}

$db_file = __DIR__ . '/../database/ecommerce.db';
echo "<h2>قاعدة البيانات:</h2>";
if (file_exists($db_file)) {
    echo "<p class='success'>✓ قاعدة البيانات موجودة</p>";
    
    try {
        $db = new SQLite3($db_file);
        
        $tables = ['users', 'admins', 'sessions'];
        foreach ($tables as $table) {
            $result = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='$table'");
            if ($result->fetchArray()) {
                echo "<p class='success'>✓ جدول $table موجود</p>";
            } else {
                echo "<p class='error'>✗ جدول $table غير موجود</p>";
            }
        }
    } catch (Exception $e) {
        echo "<p class='error'>✗ خطأ في الاتصال بقاعدة البيانات: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p class='error'>✗ قاعدة البيانات غير موجودة</p>";
}

$uploads_dir = __DIR__ . '/../uploads';
echo "<h2>مجلد التحميلات:</h2>";
if (is_dir($uploads_dir)) {
    echo "<p class='success'>✓ مجلد التحميلات موجود</p>";
    if (is_writable($uploads_dir)) {
        echo "<p class='success'>✓ مجلد التحميلات قابل للكتابة</p>";
    } else {
        echo "<p class='error'>✗ مجلد التحميلات غير قابل للكتابة</p>";
    }
} else {
    echo "<p class='error'>✗ مجلد التحميلات غير موجود</p>";
}

echo "</body></html>";
?>
