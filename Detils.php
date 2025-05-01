<?php
// إضافة اتصال قاعدة البيانات
include 'db_connection.php';

// التحقق من وجود معرف المنتج في الرابط
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // إذا لم يتم تمرير معرف المنتج، قم بالتحويل إلى الصفحة الرئيسية
    header('Location: index.php');
    exit;
}

$product_id = $_GET['id'];

// استعلام لجلب بيانات المنتج
$query = "SELECT * FROM products WHERE product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

// التحقق من وجود المنتج
if ($result->num_rows === 0) {
    // إذا لم يتم العثور على المنتج، قم بالتحويل إلى الصفحة الرئيسية
    header('Location: index.php');
    exit;
}

$product = $result->fetch_assoc();

// استعلام لجلب اسم الفئة
$category_query = "SELECT name FROM categories WHERE category_id = ?";
$category_stmt = $conn->prepare($category_query);
$category_stmt->bind_param("i", $product['category_id']);
$category_stmt->execute();
$category_result = $category_stmt->get_result();
$category = $category_result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title><?= htmlspecialchars($product['name']) ?> - Product Details</title>
  <link href="./css/Detils.css" rel="stylesheet" />
  <link crossorigin="anonymous" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
    rel="stylesheet">
  </link>
</head>

<body>
  <div>
  <div class="card-wrapper">
    <div class="card">
      <div class="product-imgs">
        <div class="img-display">
          <div class="img-showcase">
            <?php
            // استعلام لجلب صور المنتج
            $images_query = "SELECT * FROM product_images WHERE product_id = ? ORDER BY sort_order";
            $images_stmt = $conn->prepare($images_query);
            $images_stmt->bind_param("i", $product_id);
            $images_stmt->execute();
            $images_result = $images_stmt->get_result();
            
            // إذا لم تكن هناك صور إضافية، استخدم الصورة الرئيسية
            if ($images_result->num_rows === 0) {
                // استخدم الصور الافتراضية من المنتج
                echo '<img alt="product image 1" src="' . htmlspecialchars($product['image_url_default'] ?? '1.jpg') . '" />';
                echo '<img alt="product image 2" src="' . htmlspecialchars($product['image_url_hover'] ?? '2.jpg') . '" />';
                echo '<img alt="product image 3" src="3.jpg" />';
                echo '<img alt="product image 4" src="4.jpg" />';
            } else {
                // عرض جميع صور المنتج
                while ($image = $images_result->fetch_assoc()) {
                    echo '<img alt="product image" src="' . htmlspecialchars($image['image_url']) . '" />';
                }
            }
            ?>
          </div>
        </div>
        <div class="img-select">
          <?php
          // إعادة تعيين مؤشر نتائج الاستعلام
          $images_stmt->execute();
          $images_result = $images_stmt->get_result();
          
          // إذا لم تكن هناك صور إضافية، استخدم الصور الافتراضية
          if ($images_result->num_rows === 0) {
              ?>
              <div class="img-item">
                <a data-id="1" href="#">
                  <img alt="product thumbnail 1" src="<?= htmlspecialchars($product['image_url_default'] ?? '1.jpg') ?>" />
                </a>
              </div>
              <div class="img-item">
                <a data-id="2" href="#">
                  <img alt="product thumbnail 2" src="<?= htmlspecialchars($product['image_url_hover'] ?? '2.jpg') ?>" />
                </a>
              </div>
              <div class="img-item">
                <a data-id="3" href="#">
                  <img alt="product thumbnail 3" src="3.jpg" />
                </a>
              </div>
              <div class="img-item">
                <a data-id="4" href="#">
                  <img alt="product thumbnail 4" src="4.jpg" />
                </a>
              </div>
              <?php
          } else {
              // عرض مصغرات جميع صور المنتج
              $i = 1;
              while ($image = $images_result->fetch_assoc()) {
                  echo '<div class="img-item">';
                  echo '<a data-id="' . $i . '" href="#">';
                  echo '<img alt="product thumbnail ' . $i . '" src="' . htmlspecialchars($image['image_url']) . '" />';
                  echo '</a>';
                  echo '</div>';
                  $i++;
              }
          }
          ?>
        </div>
      </div>
      <div class="product-content">
        <h4 class="product-title">
          <?= htmlspecialchars($product['name']) ?>
        </h4>
        <a class="product-link" href="#">
          <?= htmlspecialchars($category['name'] ?? 'Marmeto') ?>
        </a>
        <div class="product-rating">
          <?php
          // عرض التقييم بالنجوم
          $rating = $product['rating'] ?? 4.5;
          for ($i = 1; $i <= 5; $i++) {
              if ($i <= floor($rating)) {
                  echo '<i class="fas fa-star"></i>';
              } elseif ($i == ceil($rating) && $rating - floor($rating) >= 0.5) {
                  echo '<i class="fas fa-star-half-alt"></i>';
              } else {
                  echo '<i class="far fa-star"></i>';
              }
          }
          ?>
          <span>
            <?= number_format($rating, 1) ?> (<?= $product['reviews_count'] ?? 215 ?>)
          </span>
        </div>
        <div class="product-price">
          <?php if (isset($product['old_price']) && $product['old_price'] > 0): ?>
          <p class="last-price">
            Old Price:
            <span>
              $<?= number_format($product['old_price'], 2) ?>
            </span>
          </p>
          <p class="new-price">
            New Price:
            <span>
              $<?= number_format($product['price'], 2) ?> 
              (<?= number_format(($product['old_price'] - $product['price']) / $product['old_price'] * 100) ?>% off)
            </span>
          </p>
          <?php else: ?>
          <p class="last-price">
            Old Price:
            <span>
              $19,999.00
            </span>
          </p>
          <p class="new-price">
            New Price:
            <span>
              $<?= number_format($product['price'] ?? 12999, 2) ?> (35% off)
            </span>
          </p>
          <?php endif; ?>
        </div>
        <div class="color-options">
          <div id="colorSelector">
            <label for="color-select">
              Choose a Color
            </label>
            <?php
            // عرض الألوان المتاحة
            if (isset($product['available_colors']) && !empty($product['available_colors'])) {
                $colors = explode(',', $product['available_colors']);
                foreach ($colors as $color) {
                    $color = trim($color);
                    echo '<div class="color-box ' . $color . '" data-color="' . $color . '"></div>';
                }
            } else {
                // ألوان افتراضية
                ?>
                <div class="color-box Yellow" data-color="Yellow"></div>
                <div class="color-box Green" data-color="Green"></div>
                <div class="color-box Blue" data-color="Blue"></div>
                <div class="color-box Pink" data-color="Pink"></div>
                <?php
            }
            ?>
          </div>
          <div class="size-options">
            <label for="size-select">
              Choose a Size:
            </label>
            <select id="size-select">
              <option value="none">None</option>
              <?php
              // عرض الأحجام المتاحة
              if (isset($product['available_sizes']) && !empty($product['available_sizes'])) {
                  $sizes = explode(',', $product['available_sizes']);
                  foreach ($sizes as $size) {
                      $size = trim($size);
                      echo '<option value="' . strtolower($size) . '">' . $size . '</option>';
                  }
              } else {
                  // أحجام افتراضية
                  ?>
                  <option value="small">Small</option>
                  <option value="medium">Medium</option>
                  <option value="large">Large</option>
                  <option value="xl">Extra Large</option>
                  <option value="xxl">XXL</option>
                  <?php
              }
              ?>
            </select>
          </div>
          <div class="purchase-info">
            <div class="quantity-selector">
              <input class="quantity-input" id="quantity" max="<?= $product['stock_quantity'] ?? 10 ?>" min="1" type="number" value="1" />
              <button class="btn" id="add-to-cart" type="button" data-id="<?= $product['product_id'] ?>">
                Add to Cart
                <i class="fas fa-shopping-cart"></i>
              </button>
              <button class="btn" id="buy-now" type="button">
                Buy now
              </button>
            </div>
            <div class="product-detail">
              <h2>
                About this item:
              </h2>
              <p>
                <?= nl2br(htmlspecialchars($product['description'] ?? 'The Embrace Sideboard is a stylish wear. With a top cloth designed to provide superior protection and
                look great, this storage solution is both functional and attractive. It fits seamlessly into any home
                decor, with clean lines and a timeless look. Crafted from premium materials for a combination of style,
                durability, and reliability.')) ?>
              </p>
              <ul>
                <li>
                  Available:
                  <span>
                    <?= ($product['stock_quantity'] > 0) ? 'in stock' : 'out of stock' ?>
                  </span>
                </li>
                <li>
                  Shipping Fee:
                  <span>
                    Free
                  </span>
                </li>
              </ul>
            </div>
            <div class="social-links">
              <p>
                Share at:
              </p>
              <a href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="#">
                <i class="fab fa-whatsapp"></i>
              </a>
              <a href="#">
                <i class="fab fa-pinterest"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    // Product image slider
    const imgs = document.querySelectorAll('.img-select a');
    const imgBtns = [...imgs];
    let imgId = 1;

    imgBtns.forEach((imgItem) => {
        imgItem.addEventListener('click', (event) => {
            event.preventDefault();
            imgId = imgItem.dataset.id;
            slideImage();
        });
    });

    function slideImage() {
        const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;
        document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
    }

    // Color selector
    const colorBoxes = document.querySelectorAll('.color-box');
    colorBoxes.forEach(box => {
        box.addEventListener('click', function() {
            colorBoxes.forEach(b => b.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    // Tab switching
    const tabs = document.querySelectorAll('.Details__tab');
    const tabContents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const target = tab.dataset.tab;
            
            // Remove active class from all tabs and contents
            tabs.forEach(t => t.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));
            
            // Add active class to clicked tab and corresponding content
            tab.classList.add('active');
            document.getElementById(target).classList.add('active');
        });
    });

    // Rating selection in review form
    const ratingStars = document.querySelectorAll('.review__product i');
    const ratingValue = document.getElementById('rating-value');

    ratingStars.forEach(star => {
        star.addEventListener('click', function() {
            const value = this.dataset.rating;
            ratingValue.value = value;
            
            // Update visual stars
            ratingStars.forEach((s, index) => {
                if (index < value) {
                    s.classList.add('fas');
                    s.classList.remove('far');
                } else {
                    s.classList.add('far');
                    s.classList.remove('fas');
                }
            });
        });
    });

    // Add to cart functionality
    document.getElementById('add-to-cart').addEventListener('click', function() {
        addToCart();
    });

    // Buy now functionality
    document.getElementById('buy-now').addEventListener('click', function() {
        buyNow();
    });

    function addToCart() {
        const quantity = document.getElementById('quantity').value;
        const size = document.getElementById('size-select').value;
        let color = 'Yellow'; // Default
        colorBoxes.forEach(box => {
            if (box.classList.contains('selected')) {
                color = box.getAttribute('data-color');
            }
        });

        // Get product ID from the button's data attribute
        const productId = document.getElementById('add-to-cart').getAttribute('data-id');

        // Here you would typically add the item to cart using an AJAX call
        // For now, we'll just show an alert
        alert(`Added ${quantity} item(s) to cart.\nSize: ${size}\nColor: ${color}\nProduct ID: ${productId}`);
        
        // Uncomment and modify this code to implement actual cart functionality
        /*
        fetch('add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product_id=${productId}&quantity=${quantity}&size=${size}&color=${color}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Product added to cart successfully!');
                // Update cart count in the header if needed
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while adding to cart.');
        });
        */
    }

    function buyNow() {
        addToCart();
        // Then redirect to checkout
        alert('Redirecting to checkout...');
        // window.location.href = 'checkout.php'; // Uncomment in production
    }

    // Review form submission
    document.getElementById('review-form').addEventListener('submit', function(e) {
        // If you want to handle the form submission with JavaScript instead of the form's action
        // e.preventDefault();
        // const formData = new FormData(this);
        // Here you would typically submit the review data via AJAX
        // alert('Thank you for your review! It will be published after moderation.');
        // this.reset();
    });

    // Initialize: Select first color by default
    if (colorBoxes.length > 0) {
        colorBoxes[0].classList.add('selected');
    }
  });
  </script>
</body>

</html>
