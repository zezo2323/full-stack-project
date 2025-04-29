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