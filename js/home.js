//  drop-down-bar 

document.addEventListener("DOMContentLoaded", function() {
    let menuItems = document.querySelectorAll(".has-submenu");

    menuItems.forEach(item => {
        item.addEventListener("mouseenter", function() {
            this.querySelector(".subcategory").style.display = "block";
        });

        item.addEventListener("mouseleave", function() {
            this.querySelector(".subcategory").style.display = "none";
        });
    });
});




// Filters 

function applyFilters() {
    let selectedCategories = [...document.querySelectorAll("input[name='category']:checked")].map(el => el.value);
    let selectedPrices = [...document.querySelectorAll("input[name='price']:checked")].map(el => parseInt(el.value) || el.value);
    let selectedBrands = [...document.querySelectorAll("input[name='brand']:checked")].map(el => el.value);

    document.querySelectorAll('.card').forEach(card => {
        let categoryMatch = selectedCategories.length === 0 || selectedCategories.includes(card.dataset.category);
        let priceMatch = selectedPrices.length === 0 || selectedPrices.some(price => checkPriceRange(price, parseInt(card.dataset.price)));
        let brandMatch = selectedBrands.length === 0 || selectedBrands.includes(card.dataset.brand);

        card.style.display = (categoryMatch && priceMatch && brandMatch) ? 'inline-block' : 'none';
    });
}

function checkPriceRange(selectedPrice, cardPrice) {
    if (selectedPrice === "above") return cardPrice >= 2500;
    return cardPrice <= selectedPrice;
}



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
        cart.push({...product, quantity: 1 });
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