<?php
include 'db_connection.php';

// الحصول على استعلام البحث
$query = isset($_GET['query']) ? trim($_GET['query']) : '';

// إذا كان الاستعلام فارغًا، إعادة التوجيه إلى الصفحة الرئيسية
if (empty($query)) {
    header('Location: index.php');
    exit;
}

// استعلام البحث في قاعدة البيانات
$searchQuery = "SELECT * FROM products 
               WHERE name LIKE ? 
               OR description LIKE ? 
               OR tags LIKE ?
               ORDER BY rating DESC";

$stmt = $conn->prepare($searchQuery);
$searchTerm = "%{$query}%";
$stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
$stmt->execute();
$searchResults = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Search Results - VOYX</title>
  <link rel="shortcut icon" href="./imgs/index/favicon.png" type="image/x-icon">
  <!-- link css -->
  <link rel="stylesheet" href="./css/index.css">

  <!-- flaticon -->
  <link rel="stylesheet"
    href="https://cdn-uicons.flaticon.com/2.6.0/uicons-solid-rounded/css/uicons-solid-rounded.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet"
    href="https://cdn-uicons.flaticon.com/2.6.0/uicons-thin-straight/css/uicons-thin-straight.css" />
  <link rel="stylesheet"
    href="https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css" />
  <!-- swiper css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  
  <!-- Custom Search JS -->
  <script src="./js/search.js" defer></script>
  
  <style>
    /* تنسيق قائمة اقتراحات البحث */
    #searchSuggestions {
      border: 1px solid #eee;
      border-top: none;
      max-height: 300px;
      overflow-y: auto;
      border-radius: 0 0 8px 8px;
    }
    
    .suggestion-item {
      transition: background-color 0.2s;
      cursor: pointer;
      padding: 8px 12px;
    }
    
    .suggestion-item:hover {
      background-color: #f8f9fa;
      color: var(--first-color);
    }
    footer {
      background-color: #1a365d !important;
    }


    .custom-link {
      color: hsl(176, 88%, 27%) !important;
    }

    .custom-link:hover {
      color: hsl(176, 88%, 27%) !important;
    }

    .social-icon {
      font-size: 1.25rem;
      transition: transform 0.3s ease;
      color: hsl(176, 88%, 27%);
    }

    .social-icon:hover {
      transform: translateY(-2px);
      color: hsl(176, 88%, 27%);
    }

    .contact-icon {
      width: 24px;
      height: 24px;
      flex-shrink: 0;
      color: hsl(176, 88%, 27%);
    }

    .head {
      color: hsl(176, 88%, 27%);
      font-size: 18px;
      font-weight: 900;
    }

    #footer-tit span {
      color: hsl(176, 88%, 27%);
      font-weight: 900 !important;


    }

    .link-secondary,
    #footer-tit,
    .inf {
      color: #fff !important;
      font-size: 13px;
      font-weight: 200;
    }

    .inf:hover {
      color: hsl(176, 88%, 27%) !important;

    }

    .link-secondary:hover {
      color: hsl(176, 88%, 27%) !important;
    }


  </style>
</head>

