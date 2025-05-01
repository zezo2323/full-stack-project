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