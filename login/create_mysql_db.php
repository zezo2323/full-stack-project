<?php

$host = 'localhost';
$username = 'root';
$password = '';

try {
    $conn = new mysqli($host, $username, $password);
    
    if ($conn->connect_error) {
        die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
    }
    
    $sql = file_get_contents(__DIR__ . '/ecommerce_db.sql');
    
    if ($conn->multi_query($sql)) {
        echo "تم إنشاء قاعدة البيانات وجداولها بنجاح!\n";
        
        do {
            if ($result = $conn->store_result()) {
                $result->free();
            }
        } while ($conn->more_results() && $conn->next_result());
    } else {
        echo "حدث خطأ أثناء إنشاء قاعدة البيانات: " . $conn->error . "\n";
    }
    
    $conn->close();
    
} catch (Exception $e) {
    echo "حدث خطأ أثناء إنشاء قاعدة البيانات: " . $e->getMessage() . "\n";
}
?>