<body class="body">
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
          <form action="search.php" method="GET" class="w-100 position-relative">
            <div class="search-box input-group">
              <input type="text" name="query" id="searchInput" class="form-control border-0" placeholder="Search products..." autocomplete="off" required />
              <button type="submit" class="btn btn-custom">
                <i class="fas fa-search"></i>
              </button>
            </div>
            <div id="searchSuggestions" class="position-absolute w-100 bg-white shadow-sm rounded-bottom d-none" style="z-index:99999 ;"></div>
          </form>
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
                <li><a class="dropdown-item" href="./Electronics/Computers.php">Computers</a></li>
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
                <li><a class="dropdown-item" href="#">Men's Wear</a></li>
                <li><a class="dropdown-item" href="#">Women's Wear</a></li>
                <li><a class="dropdown-item" href="#">Kids</a></li>
              </ul>
            </li>

            <!-- باقي الفئات -->
            <li class="dropdown-submenu">
              <a class="dropdown-item dropdown-toggle" href="#">Home & kitchen</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Electric-ovens</a></li>
                <li><a class="dropdown-item" href="#">Microwaves</a></li>
                <li><a class="dropdown-item" href="#">Refrigerators</a></li>
                <li><a class="dropdown-item" href="#">Air-conditioners</a></li>
                <li><a class="dropdown-item" href="#">Water-heaters</a></li>
                <li><a class="dropdown-item" href="#">Fans</a></li>
              </ul>
            </li>

            <li class="dropdown-submenu">
              <a class="dropdown-item dropdown-toggle" href="#">Vehicles</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">cars</a></li>
                <li><a class="dropdown-item" href="#">motors</a></li>
                <li><a class="dropdown-item" href="#">bicycles</a></li>

              </ul>
            </li>
          </ul>
        </div>

        <!-- Navigation Links -->
        <div class="d-flex flex-grow-1 justify-content-center">
          <a href="./index.php" class="nav-link">Home</a>
          <a href="#products" class="nav-link">Products</a>
          <a href="#About" class="nav-link">About</a>
          <a href="./Contact US" class="nav-link">Contact US</a>
          <a href="#" class="nav-link">Profile</a>
          <a href="#deals" class="nav-link">Deals</a>
          <a href="#NewArrivals" class="nav-link">NewArrivals</a>
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
              <a href="#" class="d-block py-2">Electronics</a>
              <a href="#" class="d-block py-2">Fashion</a>
              <a href="#" class="d-block py-2">Home & kitchen</a>
              <a href="#" class="d-block py-2">Vehicles</a>
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

  <!-- =====================================Main Content ===================================== -->
  <div class="container my-5">
    <h2 class="mb-4">Search Results for: "<?= htmlspecialchars($query) ?>"</h2>
    
    <?php if ($searchResults->num_rows > 0): ?>
      <p>Found <?= $searchResults->num_rows ?> results</p>
      
      <div class="products__container grid">
        <?php while ($product = $searchResults->fetch_assoc()): ?>
          <div class="product__item" data-product-id="<?= $product['product_id'] ?>">
    <div class="product__banner">
        <a href="Detils.php?id=<?= $product['product_id'] ?>" class="product__images">
            <img src="<?= $product['image_url_default'] ?>" class="product__img default" />
            <img src="<?= $product['image_url_hover'] ?>" class="product__img hover" />
        </a>

        <div class="product__actions">
        <a class="action__btn quick-view" aria-label="Quick View" href="Detils.php?id=<?= $product['product_id'] ?>">
                <i class="fi fi-rr-eye"></i>
                </a>
            <button class="action__btn add-wishlist" aria-label="Add To Wishlist" data-id="<?= $product['product_id'] ?>">
                <i class="fi fi-rr-heart"></i>
            </button>
            <button class="action__btn compare" aria-label="Compare" data-id="<?= $product['product_id'] ?>">
                <i class="fi fi-rr-shuffle"></i>
            </button>
        </div>

        <?php if ($product['badge_id']): ?>
            <?php
            $badgeQuery = "SELECT * FROM product_badges WHERE badge_id = " . $product['badge_id'];
            $badgeResult = $conn->query($badgeQuery);
            $badge = $badgeResult->fetch_assoc();
            ?>
            <div class="product__badge <?= $badge['badge_text'] === 'Sale' ? 'sale-badge' : 'new-badge' ?>">
                <?= $badge['badge_text'] ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="product__content">
        <span class="product__category">
            <?php
            $categoryQuery = "SELECT name FROM categories WHERE category_id = " . $product['category_id'];
            $categoryResult = $conn->query($categoryQuery);
            echo $categoryResult->fetch_assoc()['name'];
            ?>
        </span>

        <h3 class="product__title">
            <a href="Detils.php?id=<?= $product['product_id'] ?>">
                <?= htmlspecialchars($product['name']) ?>
            </a>
        </h3>

        <div class="product__rating">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <?php if ($i <= floor($product['rating'])): ?>
                    <i class="fas fa-star"></i>
                <?php elseif ($i == ceil($product['rating']) && $product['rating'] - floor($product['rating']) >= 0.5): ?>
                    <i class="fas fa-star-half-alt"></i>
                <?php else: ?>
                    <i class="far fa-star"></i>
                <?php endif; ?>
            <?php endfor; ?>
        </div>

        <div class="product__price flex">
            <span class="new__price">$<?= number_format($product['price'], 2) ?></span>
            <?php if ($product['old_price'] > 0): ?>
                <span class="old__price">$<?= number_format($product['old_price'], 2) ?></span>
            <?php endif; ?>
        </div>

        <button class="action__btn cart__btn add-to-cart " aria-label="Add To Cart"
            data-id="<?= $product['product_id'] ?>"
            data-price="<?= $product['price'] ?>">
            <i class="fi fi-rr-shopping-bag-add"></i>
        </button>
    </div>
