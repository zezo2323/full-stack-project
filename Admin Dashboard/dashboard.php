<?php
require_once 'config.php';

$userId = $_SESSION['user_id'];
$isAdmin = $_SESSION['is_admin'];
$username = $_SESSION['username'];

$db = Database::getInstance();
$userData = null;

if ($isAdmin) {
    $userData = $db->fetchOne(
        "SELECT * FROM admins WHERE id = ?",
        [$userId]
    );
} else {
    $userData = $db->fetchOne(
        "SELECT * FROM users WHERE id = ?",
        [$userId]
    );
}

if (!$userData) {
    header("Location: ../login/logout.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>
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
        
        .user-info {
            margin-top: 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        
        .user-info p {
            margin: 10px 0;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 20px;
            display: block;
            border: 3px solid #006400;
        }

        .logout-btn {
            background-color: #006400;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 20px;
            display: block;
            width: 100%;
            max-width: 200px;
            margin-left: auto;
            margin-right: auto;
        }

        .logout-btn:hover {
            background-color: #004d00;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>مرحباً بك في لوحة التحكم</h1>
        
        <div class="user-info">
            <?php if ($isAdmin && isset($userData['profile_picture']) && $userData['profile_picture']): ?>
                <img src="../<?php echo htmlspecialchars($userData['profile_picture']); ?>" alt="صورة الملف الشخصي" class="profile-picture">
            <?php endif; ?>
            
            <p><strong>الاسم:</strong> <?php echo htmlspecialchars($username); ?></p>
            <p><strong>البريد الإلكتروني:</strong> <?php echo htmlspecialchars($userData['email']); ?></p>
            
            <?php if (isset($userData['registration_date'])): ?>
                <p><strong>تاريخ التسجيل:</strong> <?php echo htmlspecialchars($userData['registration_date']); ?></p>
            <?php endif; ?>
            
            <?php if (isset($userData['last_login']) && $userData['last_login']): ?>
                <p><strong>آخر تسجيل دخول:</strong> <?php echo htmlspecialchars($userData['last_login']); ?></p>
            <?php endif; ?>
        </div>
        
        <a href="../login/logout.php"><button class="logout-btn">تسجيل الخروج</button></a>
    </div>
</body>
</html>
