<?php
include 'db_connection.php';

// الحصول على استعلام البحث
$query = isset($_GET['query']) ? trim($_GET['query']) : '';

if (empty($query)) {
    echo json_encode([]);
    exit;
}

// استعلام البحث في قاعدة البيانات للحصول على اقتراحات
$suggestionsQuery = "SELECT name FROM products 
                    WHERE name LIKE ? 
                    OR tags LIKE ? 
                    LIMIT 10";

$stmt = $conn->prepare($suggestionsQuery);
$searchTerm = "%{$query}%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$suggestions = [];
while ($row = $result->fetch_assoc()) {
    $suggestions[] = $row['name'];
}

// إرجاع النتائج بتنسيق JSON
header('Content-Type: application/json');
echo json_encode($suggestions);
?>