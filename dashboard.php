<?php
require_once 'config.php';

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
        header("Location: ../Login1.html");
        exit;
    }
}

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
    header("Location: logout.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            padding: 30px;
            margin-top: 20px;
        }

        h1 {
            color: #006400;
            margin-bottom: 20px;
            text-align: center;
        }

        .user-info {
            margin-bottom: 30px;
        }

        .user-info p {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .user-info strong {
            color: #006400;
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
        <h1>Welcome to Your Dashboard</h1>
        
        <div class="user-info">
            <?php if ($isAdmin && $userData['profile_picture']): ?>
                <img src="../<?php echo htmlspecialchars($userData['profile_picture']); ?>" alt="Profile Picture" class="profile-picture">
            <?php endif; ?>
            
            <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($userData['email']); ?></p>
            <p><strong>Account Type:</strong> <?php echo $isAdmin ? 'Admin' : 'Regular User'; ?></p>
            
            <?php if ($isAdmin): ?>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($userData['phone']); ?></p>
                <p><strong>City:</strong> <?php echo htmlspecialchars($userData['city']); ?></p>
                <p><strong>Age:</strong> <?php echo htmlspecialchars($userData['age']); ?></p>
                <p><strong>Gender:</strong> <?php echo htmlspecialchars($userData['gender']); ?></p>
            <?php endif; ?>
            
            <p><strong>Registration Date:</strong> <?php echo htmlspecialchars($userData['registration_date']); ?></p>
            <?php if ($userData['last_login']): ?>
                <p><strong>Last Login:</strong> <?php echo htmlspecialchars($userData['last_login']); ?></p>
            <?php endif; ?>
        </div>
        
        <a href="logout.php"><button class="logout-btn">Logout</button></a>
    </div>
</body>
</html>
