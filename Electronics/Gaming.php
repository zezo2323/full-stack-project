<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaming</title>
    <link rel="stylesheet" href="../css/Electronics.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- favicon -->
    <link rel="shortcut icon" href="../imgs/index/favicon.png" type="image/x-icon">
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
                <div class="arrow-left"><a href="../Electronics.html"><i class="fa-solid fa-arrow-left"></i></a></div>
                <h5>Electronics</h5>
                <h3>Category</h3>
                <ul class="category-list">
                    <ul class="category">
                        <li class="has-submenu">
                            <a href="../Electronics/Smart_phones.html"><span>Mobile</span></a>
                            <span class="arrow">▶</span>
                            <ul class="subcategory">
                                <li><a href="../Electronics/Apple.html">Apple</a></li>
                                <li><a href="../Electronics/Samsung.html">Samsung</a></li>
                                <li><a href="../Electronics/Xiaomi.html">Xiaomi</a></li>
                                <li><a href="../Electronics/Honor.html">Honor</a></li>
                                <li><a href="../Electronics/Oppo.html">Oppo</a></li>
                            </ul>


                        <li class="has-submenu">
                            <a href="../Electronics/Televisions.html"><span>Tvs</span></a>
                            <span class="arrow">▶</span>
                            <ul class="subcategory">
                                <li><a href="../Electronics/Tornado.html">Tornado</a></li>
                                <li><a href="../Electronics/LG.html">LG</a></li>
                                <li><a href="../Electronics/Sharp.html">Sharp</a></li>
                                <li><a href="../Electronics/Fresh.html">Fresh</a></li>
                                <li><a href="../Electronics/Toshiba.html">Toshiba</a></li>
                            </ul>

                        <li class="has-submenu">
                            <a href="../Electronics/Computers.html"><span>Computers</span></a>
                            <span class="arrow">▶</span>
                            <ul class="subcategory">
                                <li><a href="../Electronics/HP.html">HP</a></li>
                                <li><a href="../Electronics/Dell.html">Dell</a></li>
                                <li><a href="../Electronics/Lenovo.html">Lenovo</a></li>
                                <li><a href="../Electronics/Mac.html">Mac</a></li>
                                <li><a href="../Electronics/Asus.html">Asus</a></li>
                            </ul>


                        <li class="has-submenu">
                            <a href="../Electronics/Accessories.html"><span>Accessories</span></a>
                            <span class="arrow">▶</span>
                            <ul class="subcategory">
                                <li><a href="../Electronics/Computers_Accessories.html">Computers</a></li>
                                <li><a href="../Electronics/Mobiles_Accessories.html">Mobiles</a></li>
                            </ul>


                        <li><a href="../Electronics/Tablets.html">Tablets</a></li>
                        <li><a href="../Electronics/Cameras.html">Cameras</a></li>


                        <li><a href="../Electronics/Headphones.html">Headphones</a></li>
                        <li><a href="../Electronics/Smart_watches.html">Smart Watches</a></li>
                        <li><a href="../Electronics/Gaming.html">Gaming</a></li>
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
            <h1>Gam<span>ing</span></h1>
        </div>
        <hr>
        <!-- Products -->



        <section class="products section container" id="products">


            <div class="products__container grid">
            <?php
            include '../db_connection.php'; // ملف يحتوي على اتصال قاعدة البيانات
        
            // الحصول على الفئة "Electronics" (category_id = 1)
            $category_id = 13;
        
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

    <!-- Footer -->
    <footer></footer>


    <!-- link js page -->
    <script src="../js/Electornics.js"></script>

</body>

</html>