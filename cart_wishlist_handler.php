<?php
session_start();
require_once 'login/config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$userId = $_SESSION['user_id'];
$db = Database::getInstance();

// جلب cart_id و wishlist_id للمستخدم
$cart = $db->fetchOne("SELECT cart_id FROM carts WHERE user_id = ?", [$userId]);
$wishlist = $db->fetchOne("SELECT wishlist_id FROM wishlists WHERE user_id = ?", [$userId]);

if (!$cart || !$wishlist) {
    echo json_encode(['success' => false, 'message' => 'Cart or Wishlist not found']);
    exit;
}

$cartId = $cart['cart_id'];
$wishlistId = $wishlist['wishlist_id'];

$action = isset($_POST['action']) ? $_POST['action'] : '';

switch ($action) {
    case 'add_to_cart':
        $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
        $title = isset($_POST['title']) ? sanitize($_POST['title']) : '';
        $price = isset($_POST['price']) ? (float)$_POST['price'] : 0;
        $image = isset($_POST['image']) ? sanitize($_POST['image']) : '';

        if ($productId <= 0 || empty($title) || $price <= 0 || empty($image)) {
            echo json_encode(['success' => false, 'message' => 'Invalid product data']);
            exit;
        }

        // التحقق مما إذا كان المنتج موجودًا في السلة
        $existingItem = $db->fetchOne("SELECT cart_item_id, quantity FROM cart_items WHERE cart_id = ? AND product_id = ?", [$cartId, $productId]);
        if ($existingItem) {
            $newQuantity = $existingItem['quantity'] + 1;
            $db->update("UPDATE cart_items SET quantity = ? WHERE cart_item_id = ?", [$newQuantity, $existingItem['cart_item_id']]);
        } else {
            $db->insert("INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (?, ?, ?)", [$cartId, $productId, 1]);
        }

        echo json_encode(['success' => true, 'message' => "$title added to cart!"]);
        break;

    case 'add_to_wishlist':
        $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
        $title = isset($_POST['title']) ? sanitize($_POST['title']) : '';
        $price = isset($_POST['price']) ? (float)$_POST['price'] : 0;
        $image = isset($_POST['image']) ? sanitize($_POST['image']) : '';

        if ($productId <= 0 || empty($title) || $price <= 0 || empty($image)) {
            echo json_encode(['success' => false, 'message' => 'Invalid product data']);
            exit;
        }

        // التحقق مما إذا كان المنتج موجودًا في قائمة المفضلة
        $existingItem = $db->fetchOne("SELECT wishlist_item_id FROM wishlist_items WHERE wishlist_id = ? AND product_id = ?", [$wishlistId, $productId]);
        if (!$existingItem) {
            $db->insert("INSERT INTO wishlist_items (wishlist_id, product_id) VALUES (?, ?)", [$wishlistId, $productId]);
            echo json_encode(['success' => true, 'message' => "$title added to wishlist!"]);
        } else {
            echo json_encode(['success' => false, 'message' => "$title already in wishlist!"]);
        }
        break;

    case 'remove_from_cart':
        $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
        if ($productId <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid product ID']);
            exit;
        }

        $db->delete("DELETE FROM cart_items WHERE cart_id = ? AND product_id = ?", [$cartId, $productId]);
        echo json_encode(['success' => true, 'message' => 'Item removed from cart']);
        break;

    case 'remove_from_wishlist':
        $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
        if ($productId <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid product ID']);
            exit;
        }

        $db->delete("DELETE FROM wishlist_items WHERE wishlist_id = ? AND product_id = ?", [$wishlistId, $productId]);
        echo json_encode(['success' => true, 'message' => 'Item removed from wishlist']);
        break;

    case 'get_cart':
        $cartItems = $db->fetchAll(
            "SELECT ci.cart_item_id, ci.product_id, ci.quantity, p.name AS title, p.price, p.image_url_default AS image
             FROM cart_items ci
             JOIN products p ON ci.product_id = p.product_id
             WHERE ci.cart_id = ?",
            [$cartId]
        );

        $total = 0;
        $count = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
            $count += $item['quantity'];
        }

        echo json_encode([
            'success' => true,
            'items' => $cartItems,
            'total' => $total,
            'count' => $count
        ]);
        break;

    case 'get_wishlist':
        $wishlistItems = $db->fetchAll(
            "SELECT wi.wishlist_item_id, wi.product_id, p.name AS title, p.price, p.image_url_default AS image
             FROM wishlist_items wi
             JOIN products p ON wi.product_id = p.product_id
             WHERE wi.wishlist_id = ?",
            [$wishlistId]
        );

        echo json_encode([
            'success' => true,
            'items' => $wishlistItems,
            'count' => count($wishlistItems)
        ]);
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        break;
}
?>