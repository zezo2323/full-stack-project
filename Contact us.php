
<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact US</title>
    <link rel="stylesheet" href="./css/Contact us .css">
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
    <!-- FontAwesome 6.2.0 CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .btn-custom {
            background-color: var(--first-color);
        }

        /*============================================ Top Promotion Bar =============================================*/
        .promotion-bar {
            background: var(--first-color);
            color: white;
            padding: 8px 0;
            transition: transform 0.3s ease;
        }

        /* Main Navigation */
        .main-nav {
            background: white;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }


        /*============================================ Bottom Navigation =============================================*/
        .bottom-nav {
            background: #f8f9fa;
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /*============================================ Search Bar =============================================*/
        .search-box {
            max-width: 500px;
            border: 2px solid #eee;
            border-radius: 30px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .search-input {
            border-radius: 25px;
            padding: 8px 20px;
            border: 2px solid #ddd;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            border-color: var(--first-color);
            box-shadow: 0 0 10px rgba(42, 92, 69, 0.2);
        }

        .search-box:hover {
            border-color: var(--first-color);
            box-shadow: 0 5px 15px rgba(42, 92, 69, 0.2);
        }

        .search-btn {
            background-color: var(--first-color) !important;
            border-color: var(--first-color) !important;
            color: white !important;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background-color: #1f4735 !important;
            border-color: #1f4735 !important;
        }



        /*============================================ Icons =============================================*/
        .nav-icon {
            font-size: 1.2rem;
            color: var(--first-color);
            margin-left: 1.5rem;
            transition: all 0.3s ease;
        }

        .nav-icon:hover {
            color: var(--first-color);
            transform: translateY(-2px);
        }

        /* Navigation Links */
        .nav-link {
            color: #555 !important;
            font-weight: 500;
            margin: 0 1rem;
            position: relative;
        }

        .nav-link:hover::after {
            content: "";
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--first-color);
        }

        /*============================================ Responsive Design =============================================*/
        @media (max-width: 992px) {
            .bottom-nav .nav-link {
                display: none;
            }

            .search-container {
                max-width: 100%;
            }
        }

        /*============================================ Sidebar =============================================*/
        .sidebar {
            position: fixed;
            top: 0;
            left: -320px;
            width: 320px;
            height: 100vh;
            background: white;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.1);
            z-index: 9999;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar-header {
            padding: 1rem;
            background: var(--first-color);
            color: white;
        }

        .sidebar-category {
            border-bottom: 1px solid #eee;
            padding: 1rem;
        }

        .sub-menu {
            display: none;
            padding-left: 1rem;
        }

        .sidebar-category.active .sub-menu {
            display: block;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-menu {
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 5px;
            min-width: 200px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .badge-custom {
            position: absolute;
            background-color: var(--first-color);
            color: white;
            padding: 1px 6px;
            font-size: 12px;
            border-radius: 50%;
            text-decoration: none;
            top: -15px;
            right: -27px;
        }

        /* تحسينات للجوال */
        @media (max-width: 992px) {
            .bottom-nav .nav-link {
                display: none;
            }

            .dropdown {
                position: absolute !important;
                right: 0 !important;
                left: auto !important;
                bottom: 15px;
                width: auto !important;
            }
        }

        .sidebar {
            width: 40%;
            left: -100%;
        }

        .btn-custom {
            background-color: var(--first-color) !important;
            border-color: var(--first-color) !important;
            color: white !important;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #1f4735 !important;
            border-color: #1f4735 !important;
            transform: translateY(-2px);
        }

        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -5px;
            margin-left: 0.1rem;
            display: none;
        }


        .dropdown-submenu:hover>.dropdown-menu {
            display: block;
        }


        @media (max-width: 991px) {
            .dropdown-submenu .dropdown-menu {
                left: 0;
                right: auto;
                width: 100%;
            }

            .dropdown-submenu:active>.dropdown-menu {
                display: block;
            }

        }

        @media (max-width: 896px) {
            #categoriesDropdown {
                display: none;
            }

            .badge-custom {
                top: -15px;
                right: -10px;
                font-size: 10px;
                padding: 1px 6px;
            }
        }

        @media (max-width: 768px) {


            .nav-icon {
                right: 10px;
            }
        }
    </style>
</head>

<body>
<section>
        <!-- =====================================Promotion Bar ===================================== -->
        <div class="promotion-bar">
        <div class="container d-flex justify-content-between align-items-center">
            <span>
                <?php if (isset($_SESSION['user_id']) && isset($_SESSION['username'])): ?>
                    hello <?php echo htmlspecialchars($_SESSION['username']); ?> -
                <?php endif; ?>
                🎁 Get 10% off your first order! Use code: WELCOME10
            </span>
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
                        <div id="searchSuggestions" class="position-absolute w-100 bg-white shadow-sm rounded-bottom d-none" style="z-index:99999999 ;"></div>
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
                    <a href="./index.php#products" class="nav-link">Products</a>
                    <a href="./index.php#deals" class="nav-link">Deals</a>
                    <a href="./index.php#About" class="nav-link">About</a>
                    <a href="./Contact us.php" class="nav-link">Contact US</a>
                    <a href="./index.php#NewArrivals" class="nav-link">NewArrivals</a>
                    <a href="./index.php#showcase" class="nav-link">showcase</a>
                </div>
                <!-- Categories Dropdown -->
                <div class="dropdown me-4">
                    <button class="btn btn-custom dropdown-toggle rounded-pill px-4" data-bs-toggle="dropdown">
                        <i class="far fa-user"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <?php if ($isLoggedIn): ?>
                            <!-- روابط للمستخدمين المسجلين دخولهم -->
                            <li>
                                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                                    <a class="dropdown-item" href="./Admin Dashboard/dash.html">Profile</a>
                                <?php else: ?>
                                    <a class="dropdown-item" href="./user_profile.php">Profile</a>
                                <?php endif; ?>
                            </li>
                            <li><a class="dropdown-item" href="/login/auth.php?action=logout">Logout</a></li>
                        <?php else: ?>
                            <!-- روابط لغير المسجلين دخولهم -->
                            <li><a class="dropdown-item" href="/login/auth.php?mode=login">Login</a></li>
                            <li><a class="dropdown-item" href="/login/auth.php?mode=choose">Signup</a></li>
                        <?php endif; ?>
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
                            <a href="./index.php" class="d-block py-2">Home</a>
                            <a href="./index.php#products" class="d-block py-2">Products</a>
                            <a href="./Contact-us.html" class="d-block py-2">Contact us</a>
                            <a href="./index.php#About" class="d-block py-2">About</a>
                            <a href="./index.php#NewArrivals" class="nav-link">NewArrivals</a>
                            <a href="./index.php#deals" class="d-block py-2">Deals</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</section>
    <div class="container contact">
        <span class="big-circle"></span>
        <img src="Contact us.img/shape.png" class="square" alt>
        <div class="form">
            <div class="contact-info">
                <h3 class="title">Let's get in touch</h3>
                <p class="text">Lorem ipsum dolor, sit amet consectetur
                    adipisicing elit. Nobis tenetur necessitatibus iusto
                    laboriosam maiores.</p>
                <div class="info">
                    <div class="information">
                        <img
                            src="./imgs/Location-removebg-preview.png"
                            class="icon" alt>
                        <p>92 Cherry Drive Uniondale, NY 11553</p>
                    </div>
                    <div class="information">
                        <img src="./imgs/email-removebg-preview.png"
                            class="icon" alt>
                        <p>lorem@ipsum.com</p>
                    </div>
                    <div class="information">
                        <img src="./imgs/phone-removebg-preview.png"
                            class="icon" alt>
                        <p>123-456-789</p>
                    </div>
                </div>
                <div class="social-media">
                    <p>Connect with us :</p>
                    <div class="social-icons">
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
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="contact-form">
                <span class="circle one"></span>
                <span class="circle two"></span>

                <!-- استخدام FormSubmit.co بدلاً من معالجة PHP -->
                <form action="https://formsubmit.co/zeyadawad246@gmail.com" method="POST">
                    <h3 class="title">Contact us</h3>

                    <!-- حقول مخفية لتكوين FormSubmit -->
                    <input type="hidden" name="_next" value="http://localhost/full-stack-project/Contact thanks.html">
                    <input type="hidden" name="_subject" value="New Contact Form Submission">
                    <input type="hidden" name="_captcha" value="false">

                    <div class="input-container">
                        <input type="text" name="name" class="input" required>
                        <label for>Username</label>
                        <span>Username</span>
                    </div>
                    <div class="input-container">
                        <input type="email" name="email" class="input" required>
                        <label for>Email</label>
                        <span>Email</span>
                    </div>
                    <div class="input-container">
                        <input type="tel" name="phone" class="input" required>
                        <label for>Phone</label>
                        <span>Phone</span>
                    </div>
                    <div class="input-container textarea">
                        <textarea name="message" class="input" required></textarea>
                        <label for>Message</label>
                        <span>Message</span>
                    </div>
                    <input type="submit" value="Send" class="btn">
                </form>
            </div>
        </div>
    </div>

    <!-- ===================================== JavaScript ===================================== -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!--  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- (Optional) Use CSS or JS implementation -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"
        integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://kit.fontawesome.com/64d58efce2.js"
        crossorigin="anonymous"></script>
    <script src="./js/Contact us .js"></script>
</body>