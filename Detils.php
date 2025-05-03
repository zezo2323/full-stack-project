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
  <!-- favicon -->
  <link rel="shortcut icon" href="./imgs/index/favicon.png" type="image/x-icon">
  <!-- flaticon -->
  <link rel="stylesheet"
    href="https://cdn-uicons.flaticon.com/2.6.0/uicons-solid-rounded/css/uicons-solid-rounded.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet"
    href="https://cdn-uicons.flaticon.com/2.6.0/uicons-thin-straight/css/uicons-thin-straight.css" />
  <link rel="stylesheet"
    href="https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css" />
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link crossorigin="anonymous" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
    rel="stylesheet">
  </link>
</head>

<body>

  <!-- Navbar -->

  <!-- =====================================Promotion Bar ===================================== -->
  <div class="promotion-bar">
    <div class="container d-flex justify-content-between align-items-center">
      <span>🎁 Get 10% off your first order! Use code: WELCOME10</span>
      <button class="btn btn-link text-white p-0 close-promo">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>

  <!-- =====================================Main Navigation ===================================== -->
  <nav class="main-nav">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <!-- Logo -->
        <a href="#" class="navbar-brand">
          <img src="./imgs/index/logo.png" alt="Logo" style="height: 50px; width: 100px" />
        </a>

        <!-- Search Box -->
        <div class="col-lg-4">
          <div class="search-box input-group">
            <input type="text" class="form-control border-0" placeholder="Search products..." />
            <button class="btn btn-custom">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>

        <div class="nav-icons d-flex align-items-center position-relative col-md-1">
          <!-- باقي الأيقونات -->
          <a href="#wishlistSidebar" class="nav-icon position-relative" onclick="toggleSidebar('wishlist')">
            <i class="far fa-heart"></i>
            <span class="badge-custom" id="wishlistBadge">0</span>
          </a>
          <a href="#cartSidebar" class="nav-icon position-relative" onclick="toggleSidebar('cart')">
            <i class="fas fa-shopping-cart"></i>
            <span class="badge-custom " id="cartBadge">0</span>
          </a>
        </div>

      </div>
    </div>
  </nav>

  <!-- =====================================Bottom Navigation ===================================== -->
  <nav class="bottom-nav">
    <div class="container">
      <div class="d-flex align-items-center">
        <!-- Categories Dropdown -->
        <div class="dropdown me-4" id="categoriesDropdown">
          <button class="btn btn-custom dropdown-toggle rounded-pill px-4" data-bs-toggle="dropdown">
            <i class="fas fa-bars me-2"></i>Categories
          </button>

          <ul class="dropdown-menu dropdown-menu-end">
            <!-- فئة مع قائمة فرعية -->
            <li class="dropdown-submenu">
              <a class="dropdown-item dropdown-toggle" href="./Electronics.php">Electronics</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="./Electronics/Smart_phones.php">Mobiles</a></li>
                <li><a class="dropdown-item" href="./Electronics/Televisions.php">Tvs</a></li>
                <li><a class="dropdown-item" href="./Electronics/Computers.php"">Computers</a></li>
                <li><a class="dropdown-item" href="./Electronics/Accessories.php">Accessories</a></li>
                <li><a class="dropdown-item" href="./Electronics/Tablets.php">Tablets</a></li>
                <li><a class="dropdown-item" href="./Electronics/Cameras.php">Cameras</a></li>
                <li><a class="dropdown-item" href="./Electronics/Headphones.php">Headphones</a></li>
                <li><a class="dropdown-item" href="./Electronics/Smart_watches.php">Smart Watches</a></li>
                <li><a class="dropdown-item" href="./Electronics/Gaming.php">Gaming</a></li>
              </ul>
            </li>

            <!-- فئة أخرى -->
            <li class="dropdown-submenu">
              <a class="dropdown-item dropdown-toggle" href="./Fashion.php">Fashion</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="./Fashions/men's.php">Men's Wear</a></li>
                <li><a class="dropdown-item" href="./Fashions/women's.php">Women's Wear</a></li>
                <li><a class="dropdown-item" href="./Fashions/kids.php">Kids</a></li>
              </ul>
            </li>

            <!-- باقي الفئات -->
            <li class="dropdown-submenu">
              <a class="dropdown-item dropdown-toggle" href="./home.php">Home & kitchen</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="./home catagory/Stove.php">Stoves</a></li>
                <li><a class="dropdown-item" href="./home catagory/Freezers.php">Freezers</a></li>
                <li><a class="dropdown-item" href="./home catagory/Refrigerators.php">Refrigerators</a></li>
                <li><a class="dropdown-item" href="./home catagory/Kitchen.php">Kitchens</a></li>
                <li><a class="dropdown-item" href="./home catagory/Washing machines.php">Washing</a></li>
                <li><a class="dropdown-item" href="./home catagory/Fans.php">Fans</a></li>
              </ul>
            </li>

            <li class="dropdown-submenu">
              <a class="dropdown-item dropdown-toggle" href="./Vehicles.php">Vehicles</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="./Vehicles/cars.php">Cars</a></li>
                <li><a class="dropdown-item" href="./Vehicles/motors.php">motors</a></li>
                <li><a class="dropdown-item" href="./Vehicles/bicycles.php">bicycles</a></li>

              </ul>
            </li>
          </ul>
        </div>

        <!-- Navigation Links -->
        <div class="d-flex flex-grow-1 justify-content-center">
          <a href="./index.php" class="nav-link">Home</a>
          <a href="#products" class="nav-link">Products</a>
          <a href="#" class="nav-link">About</a>
          <a href="#" class="nav-link">Contact US</a>
          <a href="#" class="nav-link">Profile</a>
          <a href="#deals" class="nav-link">Deals</a>
        </div>
        <!-- Categories Dropdown -->
        <div class="dropdown me-4">
          <button class="btn btn-custom dropdown-toggle rounded-pill px-4" data-bs-toggle="dropdown">
            <i class="far fa-user"></i>
          </button>

          <ul class="dropdown-menu dropdown-menu-end">
            <!-- فئة مع قائمة فرعية -->
            <li><a class="dropdown-item" href="#">Login</a></li>
            <li><a class="dropdown-item" href="#">Signup</a></li>
            <li><a class="dropdown-item" href="#">Logout</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
          </ul>
        </div>


        <!-- side bar -->
        <div class="sidebar">
          <div class="sidebar-header">
            <h4>VOYX</h4>
            <button class="btn btn-close btn-close-white close-sidebar"></button>
          </div>

          <div class="sidebar-category">
            <div class="d-flex justify-content-between align-items-center">
              <h5>Categories</h5>
              <i class="fas fa-chevron-down"></i>
            </div>
            <div class="sub-menu">
              <a href="./Electronics.php" class="d-block py-2">Electronics</a>
              <a href="./Fashion.php" class="d-block py-2">Fashion</a>
              <a href="./home.php" class="d-block py-2">Home & kitchen</a>
              <a href="./Vehicles.php" class="d-block py-2">Vehicles</a>
            </div>
          </div>

          <div class="sidebar-category">
            <div class="d-flex justify-content-between align-items-center">
              <h5>Pages</h5>
              <i class="fas fa-chevron-down"></i>
            </div>
            <div class="sub-menu">
              <a href="#" class="d-block py-2">Home</a>
              <a href="#" class="d-block py-2">Products</a>
              <a href="#" class="d-block py-2">Contact us</a>
              <a href="#" class="d-block py-2">About</a>
              <a href="#" class="d-block py-2">Profile</a>
              <a href="#" class="d-block py-2">Deals</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

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

  <!-- =====================================Cart Sidebar ===================================== -->
  <div class="offcanvas-sidebar" id="cartSidebar">
    <div class="sidebar-header">
      <h3 class="sidebar-title">Shopping Cart</h3>
      <button class="close-sidebar" onclick="closeSidebar('cart')">&times;</button>
    </div>
    <div class="cart-items" id="cartItems"></div>
    <div class="cart-footer">
      <div class="subtotal">
        <span>Subtotal:</span>
        <span id="cartTotal">$0.00</span>
      </div>
      <button class="checkout-btn">Proceed to Checkout</button>
    </div>
  </div>

  <!-- =====================================Wishlist Sidebar ===================================== -->
  <div class="offcanvas-sidebar" id="wishlistSidebar">
    <div class="sidebar-header">
      <h3 class="sidebar-title">Your Wishlist</h3>
      <button class="close-sidebar" onclick="closeSidebar('wishlist')">&times;</button>
    </div>
    <div class="cart-items" id="wishlistItems"></div>
  </div>

  <!-- ===================================== JavaScript ===================================== -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <!--  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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






    /*============================================ Close promotion bar =============================================*/
    // Close promotion bar
    document.querySelector(".close-promo").addEventListener("click", () => {
      document.querySelector(".promotion-bar").style.display = "none";
    });

    /*============================================ Hide/show navbars on scroll =============================================*/
    // Hide/show navbars on scroll
    let lastScroll = 0;
    const promotionBar = document.querySelector(".promotion-bar");
    const mainNav = document.querySelector(".main-nav");

    window.addEventListener("scroll", () => {
      const currentScroll = window.pageYOffset;

      if (currentScroll > lastScroll && currentScroll > 100) {
        // Scroll down
        promotionBar.style.transform = "translateY(-100%)";
        mainNav.style.transform = "translateY(-100%)";
      } else {
        // Scroll up
        promotionBar.style.transform = "translateY(0)";
        mainNav.style.transform = "translateY(0)";
      }
      lastScroll = currentScroll;
    });

    /*============================================ Mobile menu toggle =============================================*/
    // Mobile menu toggle
    const mobileMenuButton = document.createElement("button");
    mobileMenuButton.className = "btn btn-custom d-lg-none";
    mobileMenuButton.innerHTML = '<i class="fas fa-bars"></i>';
    document
      .querySelector(".bottom-nav .container")
      .prepend(mobileMenuButton);

    mobileMenuButton.addEventListener("click", () => {
      document
        .querySelector(".categories-wrapper .dropdown-menu")
        .classList.toggle("show");
    });

    /*============================================ Sidebar =============================================*/
    // التحكم في القائمة الجانبية
    const bottomNav = document.querySelector(".bottom-nav");
    const sidebar = document.querySelector(".sidebar");
    const closeBtn = document.querySelector(".close-sidebar");

    //  فتح القائمة عند النقر علي
    mobileMenuButton.addEventListener("click", () => {
      sidebar.classList.add("active");
    });

    // إغلاق القائمة
    closeBtn.addEventListener("click", () => {
      sidebar.classList.remove("active");
    });

    // إغلاق القائمة عند النقر خارجها
    document.addEventListener("click", (e) => {
      if (!sidebar.contains(e.target) && !bottomNav.contains(e.target)) {
        sidebar.classList.remove("active");
      }
    });

    // تبديل القوائم الفرعية
    document.querySelectorAll(".sidebar-category").forEach((category) => {
      category.addEventListener("click", () => {
        category.classList.toggle("active");
      });
    });
    // للتحكم في القوائم الفرعية على الجوال
    document.querySelectorAll(".dropdown-submenu a").forEach((item) => {
      item.addEventListener("click", (e) => {
        if (window.innerWidth < 992) {
          e.preventDefault();
          e.stopPropagation();
          const submenu = e.target.nextElementSibling;
          submenu.style.display =
            submenu.style.display === "block" ? "none" : "block";
        }
      });
    });

    gsap.to("#hero-title", {
      opacity: 1,
      y: -20,
      duration: 1,
      ease: "power3.out",
    });
    gsap.to("#hero-text", {
      opacity: 1,
      y: -10,
      duration: 1.2,
      delay: 0.5,
      ease: "power3.out",
    });
    gsap.to("#hero-btn", {
      opacity: 1,
      y: 0,
      duration: 1.5,
      delay: 1,
      ease: "power3.out",
    });







    /*============================================ cart and wishlist =============================================*/
    // Initialize cart and wishlist
    let cart = [];
    let wishlist = [];
    let cartCount = 0;
    let wishlistCount = 0;

    // Event Delegation for dynamic elements
    document.body.addEventListener('click', function(e) {
      // Add to Cart
      if (e.target.closest('.cart__btn')) {
        e.preventDefault();
        const productItem = e.target.closest('.product__item');
        const product = {
          id: Date.now(), // استخدام timestamp كـ ID مؤقت
          title: productItem.querySelector('.product__title').innerText,
          price: parseFloat(productItem.querySelector('.new__price').innerText.replace('$', '')),
          image: productItem.querySelector('.product__img').src
        };
        addToCart(product);
      }

      // Add to Wishlist
      if (e.target.closest('.action__btn[aria-label="Add To Wishlist"]')) {
        e.preventDefault();
        const productItem = e.target.closest('.product__item');
        const product = {
          id: Date.now(),
          title: productItem.querySelector('.product__title').innerText,
          price: parseFloat(productItem.querySelector('.new__price').innerText.replace('$', '')),
          image: productItem.querySelector('.product__img').src
        };
        addToWishlist(product);
      }
    });

    // Improved Add to Cart function
    function addToCart(product) {
      const existingItem = cart.find(item => item.id === product.id);
      if (existingItem) {
        existingItem.quantity++;
      } else {
        cart.push({
          ...product,
          quantity: 1
        });
      }
      cartCount++;
      updateCartUI();
      showNotification(`${product.title} added to cart!`);
    }

    // Add to Wishlist function
    function addToWishlist(product) {
      if (!wishlist.some(item => item.id === product.id)) {
        wishlist.push(product);
        wishlistCount++;
        updateWishlistUI();
        showNotification(`${product.title} added to wishlist!`);
      }
    }

    // Update Cart UI
    function updateCartUI() {
      const cartBadge = document.getElementById('cartBadge');
      const cartItemsContainer = document.getElementById('cartItems');
      const cartTotalElement = document.getElementById('cartTotal');

      // Update Badge
      cartBadge.textContent = cartCount;

      // Update Items List
      cartItemsContainer.innerHTML = cart.map(item => `
      <div class="cart-item d-flex align-items-center gap-3 mb-3">
        <img src="${item.image}" width="60" height="60" class="rounded">
        <div class="flex-grow-1">
          <h6 class="mb-0">${item.title}</h6>
          <div class="d-flex align-items-center gap-2">
            <span>$${item.price} x ${item.quantity}</span>
                  </div>
                </div>
        <button class="btn btn-danger btn-sm" onclick="removeCartItem(${item.id})">
          <i class="fas fa-trash"></i>
        </button>
                  </div>
    `).join('');

      // Update Total
      const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
      cartTotalElement.textContent = `$${total.toFixed(2)}`;
    }

    // Update Wishlist UI
    function updateWishlistUI() {
      const wishlistBadge = document.getElementById('wishlistBadge');
      const wishlistItemsContainer = document.getElementById('wishlistItems');

      wishlistBadge.textContent = wishlistCount;

      wishlistItemsContainer.innerHTML = wishlist.map(item => `
      <div class="wishlist-item d-flex align-items-center gap-3 mb-3">
        <img src="${item.image}" width="60" height="60" class="rounded">
        <div class="flex-grow-1">
          <h6 class="mb-0">${item.title}</h6>
          <div>$${item.price}</div>
                  </div>
        <button class="btn btn-danger btn-sm" onclick="removeWishlistItem(${item.id})">
          <i class="fas fa-trash"></i>
        </button>
                </div>
    `).join('');
    }

    // Remove item functions
    function removeCartItem(id) {
      cart = cart.filter(item => item.id !== id);
      cartCount = cart.reduce((sum, item) => sum + item.quantity, 0);
      updateCartUI();
    }

    function removeWishlistItem(id) {
      wishlist = wishlist.filter(item => item.id !== id);
      wishlistCount = wishlist.length;
      updateWishlistUI();
    }

    /*============================================ Notification system =============================================*/
    function showNotification(message) {
      const notification = document.createElement('div');
      notification.className = 'notification alert alert-success position-fixed top-0 end-0 m-3';
      notification.textContent = message;
      document.body.appendChild(notification);

      setTimeout(() => {
        notification.remove();
      }, 1500);
    }

    /*============================================ Sidebar =============================================*/
    function toggleSidebar(type) {
      const sidebar = document.getElementById(`${type}Sidebar`);
      sidebar.classList.add("active");
    }

    function closeSidebar(type) {
      const sidebar = document.getElementById(`${type}Sidebar`);
      sidebar.classList.remove("active");
    }
    document.querySelector('.nav-icon[href="#userDropdown"]').addEventListener('click', function(e) {
      e.preventDefault();
      document.getElementById('userDropdown').classList.toggle('active');
    });

    // test 

    const category = "Electronics"; // ✨ لازم تكون نفس الاسم الموجود في قاعدة البيانات

    async function loadCategoryProducts(cat) {
      const res = await fetch(`getProducts.php?category=${cat}`);
      const products = await res.json();
      const container = document.getElementById('category-products-container');
      container.innerHTML = '';

      products.forEach(p => {
        container.innerHTML += `
        <div class="product__item">
          <div class="product__banner">
            <a href="#" class="product__images">
              <img src="${p.image_default}" class="product__img default" />
              <img src="${p.image_hover}" class="product__img hover" />
            </a>
            <div class="product__badge light-pink">${p.type}</div>
          </div>
          <div class="product__content">
            <span class="product__category">${p.category_name}</span>
            <h3 class="product__title">${p.title}</h3>
            <div class="product__rating">
              ${'<i class="fas fa-star"></i>'.repeat(Math.floor(p.rating))}
              ${p.rating % 1 ? '<i class="fas fa-star-half-alt"></i>' : ''}
            </div>
            <div class="product__price flex">
              <span class="new__price">$${p.price}</span>
              <span class="old__price">$${p.old_price}</span>
            </div>
          </div>
        </div>
      `;
      });
    }
  </script>
</body>

</html>