</div>

        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <div class="alert alert-info">
        <p>No products found matching your search.</p>
        <p>Try different keywords or browse our categories.</p>
      </div>
      
      <div class="mt-4">
        <h3>Popular Categories</h3>
        <div class="d-flex flex-wrap gap-3 mt-3">
          <a href="./Electronics.php" class="btn btn-outline-secondary">Electronics</a>
          <a href="./Fashion.php" class="btn btn-outline-secondary">Fashion</a>
          <a href="./home.php" class="btn btn-outline-secondary">Home & Kitchen</a>
        </div>
      </div>
    <?php endif; ?>
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
        <button class="checkout-btn"><a href="./check_out.html">Proceed to Checkout</a></button>
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

  <!-- =====================================Footer ===================================== -->
 <!-- footer-->
 <footer class="bg-dark py-5">
      <div class="container">
        <div class="row g-4">
          <!-- Logo Section -->
          <div class="col-lg-4">
            <!-- تغيير اللوجو هنا -->
            <div class="d-flex justify-content-center justify-content-lg-start">
              <img src="./imgs/index/logo.png" alt="Logo" style="height: 3rem;">
            </div>

            <p class="mt-4 text-center text-lg-start custom-text-color" id="footer-tit">
              <span>VOYX</span> is your reliable and convenient destination for online shopping. We offer a wide range of
              high-quality products, competitive prices, and fast, secure delivery right to your doorstep. Our platform is
              designed to give you a smooth and enjoyable shopping experience, supported by excellent customer service and
              24/7 support.
            </p>

            <ul class="d-flex gap-3 justify-content-center justify-content-lg-start list-unstyled mt-4">
              <li>
                <a href="#" class="custom-link">
                  <i class="bi bi-facebook social-icon"></i>
                </a>
              </li>
              <li>
                <a href="#" class="custom-link">
                  <i class="bi bi-instagram social-icon"></i>
                </a>
              </li>
              <li>
                <a href="#" class="custom-link">
                  <i class="bi bi-twitter-x social-icon"></i>
                </a>
              </li>
              <li>
                <a href="#" class="custom-link">
                  <i class="bi bi-github social-icon"></i>
                </a>
              </li>
            </ul>
          </div>

          <!-- Links Sections -->
          <div class="col-lg-8">
            <div class="row g-4">
              <div class="col-6 col-md-3">
                <h5 class="mb-3 head">Categories</h5>
                <ul class="list-unstyled">
                  <li class="mb-2">
                    <a href="#" class="text-decoration-none link-secondary">Electronics</a>
                  </li>
                  <li class="mb-2">
                    <a href="#" class="text-decoration-none link-secondary">Fashion</a>
                  </li>
                  <li class="mb-2">
                    <a href="#" class="text-decoration-none link-secondary">Home & kitchen</a>
                  </li>
                  <li class="mb-2">
                    <a href="#" class="text-decoration-none link-secondary">Vehicles</a>
                  </li>
                </ul>
              </div>

              <div class="col-6 col-md-3">
                <h5 class="mb-3 head">Pages</h5>
                <ul class="list-unstyled">
                  <li class="mb-2">
                    <a href="#" class="text-decoration-none link-secondary">Admin dashboard</a>
                  </li>
                  <li class="mb-2">
                    <a href="#" class="text-decoration-none link-secondary">products</a>
                  </li>
                  <li class="mb-2">
                    <a href="#" class="text-decoration-none link-secondary">Profile</a>
                  </li>
                  <li class="mb-2">
                    <a href="#" class="text-decoration-none link-secondary">checkout</a>
                  </li>
                </ul>
              </div>

              <div class="col-6 col-md-3">
                <h5 class="mb-3 head">Help center</h5>
                <ul class="list-unstyled">
                  <li class="mb-2">
                    <a href="#" class="text-decoration-none link-secondary">FAQs</a>
                  </li>
                  <li class="mb-2">
                    <a href="#" class="text-decoration-none link-secondary">track order</a>
                  </li>
                  <li class="mb-2">
                    <a href="#" class="text-decoration-none link-secondary">login/register</a>
                  </li>
                  <li class="mb-2">
                    <a href="#" class="text-decoration-none link-secondary">customer support</a>
                  </li>
                </ul>
              </div>

              <div class="col-6 col-md-3">
                <h5 class="mb-3 head">Contact Us</h5>
                <ul class="list-unstyled">
                  <li class="mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-envelope contact-icon"></i>
                    <span class="inf">zeyad@gmail.com</span>
                  </li>
                  <li class="mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-telephone contact-icon"></i>
                    <span class="inf">0123456789</span>
                  </li>
                  <li class="mb-3 d-flex align-items-start gap-2">
                    <i class="bi bi-geo-alt contact-icon"></i>
                    <span class="inf">Borg Al Arap<br />Alexandria</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Copyright Section -->
        <div class="border-top mt-4 pt-4">
          <div class="d-flex flex-column flex-md-row justify-content-between text-center text-md-start">
            <p class="text-secondary order-md-2 mb-0">
              &copy; 2025 VOYX
            </p>

            <div class="order-md-1 d-flex gap-3">
              <a href="./Terms&Conditions.html" class="text-decoration-none link-primary">Terms & Conditions</a>
              <a href="./Privacy_Policy.html" class="text-decoration-none link-primary">Privacy Policy</a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!--  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/index.js"></script>
  
  <!-- إضافة JavaScript لاقتراحات البحث -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const searchSuggestions = document.getElementById('searchSuggestions');
        
        if (!searchInput || !searchSuggestions) return;
        
        let debounceTimer;
        
        // إضافة مستمع للكتابة في حقل البحث
        searchInput.addEventListener('input', function() {
            const query = this.value.trim();
            
            // مسح المؤقت السابق
            clearTimeout(debounceTimer);
            
            // إخفاء الاقتراحات إذا كان حقل البحث فارغًا
            if (query.length === 0) {
                searchSuggestions.classList.add('d-none');
                searchSuggestions.innerHTML = '';
                return;
            }
            
            // تأخير الطلب لتجنب الطلبات المتكررة
            debounceTimer = setTimeout(() => {
                // هنا نقوم بمحاكاة الاقتراحات بدلاً من استدعاء ملف PHP
                // في الإنتاج، يجب استبدال هذا بطلب AJAX حقيقي
                const fakeSuggestions = [
                    query + " laptop",
                    query + " phone",
                    query + " headphones",
                    query + " watch",
                    query + " camera",
                    query + " tablet"
                ];
                
                // عرض الاقتراحات
                searchSuggestions.innerHTML = '';
                fakeSuggestions.forEach(suggestion => {
                    const item = document.createElement('div');
                    item.className = 'suggestion-item border-bottom';
                    item.textContent = suggestion;
                    
                    // عند النقر على اقتراح، املأ حقل البحث وأرسل النموذج
                    item.addEventListener('click', function() {
                        searchInput.value = suggestion;
                        searchSuggestions.classList.add('d-none');
                        searchInput.form.submit();
                    });
                    
                    searchSuggestions.appendChild(item);
                });
                
                // إظهار قائمة الاقتراحات
                searchSuggestions.classList.remove('d-none');
                
                // في الإنتاج، استخدم هذا الكود بدلاً من المحاكاة أعلاه
                /*
                fetch(`get_suggestions.php?query=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        // إذا لم تكن هناك اقتراحات، أخفِ القائمة
                        if (data.length === 0) {
                            searchSuggestions.classList.add('d-none');
                            return;
                        }
                        
                        // عرض الاقتراحات
                        searchSuggestions.innerHTML = '';
                        data.forEach(suggestion => {
                            const item = document.createElement('div');
                            item.className = 'suggestion-item border-bottom';
                            item.textContent = suggestion;
                            
                            // عند النقر على اقتراح، املأ حقل البحث وأرسل النموذج
                            item.addEventListener('click', function() {
                                searchInput.value = suggestion;
                                searchSuggestions.classList.add('d-none');
                                searchInput.form.submit();
                            });
                            
                            searchSuggestions.appendChild(item);
                        });
                        
                        // إظهار قائمة الاقتراحات
                        searchSuggestions.classList.remove('d-none');
                    })
                    .catch(error => {
                        console.error('Error fetching suggestions:', error);
                    });
                */
            }, 300); // تأخير 300 مللي ثانية
        });
        
        // إخفاء الاقتراحات عند النقر خارج حقل البحث
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchSuggestions.contains(e.target)) {
                searchSuggestions.classList.add('d-none');
            }
        });
        
        // إظهار الاقتراحات عند التركيز على حقل البحث
        searchInput.addEventListener('focus', function() {
            if (this.value.trim().length > 0 && searchSuggestions.children.length > 0) {
                searchSuggestions.classList.remove('d-none');
            }
        });
    });
  </script>
</body>
</html>


