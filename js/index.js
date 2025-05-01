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

/*============================================ category swiper =============================================*/
    //  category swiper
    var swiperCategories = new Swiper(".categories__container", {
      spaceBetween: 24,
      loop: true,

      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 4,
          spaceBetween: 40,
        },
        1400: {
          slidesPerView: 6,
          spaceBetween: 24,
        },
      },
    });

/*============================================ new arrivals swiper =============================================*/
    // new arrivals swiper
    var swiperProducts= new Swiper(".new-arrivals__container", {
      spaceBetween: 24,
      loop: true,

      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 4,
          spaceBetween: 40,
        },
        1400: {
          slidesPerView: 4,
          spaceBetween: 24,
        },
      },
    }); 

/*============================================ product swiper =============================================*/
    //  product swiper
    const tabs = document.querySelectorAll("[data-target]");
    const tabContents = document.querySelectorAll("[data-content]"); // تحديد العناصر باستخدام السمة المخصصة

    tabs.forEach((tab) => {
      tab.addEventListener("click", () => {
        const targetId = tab.dataset.target;
        const target = document.querySelector(targetId);

        // إخفاء جميع المحتويات
        tabContents.forEach((content) => {
          content.classList.remove("active-tab");
        });

        // إظهار المحتوى المحدد
        target.classList.add("active-tab");

        // إزالة النشاط من جميع التبويبات
        tabs.forEach((t) => {
          t.classList.remove("active-tab");
        });

        // تفعيل التبويب الحالي
        tab.classList.add("active-tab");
      });
    });


    // /*============================================ load products =============================================*/
    // async function loadProducts(type, containerId) {
    //   const response = await fetch(`getProducts.php?type=${type}`);
    //   const products = await response.json();
    //   const container = document.getElementById(containerId);
    //   container.innerHTML = '';

    //   products.forEach(product => {
    //     container.innerHTML += `
    //         <div class="product__item">
    //           <div class="product__banner">
    //       <a href="#" class="product__images">
    //         <img src="${product.image_default}" class="product__img default" />
    //         <img src="${product.image_hover}" class="product__img hover" />
    //       </a>
    //             <div class="product__actions">
    //         <a href="#" class="action__btn" aria-label="Quick View"><i class="fi fi-rr-eye"></i></a>
    //         <a href="#" class="action__btn" aria-label="Add To Wishlist"><i class="fi fi-rr-heart"></i></a>
    //         <a href="#" class="action__btn" aria-label="Compare"><i class="fi fi-rr-shuffle"></i></a>
    //             </div>
    //             <div class="product__badge light-pink">Hot</div>
    //           </div>
    //           <div class="product__content">
    //       <span class="product__category">${product.category_name}</span>
    //       <a href="#"><h3 class="product__title">${product.title}</h3></a>
    //             <div class="product__rating">
    //         ${'<i class="fas fa-star"></i>'.repeat(Math.floor(product.rating))}
    //         ${product.rating % 1 ? '<i class="fas fa-star-half-alt"></i>' : ''}
    //             </div>
    //             <div class="product__price flex">
    //         <span class="new__price">$${product.price}</span>
    //         <span class="old__price">$${product.old_price}</span>
    //             </div>
    //       <a href="#" class="action__btn cart__btn" aria-label="Add To Cart"><i class="fi fi-rr-shopping-bag-add"></i></a>
    //           </div>
    //         </div>
    // `;
    //   });
    // }

    // loadProducts('featured', 'featured-container');
    // loadProducts('popular', 'popular-container');
    // loadProducts('new', 'new-added-container');









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
