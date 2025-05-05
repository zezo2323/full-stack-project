<?php
header('Content-Type: application/json');

// Database Connection Class
class Database {
    private $host = 'localhost';
    private $db_name = 'database_schema_final';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("SET NAMES utf8mb4");
        } catch (PDOException $e) {
            error_log('Database connection failed: ' . $e->getMessage());
            return false;
        }
        return $this->conn;
    }

    // ... [keep other database methods the same] ...
}

$db = new Database();

// Handle Requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    // Create uploads directory if it doesn't exist
    if (!file_exists('uploads') && !mkdir('uploads', 0755, true)) {
        echo json_encode(['success' => false, 'message' => 'Failed to create uploads directory']);
        exit;
    }

    switch ($action) {
        // ... [keep other cases the same until add_product] ...

        case 'add_product':
            $name = $_POST['name'] ?? '';
            $category_id = $_POST['category_id'] ?? 0;
            $price = $_POST['price'] ?? 0;
            $old_price = $_POST['old_price'] ?? null;
            $stock_quantity = $_POST['stock_quantity'] ?? 0;
            $rating = $_POST['rating'] ?? 0;
            $description = $_POST['description'] ?? '';
            $tags = $_POST['tags'] ?? '';
            $badge_id = !empty($_POST['badge_id']) ? $_POST['badge_id'] : null;
            $is_featured = isset($_POST['is_featured']) ? 1 : 0;
            $is_popular = isset($_POST['is_popular']) ? 1 : 0;
            $is_new = isset($_POST['is_new']) ? 1 : 0;
            $is_arrival = isset($_POST['is_arrival']) ? 1 : 0;
            $is_hot = isset($_POST['is_hot']) ? 1 : 0;
            $is_trendy = isset($_POST['is_trendy']) ? 1 : 0;

            $image = $_FILES['image'] ?? null;
            
            // Validate required fields
            if (empty($name) || empty($category_id) || empty($price) || empty($stock_quantity)) {
                echo json_encode(['success' => false, 'message' => 'All required fields must be filled']);
                exit;
            }

            if (!$image || $image['error'] !== UPLOAD_ERR_OK) {
                echo json_encode(['success' => false, 'message' => 'Product image is required']);
                exit;
            }

            // Validate image
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($image['type'], $allowed_types)) {
                echo json_encode(['success' => false, 'message' => 'Only JPG, PNG, and GIF images are allowed']);
                exit;
            }

            // Generate unique filename
            $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
            $image_url = 'uploads/' . uniqid() . '.' . $extension;

            if (move_uploaded_file($image['tmp_name'], $image_url)) {
                try {
                    $db->insert("INSERT INTO products (name, category_id, price, old_price, stock_quantity, rating, description, image_url_default, tags, badge_id, is_featured, is_popular, is_new, is_arrival, is_hot, is_trendy) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
                        $name, $category_id, $price, $old_price, $stock_quantity, $rating, $description, $image_url, $tags, $badge_id, $is_featured, $is_popular, $is_new, $is_arrival, $is_hot, $is_trendy
                    ]);
                    echo json_encode(['success' => true, 'message' => 'Product added successfully']);
                } catch (Exception $e) {
                    error_log('Database error: ' . $e->getMessage());
                    echo json_encode(['success' => false, 'message' => 'Database error occurred']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to upload image']);
            }
            break;

        // ... [keep other cases the same] ...

        case 'add_offer':
            $title = $_POST['title'] ?? '';
            $discount = $_POST['discount'] ?? 0;
            $product_id = !empty($_POST['product_id']) ? $_POST['product_id'] : null;
            $description = $_POST['description'] ?? '';
            $start_date = $_POST['start_date'] ?? date('Y-m-d');
            $end_date = $_POST['end_date'] ?? date('Y-m-d', strtotime('+7 days'));

            $image = $_FILES['image'] ?? null;
            
            // Validate required fields
            if (empty($title) || empty($discount)) {
                echo json_encode(['success' => false, 'message' => 'Title and discount are required']);
                exit;
            }

            if (!$image || $image['error'] !== UPLOAD_ERR_OK) {
                echo json_encode(['success' => false, 'message' => 'Offer image is required']);
                exit;
            }

            // Generate unique filename
            $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
            $image_url = 'uploads/' . uniqid() . '.' . $extension;

            if (move_uploaded_file($image['tmp_name'], $image_url)) {
                try {
                    $db->insert("INSERT INTO deals (title, discount_value, image_url, description, product_id, start_date, end_date, target_type, target_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", [
                        $title, $discount, $image_url, $description, $product_id, $start_date, $end_date, 'product', $product_id
                    ]);
                    echo json_encode(['success' => true, 'message' => 'Offer added successfully']);
                } catch (Exception $e) {
                    error_log('Database error: ' . $e->getMessage());
                    echo json_encode(['success' => false, 'message' => 'Database error occurred']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to upload image']);
            }
            break;

        // ... [keep other cases the same] ...
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>