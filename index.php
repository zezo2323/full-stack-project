
<?php
include 'db_connection.php';

// جلب الفئات الشعبية
$categoriesQuery = "SELECT * FROM categories WHERE is_popular = 1";
$categoriesResult = $conn->query($categoriesQuery);

// جلب المنتجات المميزة
$featuredQuery = "SELECT * FROM products WHERE is_featured = 1";
$featuredResult = $conn->query($featuredQuery);

// جلب الصفقات النشطة
$dealsQuery = "SELECT * FROM deals WHERE is_active = 1";
$dealsResult = $conn->query($dealsQuery);
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>VOYX</title>
  <!-- favicon -->
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
  <!-- footer css -->
  <style>
    /* =============================footer================================= */
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
    #footer-tit span{
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

    





    /*================================================ hero========================================= */
    .hero {
      margin: 0;
      padding: 0;
      height: 100vh;
      width: 100%;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      background-image: url('./imgs/index/hero7.png');
      background-repeat: no-repeat;
      background-position: center;
      background-size: contain;
      position: relative;
      overflow: hidden;
      max-width: 1600px;
      /* إضافة حد أقصى للعرض */
      margin: 0 auto;
      image-rendering: -webkit-optimize-contrast;
      /* لتحسين وضوح الصورة */
      backface-visibility: hidden;
      border-radius: 10px;
    }

    /* طبقة شفافة لتحسين وضوح النص */
    .hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.4);
      z-index: 1;
    }

    .content {
      text-align: center;
      color: white;
      position: relative;
      z-index: 2;
      opacity: 0;
      /* نبدأ بشفافية كاملة */
      animation: fadeInUp 1.5s ease forwards;
      /* انيميشن ظهور المحتوى */
    }

    .hero-title {
      font-size: 50px;
      /* تصغير حجم العنوان */
      margin-bottom: 60px;
      font-weight: 600;
      line-height: 1.2;
      opacity: 1;
      transform: translateY(30px);

      /* تأخير انيميشن العنوان */
    }

    .hero-text {
      font-size: 20px;
      /* حجم النص الفرعي */
      margin-bottom: 10px;
      line-height: 1.6;
      opacity: 0;
      transform: translateY(30px);
      animation: fadeInUp 1s ease 0.5s forwards;
    }

    .hero-btn {
      padding: 12px 30px;
      margin-top: 20px;
      background-color: white;
      color: #0d7d75;
      font-weight: bold;
      text-decoration: none;
      border-radius: 8px;
      font-size: 18px;
      display: inline-block;
      transition: all 0.3s ease;
      opacity: 0;
      transform: translateY(30px);
      animation: fadeInUp 1s ease 1s forwards;
      /* تأخير انيميشن الزر */
      position: relative;
      overflow: hidden;
    }

    /* انيميشن تأثير الموجة عند المرور بالماوس */
    .hero-btn::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 0;
      height: 0;
      background-color: rgba(13, 125, 117, 0.2);
      border-radius: 50%;
      transform: translate(-50%, -50%);
      transition: width 0.6s ease, height 0.6s ease;
      z-index: -1;
    }

    .hero-btn:hover {
      background-color: #0d7d75;
      color: white;
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .hero-btn:hover::before {
      width: 300px;
      height: 300px;
    }

    /* انيميشن ظهور المحتوى من الأسفل */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* انيميشن نبض للزر */
    @keyframes pulse {
      0% {
        box-shadow: 0 0 0 0 rgba(13, 125, 117, 0.7);
      }

      70% {
        box-shadow: 0 0 0 15px rgba(13, 125, 117, 0);
      }

      100% {
        box-shadow: 0 0 0 0 rgba(13, 125, 117, 0);
      }
    }

    /* إضافة انيميشن نبض للزر بعد ظهوره */
    .hero-btn {
      animation: fadeInUp 1s ease 1s forwards, pulse 2s infinite 2s;
    }

    /* انيميشن للخلفية */
    .hero {
      animation: zoomIn 20s ease infinite alternate;
    }

    @keyframes zoomIn {
      from {
        background-size: 100% 100%;
      }

      to {
        background-size: 110% 110%;
      }
    }

    /* إضافة media queries للتحكم في الحجم على الشاشات المختلفة */
    @media (max-width: 1200px) {
      .hero {
        width: 90%;
        /* يأخذ 90% من عرض الشاشة عندما يكون العرض أقل من 1200px */
      }
    }

    /* تحسينات للشاشات الصغيرة */
    @media (max-width: 768px) {
      .hero-text {
        font-size: 20px;
        white-space: normal;
      }

      .hero-title {
        font-size: 40px;

      }

      .hero {
        width: 95%;
        /* يأخذ 95% من عرض الشاشة على الأجهزة المتوسطة */
        height: 80vh;
        /* تقليل الارتفاع قليلاً */
      }

      .btn {
        padding: 10px 25px;
        font-size: 16px;
      }
    }

    @media (max-width: 576px) {
      .hero {
        width: 100%;
        /* يأخذ العرض الكامل على الشاشات الصغيرة */
        height: 70vh;
        /* تقليل الارتفاع أكثر */
      }

      .content h1 {
        font-size: 32px;
        /* تصغير حجم الخط */
      }
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
              <a class="dropdown-item dropdown-toggle" href="./Electronics.html">Electronics</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="./Electronics/Smart_phones.html">Mobiles</a></li>
                <li><a class="dropdown-item" href="./Electronics/Televisions.html">Tvs</a></li>
                <li><a class="dropdown-item" href="./Electronics/Laptops.html">Computers</a></li>
                <li><a class="dropdown-item" href="./Electronics/Accessories.html">Accessories</a></li>
                <li><a class="dropdown-item" href="./Electronics/Tablets.html">Tablets</a></li>
                <li><a class="dropdown-item" href="./Electronics/Cameras.html">Cameras</a></li>
                <li><a class="dropdown-item" href="./Electronics/Headphones.html">Headphones</a></li>
                <li><a class="dropdown-item" href="./Electronics/Smart_watches.html">Smart Watches</a></li>
                <li><a class="dropdown-item" href="./Electronics/Gaming.html">Gaming</a></li>
              </ul>
            </li>

            <!-- فئة أخرى -->
            <li class="dropdown-submenu">
              <a class="dropdown-item dropdown-toggle" href="#">Fashion</a>
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
          <a href="./index.html" class="nav-link">Home</a>
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
  <div style="height:auto">

    <!-- =====================================hero ===================================== -->
    <section class="hero">

      <div class="content">
        <h1 class="hero-title">Discover a New Way to Shop</h1>
        <p class="hero-text">Your favorite products, unbeatable deals, and a seamless experience — all in one place.</p>
        <a href="#products" class="btn hero-btn">Exploring Now👉</a>
      </div>

    </section>


    <!--==================================== categories swiper ===================================== -->
    <section class="categories container section">
      <h3 class="section__title"><span>Popular</span> Categories</h3>
      <div class="categories__container swiper">
        <div class="swiper-wrapper">
          <a href="./Electronics.html" class="category__item swiper-slide">
            <img src="./imgs/index/Electronics products.jpg" alt="" class="category__img" />
            <h3 class="category__title">Electronics</h3>
          </a>
          <a href="#" class="category__item swiper-slide">
            <img src="./imgs/index/cars.jpg" alt="" class="category__img" />
            <h3 class="category__title">cars</h3>
          </a>
          <!-- <a href="#" class="category__item swiper-slide">
            <img src="./imgs/index/Accessories5.jpeg" alt="" class="category__img" />
            <h3 class="category__title">Accessories</h3>
          </a> -->
          <a href="#" class="category__item swiper-slide">
            <img src="./imgs/index/motors.jpg" alt="" class="category__img" />
            <h3 class="category__title">Motorcycles</h3>
          </a>
          <a href="#" class="category__item swiper-slide">
            <img src="./imgs/index/computers.jpg" alt="" class="category__img" />
            <h3 class="category__title">Computers</h3>
          </a>
          <a href="#" class="category__item swiper-slide">
            <img src="./imgs/index/games.jpg" alt="" class="category__img" />
            <h3 class="category__title">Games</h3>
          </a>
          <a href="#" class="category__item swiper-slide">
            <img src="./imgs/index/Appliances.jpg" alt="" class="category__img" />
            <h3 class="category__title">Appliances</h3>
          </a>
          <a href="#" class="category__item swiper-slide">
            <img src="./imgs/index/100.jpg" alt="" class="category__img" />
            <h3 class="category__title">phones</h3>
          </a>
          <a href="#" class="category__item swiper-slide">
            <img src="./imgs/index/screens.jpg" alt="" class="category__img" />
            <h3 class="category__title">Screens</h3>
          </a>
          <a href="#" class="category__item swiper-slide">
            <img src="./imgs/index/fashion.jpg" alt="" class="category__img" />
            <h3 class="category__title">fashion</h3>
          </a>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
    </section>


<!--  =====================================Promo Banner ===================================== -->
<section class="promo-banner" id="deals">
  <div class="promo-card sports-promo">
    <div class="promo-content">
      <span class="discount-tag">20% OFF</span>
      <h2 class="promo-title">SPORTS OUTFITS</h2>
      <p class="promo-subtitle">Collection</p>
      <div class="price-tag">Starting at: $190.00</div>
      <button class="cta-button">Shop Now</button>
    </div>
    <div class="promo-image-wrapper">
      <img src="./imgs/index/13.png" alt="Sports Outfits" class="promo-img" />
    </div>
  </div>

  <!-- Accessories Promotion -->
  <div class="promo-card accessories-promo">
    <div class="promo-content">
      <h2 class="promo-title" style="color: #fff;">SPORTS OUTFITS</h2>
      <p class="promo-subtitle">Collection</p>
      <div class="price-tag">Starting at: $190.00</div>
      <button class="cta-button">Shop Now</button>
    </div>
    <div class="promo-image-wrapper">
      <img src="./imgs/index/13.png" alt="Sports Outfits" class="promo-img" />
    </div>
  </div>

  <!-- Repeat Cards -->
  <div class="promo-card sports-promo">
    <div class="promo-content">
      <span class="discount-tag">20% OFF</span>
      <h2 class="promo-title">SPORTS OUTFITS</h2>
      <p class="promo-subtitle">Collection</p>
      <div class="price-tag">Starting at: $190.00</div>
      <button class="cta-button">Shop Now</button>
    </div>
    <div class="promo-image-wrapper">
      <img src="./imgs/index/13.png" alt="Sports Outfits" class="promo-img" />
    </div>
  </div>


</section>

    <!--==================================== products ===================================== -->
    <section class="products section container" id="products">
      <div class="tab__btns">
        <span class="tab__btn active-tab" data-target="#featured">Featured</span>
        <span class="tab__btn" data-target="#popular">Popular</span>
        <span class="tab__btn" data-target="#new-added">New added</span>
      </div>
      <div class="tab__items">
        <div class="tab__item active-tab " id="featured" data-content>
          <div class="products__container grid" id="featured-container">
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/index/1.png" alt="" class="product__img default" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$550</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="tab__item " id="popular" data-content>
          <div class="products__container grid" id="popular-container">
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/index/6.png" alt="" class="product__img default" />

                  <img src="/imgs/index/12.png" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/OIP.jpeg" alt="" class="product__img default" />

                  <img src="/imgs/OIP.jpeg" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="tab__item " id="new-added" data-content>
          <div class="products__container grid" id="new-added-container">
            <div class="product__item">
              <div class="product__banner">
                <a href="" class="product__images">
                  <img src="/imgs/main/1.png" alt="" class="product__img default" />

                  <img src="/imgs/main/2.png" alt="" class="product__img hover" />
                </a>

                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rr-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add To Wishlist">
                    <i class="fi fi-rr-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rr-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="">
                  <h3 class="product__title">Product Title</h3>
                </a>
                <div class="product__rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <!-- نصف نجمة -->
                </div>
                <div class="product__price flex">
                  <span class="new__price">$654.85</span>
                  <span class="old__price">$600</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                  <i class="fi fi-rr-shopping-bag-add"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  </section>

  <!-- =====================================Benefits Section ===================================== -->
  <div class="benefits-section">
    <div class="benefits-container">
      <div class="benefit-card">
        <i class="bi bi-truck benefit-icon"></i>
        <div class="benefit-text">
          <h3 class="text">Free Shipping & Returns</h3>
          <p class="PP">For all orders over $99</p>
        </div>
      </div>
      <div class="benefit-card">
        <i class="bi bi-shield-check benefit-icon"></i>
        <div class="benefit-text">
          <h3 class="text">Secure Payment</h3>
          <p>We ensure secure payment</p>
        </div>
      </div>
      <div class="benefit-card">
        <i class="bi bi-clock-history benefit-icon"></i>
        <div class="benefit-text">
          <h3 class="text">Money Back Guarantee</h3>
          <p>Any book within 20 days</p>
        </div>
      </div>
      <div class="benefit-card">
        <i class="bi bi-headset benefit-icon"></i>
        <div class="benefit-text">
          <h3 class="text">Customer Support</h3>
          <p>Call or email: 24/7 support</p>
        </div>
      </div>
    </div>
  </div>

  <!-- ===================================== new arrivals ===================================== -->
<section class="new-arrivals container section">
  <h3 class="section__title"style="margin-top: 30px;"><span>New</span>Arrivals</h3>

  <div class="new-arrivals__container swiper"> 
    <div class="swiper-wrapper">
      <div class="product__item swiper-slide">
        <div class="product__banner">
          <a href="" class="product__images">
            <img src="./imgs/index/1.png" alt="" class="product__img default" />
          </a>

          <div class="product__actions">
            <a href="#" class="action__btn" aria-label="Quick View">
              <i class="fi fi-rr-eye"></i>
            </a>
            <a href="#" class="action__btn" aria-label="Add To Wishlist">
              <i class="fi fi-rr-heart"></i>
            </a>
            <a href="#" class="action__btn" aria-label="Compare">
              <i class="fi fi-rr-shuffle"></i>
            </a>
          </div>
          <div class="product__badge light-pink">Hot</div>
        </div>
        <div class="product__content">
          <span class="product__category">Clothing</span>
          <a href="">
            <h3 class="product__title">Product Title</h3>
          </a>
          <div class="product__rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <!-- نصف نجمة -->
          </div>
          <div class="product__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
          <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
            <i class="fi fi-rr-shopping-bag-add"></i>
          </a>
        </div>
      </div>
      <div class="product__item swiper-slide">
        <div class="product__banner">
          <a href="" class="product__images">
            <img src="./imgs/index/1.png" alt="" class="product__img default" />
          </a>

          <div class="product__actions">
            <a href="#" class="action__btn" aria-label="Quick View">
              <i class="fi fi-rr-eye"></i>
            </a>
            <a href="#" class="action__btn" aria-label="Add To Wishlist">
              <i class="fi fi-rr-heart"></i>
            </a>
            <a href="#" class="action__btn" aria-label="Compare">
              <i class="fi fi-rr-shuffle"></i>
            </a>
          </div>
          <div class="product__badge light-pink">Hot</div>
        </div>
        <div class="product__content">
          <span class="product__category">Clothing</span>
          <a href="">
            <h3 class="product__title">Product Title</h3>
          </a>
          <div class="product__rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <!-- نصف نجمة -->
          </div>
          <div class="product__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
          <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
            <i class="fi fi-rr-shopping-bag-add"></i>
          </a>
        </div>
      </div>
      <div class="product__item swiper-slide">
        <div class="product__banner">
          <a href="" class="product__images">
            <img src="./imgs/index/1.png" alt="" class="product__img default" />
          </a>

          <div class="product__actions">
            <a href="#" class="action__btn" aria-label="Quick View">
              <i class="fi fi-rr-eye"></i>
            </a>
            <a href="#" class="action__btn" aria-label="Add To Wishlist">
              <i class="fi fi-rr-heart"></i>
            </a>
            <a href="#" class="action__btn" aria-label="Compare">
              <i class="fi fi-rr-shuffle"></i>
            </a>
          </div>
          <div class="product__badge light-pink">Hot</div>
        </div>
        <div class="product__content">
          <span class="product__category">Clothing</span>
          <a href="">
            <h3 class="product__title">Product Title</h3>
          </a>
          <div class="product__rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <!-- نصف نجمة -->
          </div>
          <div class="product__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
          <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
            <i class="fi fi-rr-shopping-bag-add"></i>
          </a>
        </div>
      </div>
      <div class="product__item swiper-slide">
        <div class="product__banner">
          <a href="" class="product__images">
            <img src="./imgs/index/1.png" alt="" class="product__img default" />
          </a>

          <div class="product__actions">
            <a href="#" class="action__btn" aria-label="Quick View">
              <i class="fi fi-rr-eye"></i>
            </a>
            <a href="#" class="action__btn" aria-label="Add To Wishlist">
              <i class="fi fi-rr-heart"></i>
            </a>
            <a href="#" class="action__btn" aria-label="Compare">
              <i class="fi fi-rr-shuffle"></i>
            </a>
          </div>
          <div class="product__badge light-pink">Hot</div>
        </div>
        <div class="product__content">
          <span class="product__category">Clothing</span>
          <a href="">
            <h3 class="product__title">Product Title</h3>
          </a>
          <div class="product__rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <!-- نصف نجمة -->
          </div>
          <div class="product__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
          <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
            <i class="fi fi-rr-shopping-bag-add"></i>
          </a>
        </div>
      </div>
      <div class="product__item swiper-slide">
        <div class="product__banner">
          <a href="" class="product__images">
            <img src="./imgs/index/1.png" alt="" class="product__img default" />
          </a>

          <div class="product__actions">
            <a href="#" class="action__btn" aria-label="Quick View">
              <i class="fi fi-rr-eye"></i>
            </a>
            <a href="#" class="action__btn" aria-label="Add To Wishlist">
              <i class="fi fi-rr-heart"></i>
            </a>
            <a href="#" class="action__btn" aria-label="Compare">
              <i class="fi fi-rr-shuffle"></i>
            </a>
          </div>
          <div class="product__badge light-pink">Hot</div>
        </div>
        <div class="product__content">
          <span class="product__category">Clothing</span>
          <a href="">
            <h3 class="product__title">Product Title</h3>
          </a>
          <div class="product__rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <!-- نصف نجمة -->
          </div>
          <div class="product__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
          <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
            <i class="fi fi-rr-shopping-bag-add"></i>
          </a>
        </div>
      </div>
      <div class="product__item swiper-slide">
        <div class="product__banner">
          <a href="" class="product__images">
            <img src="./imgs/index/1.png" alt="" class="product__img default" />
          </a>

          <div class="product__actions">
            <a href="#" class="action__btn" aria-label="Quick View">
              <i class="fi fi-rr-eye"></i>
            </a>
            <a href="#" class="action__btn" aria-label="Add To Wishlist">
              <i class="fi fi-rr-heart"></i>
            </a>
            <a href="#" class="action__btn" aria-label="Compare">
              <i class="fi fi-rr-shuffle"></i>
            </a>
          </div>
          <div class="product__badge light-pink">Hot</div>
        </div>
        <div class="product__content">
          <span class="product__category">Clothing</span>
          <a href="">
            <h3 class="product__title">Product Title</h3>
          </a>
          <div class="product__rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <!-- نصف نجمة -->
          </div>
          <div class="product__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
          <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
            <i class="fi fi-rr-shopping-bag-add"></i>
          </a>
        </div>
      </div>
      <div class="product__item swiper-slide">
        <div class="product__banner">
          <a href="" class="product__images">
            <img src="./imgs/index/1.png" alt="" class="product__img default" />
          </a>

          <div class="product__actions">
            <a href="#" class="action__btn" aria-label="Quick View">
              <i class="fi fi-rr-eye"></i>
            </a>
            <a href="#" class="action__btn" aria-label="Add To Wishlist">
              <i class="fi fi-rr-heart"></i>
            </a>
            <a href="#" class="action__btn" aria-label="Compare">
              <i class="fi fi-rr-shuffle"></i>
            </a>
          </div>
          <div class="product__badge light-pink">Hot</div>
        </div>
        <div class="product__content">
          <span class="product__category">Clothing</span>
          <a href="">
            <h3 class="product__title">Product Title</h3>
          </a>
          <div class="product__rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <!-- نصف نجمة -->
          </div>
          <div class="product__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
          <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
            <i class="fi fi-rr-shopping-bag-add"></i>
          </a>
        </div>
      </div>
      <div class="product__item swiper-slide">
        <div class="product__banner">
          <a href="" class="product__images">
            <img src="./imgs/index/1.png" alt="" class="product__img default" />
          </a>

          <div class="product__actions">
            <a href="#" class="action__btn" aria-label="Quick View">
              <i class="fi fi-rr-eye"></i>
            </a>
            <a href="#" class="action__btn" aria-label="Add To Wishlist">
              <i class="fi fi-rr-heart"></i>
            </a>
            <a href="#" class="action__btn" aria-label="Compare">
              <i class="fi fi-rr-shuffle"></i>
            </a>
          </div>
          <div class="product__badge light-pink">Hot</div>
        </div>
        <div class="product__content">
          <span class="product__category">Clothing</span>
          <a href="">
            <h3 class="product__title">Product Title</h3>
          </a>
          <div class="product__rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <!-- نصف نجمة -->
          </div>
          <div class="product__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
          <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
            <i class="fi fi-rr-shopping-bag-add"></i>
          </a>
        </div>
      </div>
     </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
  
</section>



<!-- ==========================================Promo Banner ===================================== -->
<section class="promo-banner" id="deals">
  <div class="promo-card accessories-promo">
    <div class="promo-content">
      <h2 class="promo-title" style="color: #fff;">SPORTS OUTFITS</h2>
      <p class="promo-subtitle">Collection</p>
      <div class="price-tag">Starting at: $190.00</div>
      <button class="cta-button">Shop Now</button>
    </div>
    <div class="promo-image-wrapper">
      <img src="./imgs/index/13.png" alt="Sports Outfits" class="promo-img" />
    </div>
  </div>

  <div class="promo-card sports-promo">
    <div class="promo-content">
      <span class="discount-tag">20% OFF</span>
      <h2 class="promo-title">SPORTS OUTFITS</h2>
      <p class="promo-subtitle">Collection</p>
      <div class="price-tag">Starting at: $190.00</div>
      <button class="cta-button">Shop Now</button>
    </div>
    <div class="promo-image-wrapper">
      <img src="./imgs/index/13.png" alt="Sports Outfits" class="promo-img" />
    </div>
  </div>

  <div class="promo-card accessories-promo">
    <div class="promo-content">
      <h2 class="promo-title" style="color: #fff;">SPORTS OUTFITS</h2>
      <p class="promo-subtitle">Collection</p>
      <div class="price-tag">Starting at: $190.00</div>
      <button class="cta-button">Shop Now</button>
    </div>
    <div class="promo-image-wrapper">
      <img src="./imgs/index/13.png" alt="Sports Outfits" class="promo-img" />
    </div>
  </div>
</section>

<!-- ==========================================about ===================================== -->

<section class="About-us">
<div class="about-us">
  <div class="about__container">
      <div class="about__row">
          <div class="about__flex">
              <h2 class="about__title">About Us</h2>
              <h3 class="about__subtitle">Discover Our Passion for Innovation & Style</h3>
              <p class="about__text">
                Welcome to our digital marketplace, where passion meets purpose!
                We are a team of creative minds dedicated to redefining online shopping by blending quality,
                 innovation, and convenience. 
                 Since our launch, we've focused on building a platform that offers more than just products 
                 — we offer experiences.<br>
                
                From the latest fashion trends to unique gadgets, we carefully select every item to match your lifestyle.
                 Our mission is to make online shopping smarter, easier, and more enjoyable for everyone.
                
                We believe in:<br>
                
                ✅ Exceptional Customer Experience<br>
                
                ✅ Transparent and Secure Payments<br>
                
                ✅ Fast, Reliable Shipping<br>
                
                ✅ Constant Innovation<br>
                </p>
              <div class="social-links about__social-links">
                  <a href="" class="fab fa-facebook-f about__social"></a>
                  <a href="" class="fab fa-twitter about__social"></a>
                  <a href="" class="fab fa-instagram about__social"></a>
              </div>
              <a href="" class="about__btn">Explore More</a>
            </div>
          </div>
          <img src="./imgs/index/900.png" class="about__img">
  </div>
</div>
</section>
<!-- ==========================================showcase ===================================== -->
<section class="showcase">
  <div class="showcase__container container grid">
    <div class="showcase__wrapper">
      <h3 class="section__title">Hot Releases</h3>
      <div class="showcase__item">
        <a href=""class="showcase__img-box">
          <img src="./imgs/index/1.png" alt="" class="showcase__img">
        </a>
        <div class="showcase__content">
          <a href="">
            <h4 class="showcase__title">Product Title</h4>
          </a>
          <div class="showcase__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
        </div>
      </div>
      <div class="showcase__item">
        <a href=""class="showcase__img-box">
          <img src="./imgs/index/1.png" alt="" class="showcase__img">
        </a>
        <div class="showcase__content">
          <a href="">
            <h4 class="showcase__title">Product Title</h4>
          </a>
          <div class="showcase__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
        </div>
      </div>
      <div class="showcase__item">
        <a href=""class="showcase__img-box">
          <img src="./imgs/index/1.png" alt="" class="showcase__img">
        </a>
        <div class="showcase__content">
          <a href="">
            <h4 class="showcase__title">Product Title</h4>
          </a>
          <div class="showcase__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
        </div>
      </div>
      <div class="showcase__item">
        <a href=""class="showcase__img-box">
          <img src="./imgs/index/1.png" alt="" class="showcase__img">
        </a>
        <div class="showcase__content">
          <a href="">
            <h4 class="showcase__title">Product Title</h4>
          </a>
          <div class="showcase__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
        </div>
      </div>
    </div>
    <div class="showcase__wrapper">
      <h3 class="section__title">Deals & outlet</h3>
      <div class="showcase__item">
        <a href=""class="showcase__img-box">
          <img src="./imgs/index/1.png" alt="" class="showcase__img">
        </a>
        <div class="showcase__content">
          <a href="">
            <h4 class="showcase__title">Product Title</h4>
          </a>
          <div class="showcase__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
        </div>
      </div>
      <div class="showcase__item">
        <a href=""class="showcase__img-box">
          <img src="./imgs/index/1.png" alt="" class="showcase__img">
        </a>
        <div class="showcase__content">
          <a href="">
            <h4 class="showcase__title">Product Title</h4>
          </a>
          <div class="showcase__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
        </div>
      </div>
      <div class="showcase__item">
        <a href=""class="showcase__img-box">
          <img src="./imgs/index/1.png" alt="" class="showcase__img">
        </a>
        <div class="showcase__content">
          <a href="">
            <h4 class="showcase__title">Product Title</h4>
          </a>
          <div class="showcase__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
        </div>
      </div>
      <div class="showcase__item">
        <a href=""class="showcase__img-box">
          <img src="./imgs/index/1.png" alt="" class="showcase__img">
        </a>
        <div class="showcase__content">
          <a href="">
            <h4 class="showcase__title">Product Title</h4>
          </a>
          <div class="showcase__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
        </div>
      </div>
    </div>
    <div class="showcase__wrapper">
      <h3 class="section__title">Top Selling</h3>
      <div class="showcase__item">
        <a href=""class="showcase__img-box">
          <img src="./imgs/index/1.png" alt="" class="showcase__img">
        </a>
        <div class="showcase__content">
          <a href="">
            <h4 class="showcase__title">Product Title</h4>
          </a>
          <div class="showcase__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
        </div>
      </div>
      <div class="showcase__item">
        <a href=""class="showcase__img-box">
          <img src="./imgs/index/1.png" alt="" class="showcase__img">
        </a>
        <div class="showcase__content">
          <a href="">
            <h4 class="showcase__title">Product Title</h4>
          </a>
          <div class="showcase__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
        </div>
      </div>
      <div class="showcase__item">
        <a href=""class="showcase__img-box">
          <img src="./imgs/index/1.png" alt="" class="showcase__img">
        </a>
        <div class="showcase__content">
          <a href="">
            <h4 class="showcase__title">Product Title</h4>
          </a>
          <div class="showcase__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
        </div>
      </div>
      <div class="showcase__item">
        <a href=""class="showcase__img-box">
          <img src="./imgs/index/1.png" alt="" class="showcase__img">
        </a>
        <div class="showcase__content">
          <a href="">
            <h4 class="showcase__title">Product Title</h4>
          </a>
          <div class="showcase__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
        </div>
      </div>
    </div>
    <div class="showcase__wrapper">
      <h3 class="section__title">Trendy</h3>
      <div class="showcase__item">
        <a href=""class="showcase__img-box">
          <img src="./imgs/index/1.png" alt="" class="showcase__img">
        </a>
        <div class="showcase__content">
          <a href="">
            <h4 class="showcase__title">Product Title</h4>
          </a>
          <div class="showcase__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
        </div>
      </div>
      <div class="showcase__item">
        <a href=""class="showcase__img-box">
          <img src="./imgs/index/1.png" alt="" class="showcase__img">
        </a>
        <div class="showcase__content">
          <a href="">
            <h4 class="showcase__title">Product Title</h4>
          </a>
          <div class="showcase__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
        </div>
      </div>
      <div class="showcase__item">
        <a href=""class="showcase__img-box">
          <img src="./imgs/index/1.png" alt="" class="showcase__img">
        </a>
        <div class="showcase__content">
          <a href="">
            <h4 class="showcase__title">Product Title</h4>
          </a>
          <div class="showcase__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
        </div>
      </div>
      <div class="showcase__item">
        <a href=""class="showcase__img-box">
          <img src="./imgs/index/1.png" alt="" class="showcase__img">
        </a>
        <div class="showcase__content">
          <a href="">
            <h4 class="showcase__title">Product Title</h4>
          </a>
          <div class="showcase__price flex">
            <span class="new__price">$550</span>
            <span class="old__price">$600</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


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
<!-- ===================================== space ===================================== -->
<div class="space" style="height: 60px; background-color: var(--first-color);">

</div>
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


  











  <!-- ===================================== JavaScript ===================================== -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <!--  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./js/index.js"></script>
  <script>
  



  </script>
</body>

</html>