document.getElementById("nextBtn").addEventListener("click", function() {
    let product1Quantity = document.getElementById("product1-quantity").value;
    let product2Quantity = document.getElementById("product2-quantity").value;
    let product3Quantity = document.getElementById("product3-quantity").value;

    // Store the quantities in localStorage for use in the next pages
    localStorage.setItem("product1", product1Quantity);
    localStorage.setItem("product2", product2Quantity);
    localStorage.setItem("product3", product3Quantity);

    // Show Billing Address page and hide Summary Order
    document.getElementById("summary").style.display = "none";
    document.getElementById("billing").style.display = "block";
});

document.getElementById("nextBilling").addEventListener("click", function() {
    let name = document.getElementById("name").value;
    let address = document.getElementById("address").value;
    let city = document.getElementById("city").value;
    let phone = document.getElementById("phone").value;

    // Store the billing info
    localStorage.setItem("name", name);
    localStorage.setItem("address", address);
    localStorage.setItem("city", city);
    localStorage.setItem("phone", phone);

    // Show Payment Order page and hide Billing Address
    document.getElementById("billing").style.display = "none";
    document.getElementById("payment").style.display = "block";
});

document.getElementById("nextPayment").addEventListener("click", function() {
    let cardNumber = document.getElementById("card-number").value;
    let expDate = document.getElementById("exp-date").value;
    let paymentMethod = document.getElementById("payment-method").value;

    // Store the payment info
    localStorage.setItem("cardNumber", cardNumber);
    localStorage.setItem("expDate", expDate);
    localStorage.setItem("paymentMethod", paymentMethod);

    // Show Complete Order page and hide Payment Order
    document.getElementById("payment").style.display = "none";
    document.getElementById("complete").style.display = "block";

    // Show customer info and order details in Complete Order page
    document.getElementById("customer-name").textContent = localStorage.getItem("name");
    document.getElementById("customer-address").textContent = localStorage.getItem("address");
    document.getElementById("customer-city").textContent = localStorage.getItem("city");
    document.getElementById("customer-phone").textContent = localStorage.getItem("phone");
    document.getElementById("customer-card-number").textContent = localStorage.getItem("cardNumber");
    document.getElementById("customer-payment-method").textContent = localStorage.getItem("paymentMethod");

    document.getElementById("product1-qty").textContent = localStorage.getItem("product1");
    document.getElementById("product2-qty").textContent = localStorage.getItem("product2");
    document.getElementById("product3-qty").textContent = localStorage.getItem("product3");

    let total = (localStorage.getItem("product1") * 500) + (localStorage.getItem("product2") * 800) + (localStorage.getItem("product3") * 150);
    document.getElementById("final-total").textContent = total;
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
      document.body.addEventListener('click', function (e) {
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
          cart.push({ ...product, quantity: 1 });
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
      document.querySelector('.nav-icon[href="#userDropdown"]').addEventListener('click', function (e) {
        e.preventDefault();
        document.getElementById('userDropdown').classList.toggle('active');
      });
  