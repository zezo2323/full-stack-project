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








document.addEventListener('DOMContentLoaded', function() {
    // Load cart data
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    let cartTotal = parseFloat(localStorage.getItem('cartTotal')) || 0;
  
    // Display cart items
    renderCartItems(cart);
    
    // Event listeners
    document.getElementById('nextBtn').addEventListener('click', proceedToBilling);
    document.addEventListener('click', handleCartActions);
  });
  
  // Render grouped cart items
  function renderCartItems(cart) {
    const tableBody = document.querySelector('#summary-table tbody');
    tableBody.innerHTML = '';
    
    if (cart.length === 0) {
      tableBody.innerHTML = '<tr><td colspan="5">Your cart is empty</td></tr>';
      return;
    }
  
    cart.forEach(item => {
      const row = document.createElement('tr');
      row.dataset.id = item.id;
      row.innerHTML = `
        <td>${item.title}</td>
        <td>
          <input type="number" class="quantity-input" 
                 value="${item.quantity}" 
                 min="1">
        </td>
        <td class="item-price">$${item.price.toFixed(2)}</td>
        <td class="item-total">$${(item.price * item.quantity).toFixed(2)}</td>
        <td><img src="${item.image}" alt="${item.title}" width="50"></td>
        <td>
          <button class="remove-btn" data-id="${item.id}">
            <i class="fas fa-trash"></i>
          </button>
        </td>
      `;
      tableBody.appendChild(row);
    });
  
    // Add event listeners to quantity inputs
    document.querySelectorAll('.quantity-input').forEach(input => {
      input.addEventListener('change', updateItemQuantity);
    });
  
    updateCartTotal(cart);
  }
  
  // Update quantity and recalculate
  function updateItemQuantity(e) {
    const newQuantity = parseInt(e.target.value) || 1;
    const row = e.target.closest('tr');
    const itemId = row.dataset.id;
    const price = parseFloat(row.querySelector('.item-price').textContent.replace('$', ''));
    
    // Update total for this item
    const itemTotal = price * newQuantity;
    row.querySelector('.item-total').textContent = `$${itemTotal.toFixed(2)}`;
    
    // Update cart in localStorage
    updateCartItemQuantity(itemId, newQuantity);
  }
  
  function updateCartItemQuantity(itemId, newQuantity) {
    let cart = JSON.parse(localStorage.getItem('cart'));
    const itemIndex = cart.findIndex(item => item.id == itemId);
    
    if (itemIndex !== -1) {
      cart[itemIndex].quantity = newQuantity;
      localStorage.setItem('cart', JSON.stringify(cart));
      updateCartTotal(cart);
    }
  }
  
  // Handle remove button clicks
  function handleCartActions(e) {
    if (e.target.closest('.remove-btn')) {
      const itemId = e.target.closest('.remove-btn').dataset.id;
      removeCartItem(itemId);
    }
  }
  
  function removeCartItem(itemId) {
    let cart = JSON.parse(localStorage.getItem('cart'));
    cart = cart.filter(item => item.id != itemId);
    
    localStorage.setItem('cart', JSON.stringify(cart));
    renderCartItems(cart);
    
    // Update cart total in localStorage
    const newTotal = calculateCartTotal(cart);
    localStorage.setItem('cartTotal', newTotal);
  }
  
  // Calculate and update total
  function updateCartTotal(cart) {
    const total = cart.reduce((sum, item) => 
      sum + (item.price * item.quantity), 0);
    
    document.getElementById('total-price').textContent = total.toFixed(2);
    localStorage.setItem('cartTotal', total);
  }
  
  function calculateCartTotal(cartItems) {
    return cartItems.reduce((total, item) => 
      total + (item.price * item.quantity), 0);
  }
  
  // Proceed to billing
  function proceedToBilling() {
    // Update quantities in case any were changed
    document.querySelectorAll('.quantity-input').forEach(input => {
      const row = input.closest('tr');
      const itemId = row.dataset.id;
      const newQuantity = parseInt(input.value) || 1;
      updateCartItemQuantity(itemId, newQuantity);
    });
    
    document.getElementById('summary').style.display = 'none';
    document.getElementById('billing').style.display = 'block';
  }
  
  // Rest of your checkout functions...