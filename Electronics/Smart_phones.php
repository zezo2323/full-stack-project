<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobiles</title>
    <link rel="stylesheet" href="../css/Electronics.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- favicon -->
    <link rel="shortcut icon" href="../imgs/index/favicon.png" type="image/x-icon">
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

    <style>
        /* footer */
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

        #footer-tit,
        .inf {
            color: white !important;
            font-size: 13px;
            font-weight: 200;
        }

        .inf:hover {
            color: hsl(176, 88%, 27%) !important;

        }

        .link-secondary {
            color: white !important;
            font-size: 13px;
            font-weight: 200;
        }

        .link-secondary:hover {
            color: hsl(176, 88%, 27%) !important;
        }
    </style>
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
                <a href="../index.php" class="navbar-brand">
                    <img src="../imgs/index/logo.png" alt="Logo" style="height: 50px; width: 100px" />
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
                            <a class="dropdown-item dropdown-toggle" href="../Electronics.php">Electronics</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../Electronics/Smart_phones.php">Mobiles</a></li>
                                <li><a class="dropdown-item" href="../Electronics/Televisions.php">Tvs</a></li>
                                <li><a class="dropdown-item" href="../Electronics/Computers.php">Computers</a></li>
                                <li><a class="dropdown-item" href="../Electronics/Accessories.php">Accessories</a></li>
                                <li><a class="dropdown-item" href="../Electronics/Tablets.php">Tablets</a></li>
                                <li><a class="dropdown-item" href="../Electronics/Cameras.php">Cameras</a></li>
                                <li><a class="dropdown-item" href="../Electronics/Headphones.php">Headphones</a></li>
                                <li><a class="dropdown-item" href="../Electronics/Smart_watches.php">Smart Watches</a>
                                </li>
                                <li><a class="dropdown-item" href="../Electronics/Gaming.php">Gaming</a></li>
                            </ul>
                        </li>

                        <!-- فئة أخرى -->
                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="../Fashion.php">Fashion</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../Fashions/men's.php">Men's Wear</a></li>
                                <li><a class="dropdown-item" href="../Fashions/women's.php">Women's Wear</a></li>
                                <li><a class="dropdown-item" href="../Fashions/kids.php">Kids</a></li>
                            </ul>
                        </li>

                        <!-- باقي الفئات -->
                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="../home.php">Home & kitchen</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../home catagory/Stove.php">Stoves</a></li>
                                <li><a class="dropdown-item" href="../home catagory/Freezers.php">Freezers</a></li>
                                <li><a class="dropdown-item" href="../home catagory/Refrigerators.php">Refrigerators</a>
                                </li>
                                <li><a class="dropdown-item" href="../home catagory/Kitchen.php">Kitchens</a></li>
                                <li><a class="dropdown-item" href="../home catagory/Washing machines.php">Washing</a>
                                </li>
                                <li><a class="dropdown-item" href="../home catagory/Fans.php">Fans</a></li>
                            </ul>
                        </li>

                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="../Vehicles.php">Vehicles</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../Vehicles/cars.php">Cars</a></li>
                                <li><a class="dropdown-item" href="../Vehicles/motors.php">motors</a></li>
                                <li><a class="dropdown-item" href="../Vehicles/bicycles.php">bicycles</a></li>

                            </ul>
                        </li>
                    </ul>
                </div>

                <!-- Navigation Links -->
                <div class="d-flex flex-grow-1 justify-content-center">
                    <a href="../index.php" class="nav-link">Home</a>
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
                            <a href="../Electronics.php" class="d-block py-2">Electronics</a>
                            <a href="../Fashion.php" class="d-block py-2">Fashion</a>
                            <a href="../home.php" class="d-block py-2">Home & kitchen</a>
                            <a href="../Vehicles.php" class="d-block py-2">Vehicles</a>
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

    <!-- Sidebar Filters -->


    <section class="slider">
        <div class="container">
            <h2>Filters</h2>
            <div class="box">
                <div class="arrow-left"><a href="../Electronics.php"><i class="fa-solid fa-arrow-left"></i></a></div>
                <h5>Electronics</h5>
                <h3>Category</h3>
                <ul class="category-list">
                    <ul class="category">
                        <li class="has-submenu">
                            <a href="../Electronics/Smart_phones.php"><span>Mobile</span></a>
                            <span class="arrow">▶</span>
                            <ul class="subcategory">
                                <li><a href="../Electronics/Apple.php">Apple</a></li>
                                <li><a href="../Electronics/Samsung.php">Samsung</a></li>
                                <li><a href="../Electronics/Xiaomi.php">Xiaomi</a></li>
                                <li><a href="../Electronics/Honor.php">Honor</a></li>
                                <li><a href="../Electronics/Oppo.php">Oppo</a></li>
                            </ul>


                        <li class="has-submenu">
                            <a href="../Electronics/Televisions.php"><span>Tvs</span></a>
                            <span class="arrow">▶</span>
                            <ul class="subcategory">
                                <li><a href="../Electronics/Tornado.php">Tornado</a></li>
                                <li><a href="../Electronics/LG.php">LG</a></li>
                                <li><a href="../Electronics/Sharp.php">Sharp</a></li>
                                <li><a href="../Electronics/Fresh.php">Fresh</a></li>
                                <li><a href="../Electronics/Toshiba.php">Toshiba</a></li>
                            </ul>

                        <li class="has-submenu">
                            <a href="../Electronics/Computers.php"><span>Computers</span></a>
                            <span class="arrow">▶</span>
                            <ul class="subcategory">
                                <li><a href="../Electronics/HP.php">HP</a></li>
                                <li><a href="../Electronics/Dell.php">Dell</a></li>
                                <li><a href="../Electronics/Lenovo.php">Lenovo</a></li>
                                <li><a href="../Electronics/Mac.php">Mac</a></li>
                                <li><a href="../Electronics/Asus.php">Asus</a></li>
                            </ul>


                        <li class="has-submenu">
                            <a href="../Electronics/Accessories.php"><span>Accessories</span></a>
                            <span class="arrow">▶</span>
                            <ul class="subcategory">
                                <li><a href="../Electronics/Computers_Accessories.php">Computers</a></li>
                                <li><a href="../Electronics/Mobiles_Accessories.php">Mobiles</a></li>
                            </ul>


                        <li><a href="../Electronics/Tablets.php">Tablets</a></li>
                        <li><a href="../Electronics/Cameras.php">Cameras</a></li>


                        <li><a href="../Electronics/Headphones.php">Headphones</a></li>
                        <li><a href="../Electronics/Smart_watches.php">Smart Watches</a></li>
                        <li><a href="../Electronics/Gaming.php">Gaming</a></li>
                        </li>
                    </ul>
                </ul>




                <div class="box">
                    <h3>Filter by Price</h3>
                    <ul class="price-filter">
                        <li><label><input type="checkbox" name="price" value="50" onclick="applyFilters()"> Up to
                                EGP 50</label></li>
                        <li><label><input type="checkbox" name="price" value="100" onclick="applyFilters()"> EGP 50
                                to
                                EGP 100</label></li>
                        <li><label><input type="checkbox" name="price" value="300" onclick="applyFilters()"> EGP 100
                                to
                                EGP 300</label></li>
                        <li><label><input type="checkbox" name="price" value="1500" onclick="applyFilters()"> EGP
                                700
                                to
                                EGP 1500</label></li>
                        <li><label><input type="checkbox" name="price" value="2500" onclick="applyFilters()"> EGP
                                1500
                                to
                                EGP 2500</label></li>
                        <li><label><input type="checkbox" name="price" value="above" onclick="applyFilters()"> EGP
                                2500
                                &
                                above</label></li>
                    </ul>


                    <div class="box">
                        <h3>Filter by Capacity</h3>
                        <ul class="price-filter">
                            <li><label><input type="checkbox" name="capacity" value="32" onclick="applyFilters()">
                                    32
                                    GB</label></li>
                            <li><label><input type="checkbox" name="capacity" value="64" onclick="applyFilters()">
                                    64
                                    GB</label></li>
                            <li><label><input type="checkbox" name="capacity" value="128" onclick="applyFilters()">
                                    128
                                    GB</label></li>
                            <li><label><input type="checkbox" name="capacity" value="256" onclick="applyFilters()">
                                    256 GB</label></li>
                            <li><label><input type="checkbox" name="capacity" value="512" onclick="applyFilters()">
                                    512 GB</label></li>
                        </ul>


                        <div class="box">
                            <h3>Brands</h3>
                            <div class="brand">

                                <div>
                                    <li><a href="../Electronics/Apple.php">Apple</a></li>
                                    <span>Mobiles</span>
                                </div>
                            </div>

                            <div class="brand">

                                <div>
                                    <li><a href="../Electronics/Samsung.php">Samsung</a></li>
                                    <span>Mobiles</span>
                                </div>
                            </div>

                            <div class="brand">

                                <div>
                                    <li><a href="../Electronics/Xiaomi.php">Xiaomi</a></li>
                                    <span>Mobiles</span>
                                </div>
                            </div>

                            <div class="brand">

                                <div>
                                    <li><a href="../Electronics/Honor.php">Honor</a></li>
                                    <span>Mobiles</span>
                                </div>
                            </div>

                            <div class="brand">

                                <div>
                                    <li><a href="../Electronics/Oppo.php">Oppo</a></li>
                                    <span>Mobiles</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </section>


    <!-- Products Section -->
    <section class="products-container">
        <!-- Name of page -->
        <div class="Name">
            <h1>Mob<span>iles</span></h1>
        </div>

        <!-- brands -->
        <div class="brand-products">
            <div class="brands-name">
                <h3>Shop by <span>brand</span></h3>
            </div>

            <div class="brand-img">
                <a href="../Electronics/Samsung.php"><img src="../imgs/Electronics/Electronics/brand1.png"
                        alt="brand"></a>
                <a href="../Electronics/Honor.php"><img src="../imgs/Electronics/Electronics/brand2.png"
                        alt="brand"></a>
                <a href="../Electronics/Apple.php"><img src="../imgs/Electronics/Electronics/brand11.png"
                        alt="brand"></a>
                <a href="../Electronics/Oppo.php"><img src="../imgs/Electronics/Electronics/brand12.png"
                        alt="brand"></a>
                <a href="../Electronics/Xiaomi.php"><img src="../imgs/Electronics/Electronics/brand13.png"
                        alt="brand"></a>
            </div>
        </div>
        <hr>
        <!-- products -->
        <section class="products section container" id="products">


            <div class="products__container grid">
                <?php
                include '../db_connection.php'; // ملف يحتوي على اتصال قاعدة البيانات

                // الحصول على الفئة "Electronics" (category_id = 1)
                $category_id = 5;

                // جلب معلومات الفئة
                $category_query = $conn->prepare("SELECT * FROM categories WHERE category_id = ?");
                $category_query->bind_param("i", $category_id);
                $category_query->execute();
                $category = $category_query->get_result()->fetch_assoc();

                // جلب المنتجات التابعة للفئة
                $products_query = $conn->prepare("
        SELECT * FROM products 
        WHERE category_id = ? 
        AND stock_quantity > 0
        ORDER BY created_at DESC
    ");
                $products_query->bind_param("i", $category_id);
                $products_query->execute();
                $products = $products_query->get_result();

                if ($products->num_rows > 0) {
                    while ($product = $products->fetch_assoc()) {
                ?>
                        <div class="product__item">
                            <div class="product__banner">
                                <a href="Detils.php?id=<?= $product['product_id'] ?>" class="product__images">
                                    <img src="<?= $product['image_url_default'] ?>" class="product__img default" />
                                    <img src="<?= $product['image_url_hover'] ?>" class="product__img hover" />
                                </a>

                                <div class="product__actions">
                                    <a class="action__btn quick-view" aria-label="Quick View" href="../Detils.php?id=<?= $product['product_id'] ?>">
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

                                <button class="action__btn cart__btn add-to-cart" aria-label="Add To Cart"
                                    data-id="<?= $product['product_id'] ?>"
                                    data-price="<?= $product['price'] ?>">
                                    <i class="fi fi-rr-shopping-bag-add"></i>
                                </button>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo '<div class="alert alert-info">No products found in category</div>';
                }
                ?>
            </div>

        </section>
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
            <button class="checkout-btn" onclick="goToCheckout()">Proceed to Checkout</button>
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
                                    <a href="../Electronics.php" class="text-decoration-none link-secondary">Electronics</a>
                                </li>
                                <li class="mb-2">
                                    <a href="../Fashion.php" class="text-decoration-none link-secondary">Fashion</a>
                                </li>
                                <li class="mb-2">
                                    <a href="../home.php" class="text-decoration-none link-secondary">Home & kitchen</a>
                                </li>
                                <li class="mb-2">
                                    <a href="../Vehicles.php" class="text-decoration-none link-secondary">Vehicles</a>
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



    <!-- link js page -->
    <script src="../js/Electornics.js"></script>
</body>

</html>