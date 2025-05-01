<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicles</title>
    <link rel="stylesheet" href="./css/Electronics.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- favicon -->
    <link rel="shortcut icon" href="./imgs/index/favicon.png" type="image/x-icon">
    <!-- link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- flaticon -->
    <link rel="stylesheet"
        href="https://cdn-uicons.flaticon.com/2.6.0/uicons-solid-rounded/css/uicons-solid-rounded.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet"
        href="https://cdn-uicons.flaticon.com/2.6.0/uicons-thin-straight/css/uicons-thin-straight.css" />
    <link rel="stylesheet"
        href="https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css" />
</head>

<body>
    <!-- Navbar -->
    <nav></nav>

    <!-- Sidebar Filters -->

    <section class="slider">
        <div class="container">
            <h2>Filters</h2>
            <div class="box">
                <h3>Category</h3>
                <ul class="category-list">
                    <ul class="category">
                        <li class="has-submenu">
                            <a href=#><span>cars <i class="fa-solid fa-car-side"></i></span></a>
                            <span class="arrow">▶</span>
                            <ul class="subcategory">
                                <li><a href="#">Mercedes</a></li>
                                <li><a href="#">BMW</a></li>
                                <li><a href="#">Audi</a></li>
                                <li><a href="#">Škoda</a></li>
                                <li><a href="#">Kia</a></li>
                            </ul>


                        <li class="has-submenu">
                            <a href="#"><span>Motorcycle<i class="fa-solid fa-motorcycle"></i></span></a>
                            <span class="arrow">▶</span>
                            <ul class="subcategory">
                                <li><a href="#">Harley-Davidson</a></li>
                                <li><a href="#">Zero Motorcycles</a></li>
                                <li><a href="#">Aprilia</a></li>
                            </ul>

                        <li class="has-submenu">
                            <a href="#"><span>Bicycles <i class="fa-solid fa-bicycle"></i></span></a>
                            <span class="arrow">▶</span>
                            <ul class="subcategory">
                                <li><a href="#">3T</a></li>
                                <li><a href="#">6KU</a></li>
                                <li><a href="#">Alan Bike</a></li>
                                <li><a href="#">ALchemy Bike</a></li>
                                <li><a href="#">Argon 18</a></li>
                            </ul>
                        </ul>    







                        
                <div class="box">
                    <h3>Filter by Price</h3>
                    <ul class="price-filter">
                        <li><label><input type="checkbox" name="price" value="50" onclick="applyFilters()"> Up to
                                EGP 500k</label></li>
                        <li><label><input type="checkbox" name="price" value="100" onclick="applyFilters()"> EGP 500k
                                to
                                EGP 700k</label></li>
                        <li><label><input type="checkbox" name="price" value="300" onclick="applyFilters()"> EGP 700k
                                to
                                EGP 1M</label></li>
                        <li><label><input type="checkbox" name="price" value="1500" onclick="applyFilters()"> EGP
                                1M
                                to
                                EGP 5M</label></li>
                        <li><label><input type="checkbox" name="price" value="2500" onclick="applyFilters()"> EGP
                                5M
                                to
                                EGP 20M</label></li>
                        <li><label><input type="checkbox" name="price" value="above" onclick="applyFilters()"> EGP
                               30M
                                &
                                above</label></li>
                    </ul>

                    <div class="box">
                        <h3>Brands</h3>
                        <div class="brand">

                            <div>
                                <li><a href="#">Mercedes</a></li>
                                <span>CARS</span>
                            </div>
                        </div>

                        <div class="brand">

                            <div>
                                <li><a href="#">BMW</a></li>
                                <span>CARS</span>
                            </div>
                        </div>

                        <div class="brand">

                            <div>
                                <li><a href="#">Audi</a></li>
                                <span>CAR</span>
                            </div>
                        </div>

                        <div class="brand">

                            <div>
                                <li><a href="#">Harley-Davidson</a></li>
                                <span>Motorcycle</span>
                            </div>
                        </div>

                        <div class="brand">

                            <div>
                                <li><a href="#">Aprilia</a></li>
                                <span>Motorcycle</span>
                            </div>
                        </div>

                        <div class="brand">

                            <div>
                                <li><a href="#">3T</a></li>
                                <span>Bicycles</span>
                            </div>
                        </div>

                        <div class="brand">

                            <div>
                                <li><a href="#">6KU</a></li>
                                <span>Bicycles</span>
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
            <h1>VEHIC<span>LES</span></h1>
        </div>
        <!-- banners -->
        <div class="banners">
            <img src="./imgs/vihcles/PLB-HOMEPAGE-SF1-Lv2.jpg" width="1000px" height="300px" alt="banner">
        </div>
        <!-- posters -->
        <div class="posters">
            <a href="#"><img src="./imgs/vihcles/Aprilia_RS660-Factory_Box_1920x2560_Intera_1.jpg" width="500px" height="400px" alt="poster"></a>
            <a href="#"><img src="./imgs/vihcles/Bicycle-Background-Full-HD.jpg" width="489px" alt="poster"></a>
        </div>
        <hr>
        <!-- brands -->
        <div class="brand-products">
            <div class="brands-name">
                <h3>Shop by <span>brand</span></h3>
            </div>

            <div class="brand-img">
                <a href="#"><img src="./imgs/vihcles/Mercedes-Benz-Logo.png"
                        alt="brand"></a>
                <a href="#"><img src="./imgs/vihcles/bmw-brands-logo-image-1.png" alt="brand"></a>
                <a href="#"><img src="./imgs/vihcles/audi-logo-png-audi-logo-rings-symbol-4880.png.crdownload" alt="brand"></a>
                <a href="#"><img src="./imgs/vihcles/car_logo_PNG1664.png"
                        alt="brand"></a>
                <a href="#"><img src="./imgs/vihcles/575724_v1-scaled.jpg.crdownload"
                        alt="brand"></a>
                <a href="#"><img src="./imgs/vihcles/Harley-Davidson-7-scaled.jpeg" alt="brand"></a>
                <a href="#"><img src="./imgs/vihcles/Aprilia-Logo.jpg"
                        alt="brand"></a>
                <a href="#"><img src="./imgs/vihcles/2f422df8723b53dbe7acf8bdb54d383c.png" alt="brand"></a>
                <a href="#"><img src="./imgs/vihcles/6ku_logo.webp"
                        alt="brand"></a>
                <a href="#"><img src="./imgs/vihcles/th (1).jpg"
                        alt="brand"></a>
            </div>
        </div>
        <hr>
        
    <section class="products section container" id="products">


