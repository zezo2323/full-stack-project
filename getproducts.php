<?php
header("Content-Type: application/json");
$conn = new mysqli("localhost", "root", "", "ecommerce");

$type = $_GET['type'] ?? '';

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed"]));
}

$sql = "SELECT p.*, c.name as category_name FROM products p 
        JOIN categories c ON p.category_id = c.id";

if ($type == "featured") {
    $sql .= " WHERE is_featured = 1";
} elseif ($type == "popular") {
    $sql .= " WHERE is_popular = 1";
} elseif ($type == "new") {
    $sql .= " WHERE is_new = 1";
}

$result = $conn->query($sql);
$products = [];

while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);
$conn->close();
?>
