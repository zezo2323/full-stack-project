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
