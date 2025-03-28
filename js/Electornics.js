//  drop-down-bar 

document.addEventListener("DOMContentLoaded", function () {
    let menuItems = document.querySelectorAll(".has-submenu");

    menuItems.forEach(item => {
        item.addEventListener("mouseenter", function () {
            this.querySelector(".subcategory").style.display = "block";
        });

        item.addEventListener("mouseleave", function () {
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




// Cart
let cart = [];
function open_cart() {
    document.getElementById("cart-product").classList.add("open");
}


function close_cart() {
    document.getElementById("cart-product").classList.remove("open");
}


function add_to_cart(name, price, img) {
    cart.push({ name, price, img });
    update_cart();
    open_cart(); 
}

function remove_from_cart(index) {
    cart.splice(index, 1);
    update_cart();
}

function update_cart() {
    const cart_items = document.getElementById("cart_items");
    cart_items.innerHTML = "";
    let total = 0;


    cart.forEach((item, index) => {
        total += item.price;
        cart_items.innerHTML += `
            <div class="cart-item">
                <img src="${item.img}" alt="">
                <div class="details">
                    <p>${item.name}</p>
                    <p>$${item.price}</p>
                </div>
                <button class="delete-btn" onclick="remove_from_cart(${index})">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        `;
    });
    document.getElementById("cart_total").innerText = `$${total.toFixed(2)}`;
    document.getElementById("cart_count").innerText = `(${cart.length} Items in Cart)`;
}


document.querySelectorAll(".cart-button").forEach(button => {
    button.addEventListener("click", function () {
        let card = this.closest(".card"); 
        let name = card.querySelector(".title").innerText; 
        let price = parseFloat(card.getAttribute("data-price")); 
        let img = card.querySelector("img").src; 
        add_to_cart(name, price, img); 
    });
});

//Modal

function openModal(title, price, images, oldPrice, description) {
    document.getElementById("modalTitle").innerText = title;
    document.getElementById("modalPrice").innerText = "$" + price;
    document.getElementById("modalOldPrice").innerText = "$" + oldPrice;
    document.getElementById("modalDescription").innerText = description;
    document.getElementById("modalImage").src = images[0];

    let thumbnailsDiv = document.getElementById("thumbnails");
    thumbnailsDiv.innerHTML = "";
    images.forEach(img => {
        let imgElem = document.createElement("img");
        imgElem.src = img;
        imgElem.onclick = () => document.getElementById("modalImage").src = img;
        thumbnailsDiv.appendChild(imgElem);
    });

    document.getElementById("productModal").classList.add("open");
    document.getElementById("modalOverlay").classList.add("open");

    document.querySelector(".product-modal .cart-button").onclick = function() {
        add_to_cart(title, parseFloat(price), images[0]);
    };
}

function closeModal() {
    document.getElementById("productModal").classList.remove("open");
    document.getElementById("modalOverlay").classList.remove("open");
}

function addToCart() {
    alert("Product added to cart!");
}

function addToFavorites() {
    alert("Added to favorites!");
}