<div class="products__container grid">
<?php
include 'db_connection.php'; // ملف يحتوي على اتصال قاعدة البيانات

// الحصول على الفئة "Electronics" (category_id = 1)
$category_id = 4;

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
    while($product = $products->fetch_assoc()) {
        ?>
        <div class="product__item">
            <div class="product__banner">
                <a href="product.php?id=<?= $product['product_id'] ?>" class="product__images">
                    <img src="<?= $product['image_url_default'] ?>" class="product__img default" />
                    <img src="<?= $product['image_url_hover'] ?>" class="product__img hover" />
                </a>

                <div class="product__actions">
                    <button class="action__btn quick-view" aria-label="Quick View" data-id="<?= $product['product_id'] ?>">
                        <i class="fi fi-rr-eye"></i>
                    </button>
                    <button class="action__btn add-wishlist" aria-label="Add To Wishlist" data-id="<?= $product['product_id'] ?>">
                        <i class="fi fi-rr-heart"></i>
                    </button>
                    <button class="action__btn compare" aria-label="Compare" data-id="<?= $product['product_id'] ?>">
                        <i class="fi fi-rr-shuffle"></i>
                    </button>
                </div>

                <?php if($product['badge_id']): ?>
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
                    <a href="product.php?id=<?= $product['product_id'] ?>">
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
    echo '<div class="alert alert-info">No products found in Electronics category</div>';
}
?>
</div>






</section>
    </section>





</body>

</html>