<?php
session_start();
include 'db_connection.php';

// التحقق من إرسال النموذج
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // التحقق من وجود البيانات المطلوبة
    if (
        isset($_POST['product_id']) && 
        isset($_POST['rating']) && 
        isset($_POST['comment']) && 
        isset($_POST['name']) && 
        isset($_POST['email'])
    ) {
        $product_id = $_POST['product_id'];
        $rating = $_POST['rating'];
        $comment = $_POST['comment'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        
        // التحقق من وجود المستخدم أو إنشاء مستخدم جديد
        $user_query = "SELECT user_id FROM users WHERE email = ? LIMIT 1";
        $user_stmt = $conn->prepare($user_query);
        $user_stmt->bind_param("s", $email);
        $user_stmt->execute();
        $user_result = $user_stmt->get_result();
        
        if ($user_result->num_rows > 0) {
            // المستخدم موجود بالفعل
            $user = $user_result->fetch_assoc();
            $user_id = $user['user_id'];
        } else {
            // إنشاء مستخدم جديد
            $insert_user = "INSERT INTO users (username, email, registration_date) VALUES (?, ?, NOW())";
            $insert_stmt = $conn->prepare($insert_user);
            $insert_stmt->bind_param("ss", $name, $email);
            $insert_stmt->execute();
            $user_id = $conn->insert_id;
        }
        
        // إضافة المراجعة
        $insert_review = "INSERT INTO reviews (product_id, user_id, rating, comment, created_at) VALUES (?, ?, ?, ?, NOW())";
        $review_stmt = $conn->prepare($insert_review);
        $review_stmt->bind_param("iiis", $product_id, $user_id, $rating, $comment);
        
        if ($review_stmt->execute()) {
            // تحديث متوسط تقييم المنتج
            $update_rating = "UPDATE products SET 
                              rating = (SELECT AVG(rating) FROM reviews WHERE product_id = ?),
                              reviews_count = (SELECT COUNT(*) FROM reviews WHERE product_id = ?)
                              WHERE product_id = ?";
            $update_stmt = $conn->prepare($update_rating);
            $update_stmt->bind_param("iii", $product_id, $product_id, $product_id);
            $update_stmt->execute();
            
            // إعادة التوجيه إلى صفحة المنتج مع رسالة نجاح
            header("Location: Detils.php?id=$product_id&success=1");
            exit;
        } else {
            // إعادة التوجيه إلى صفحة المنتج مع رسالة خطأ
            header("Location: Detils.php?id=$product_id&error=1");
            exit;
        }
    } else {
        // بيانات غير مكتملة
        header("Location: index.php");
        exit;
    }
} else {
    // طريقة طلب غير صحيحة
    header("Location: index.php");
    exit;
}