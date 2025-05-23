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
                    </div>
                </div>
            </div>
    </section>


    <!-- Products Section -->
    <section class="products-container">
        <!-- Name of page -->
        <div class="Name">
            <h1>App<span>les</span></h1>
        </div>
        <hr>
        <!-- products -->

    </section>
    <!-- Footer -->
    <footer></footer>


    <!-- link js page -->
    <script src="../js/Electornics.js"></script>

</body>

</html>