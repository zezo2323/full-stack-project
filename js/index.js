
    // Close promotion bar
    document.querySelector(".close-promo").addEventListener("click", () => {
      document.querySelector(".promotion-bar").style.display = "none";
    });

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

    // Mobile menu toggle
    const mobileMenuButton = document.createElement("button");
    mobileMenuButton.className = "btn btn-success d-lg-none";
    mobileMenuButton.innerHTML = '<i class="fas fa-bars"></i>';
    document
      .querySelector(".bottom-nav .container")
      .prepend(mobileMenuButton);

    mobileMenuButton.addEventListener("click", () => {
      document
        .querySelector(".categories-wrapper .dropdown-menu")
        .classList.toggle("show");
    });

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

