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

document.getElementById("nextPayment").addEventListener("click", function () {
  const paymentMethod = document.getElementById('payment-method').value;

  if (paymentMethod === 'credit-card') {
    const cardNumber = document.getElementById('card-number').value.trim();
    const expDate = document.getElementById('exp-date').value.trim();

    if (!cardNumber || !expDate) {
      alert('Please fill in all Visa details to proceed.');
      return;
    }

    // Store Visa details
    localStorage.setItem('cardNumber', cardNumber);
    localStorage.setItem('expDate', expDate);
  }

  // Store payment method
  localStorage.setItem('paymentMethod', paymentMethod);

  // Show Complete Order page and hide Payment Order
  document.getElementById('payment').style.display = 'none';
  document.getElementById('complete').style.display = 'block';

  // Show customer info and order details in Complete Order page
  showCompletePage();
});

function toggleVisaFields() {
  const paymentMethod = document.getElementById('payment-method').value;
  const visaFields = document.getElementById('visa-fields');

  if (paymentMethod === 'credit-card') {
    visaFields.style.display = 'block'; // عرض حقول الفيزا
  } else {
    visaFields.style.display = 'none'; // إخفاء حقول الفيزا
  }
}

let cart = JSON.parse(localStorage.getItem('cart')) || [];

document.addEventListener('DOMContentLoaded', function () {
  renderCartItems();
  setupEventListeners();
});

function renderCartItems() {
  const tableBody = document.querySelector('#summary-table tbody');
  
  if (!tableBody) {
    console.error('Table body not found');
    return;
  }

  tableBody.innerHTML = '';

  if (cart.length === 0) {
    tableBody.innerHTML = '<tr><td colspan="5">Your cart is empty</td></tr>';
    document.getElementById('nextBtn').disabled = true;
    return;
  }

  document.getElementById('nextBtn').disabled = false;
  const groupedItems = groupItems(cart);

  Object.values(groupedItems).forEach(item => {
    const row = document.createElement('tr');
    row.dataset.id = item.id;
    row.innerHTML = `
      <td>${item.title}</td>
      <td>
        <input type="number" class="quantity-input" 
               value="${item.quantity}" min="1">
      </td>
      <td>$${item.price.toFixed(2)}</td>
      <td><img src="${item.image}" alt="${item.title}" width="50"></td>
      <td>
        <button class="remove-btn" data-id="${item.id}">
          <i class="fas fa-trash"></i>
        </button>
      </td>
    `;
    tableBody.appendChild(row);
  });

  updateTotal();
}

function groupItems(items) {
  return items.reduce((acc, item) => {
    const key = `${item.id}-${item.title}`;
    if (!acc[key]) {
      acc[key] = { ...item };
    } else {
      acc[key].quantity += item.quantity;
    }
    return acc;
  }, {});
}

function setupEventListeners() {
  document.getElementById('nextBtn').addEventListener('click', () => proceedToNextStep('summary', 'billing'));
  document.getElementById('nextBilling').addEventListener('click', () => proceedToNextStep('billing', 'payment'));
  document.getElementById('nextPayment').addEventListener('click', () => proceedToNextStep('payment', 'complete'));

  // أزرار الرجوع
  document.getElementById('prevBilling').addEventListener('click', () => goToPreviousStep('billing', 'summary'));
  document.getElementById('prevPayment').addEventListener('click', () => goToPreviousStep('payment', 'billing'));
  document.getElementById('prevComplete').addEventListener('click', () => goToPreviousStep('complete', 'payment'));

  document.addEventListener('click', function(e) {
    if (e.target.closest('.remove-btn')) {
      const productId = e.target.closest('.remove-btn').dataset.id;
      removeItem(productId);
    }
  });

  document.addEventListener('change', function(e) {
    if (e.target.classList.contains('quantity-input')) {
      updateQuantity(e.target);
    }
  });
}

function validateStep(currentStep) {
  let isValid = true;

  if (currentStep === 'summary') {
    if (cart.length === 0) {
      isValid = false;
      alert('Your cart is empty. Please add items to proceed.');
    }
  } else if (currentStep === 'billing') {
    const name = document.getElementById('name').value.trim();
    const address = document.getElementById('address').value.trim();
    const city = document.getElementById('city').value.trim();
    const phone = document.getElementById('phone').value.trim();

    if (!name || !address || !city || !phone) {
      isValid = false;
      alert('Please fill in all billing details to proceed.');
    }
  } else if (currentStep === 'payment') {
    const cardNumber = document.getElementById('card-number').value.trim();
    const expDate = document.getElementById('exp-date').value.trim();
    const paymentMethod = document.getElementById('payment-method').value;

    if (!cardNumber || !expDate || !paymentMethod) {
      isValid = false;
      alert('Please fill in all payment details to proceed.');
    }
  }

  return isValid;
}

function proceedToNextStep(currentStep, nextStep) {
  if (!validateStep(currentStep)) {
    return; // إذا لم يتم إدخال البيانات بشكل صحيح، يبقى المستخدم في نفس الصفحة
  }

  markStepAsComplete(currentStep);

  document.getElementById(currentStep).style.display = 'none';
  document.getElementById(nextStep).style.display = 'block';

  if (nextStep === 'complete') {
    showCompletePage();
  }
}

function goToPreviousStep(currentStep, previousStep) {
  // إزالة علامة الصح من الخطوة الحالية
  removeStepCompleteMark(currentStep);

  // عرض الخطوة السابقة
  document.getElementById(currentStep).style.display = 'none';
  document.getElementById(previousStep).style.display = 'block';
}

function markStepAsComplete(step) {
  const stepLink = document.querySelector(`nav ul li a[href="#${step}"]`);
  if (stepLink) {
    stepLink.innerHTML = stepLink.textContent.replace('✔', '').trim() + ' ✔';
  }
}

function removeStepCompleteMark(step) {
  const stepLink = document.querySelector(`nav ul li a[href="#${step}"]`);
  if (stepLink) {
    stepLink.innerHTML = stepLink.textContent.replace('✔', '').trim();
  }
}

function saveBillingData() {
  const billing = {
    name: document.getElementById('name').value.trim(),
    address: document.getElementById('address').value.trim(),
    city: document.getElementById('city').value.trim(),
    phone: document.getElementById('phone').value.trim()
  };
  localStorage.setItem('billing', JSON.stringify(billing));
}

function savePaymentData() {
  const payment = {
    cardNumber: document.getElementById('card-number').value.trim(),
    expDate: document.getElementById('exp-date').value.trim(),
    paymentMethod: document.getElementById('payment-method').value
  };
  localStorage.setItem('payment', JSON.stringify(payment));
}

function showCompletePage() {
  const billing = JSON.parse(localStorage.getItem('billing')) || {};
  const payment = JSON.parse(localStorage.getItem('payment')) || {};
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  const orderSummary = document.getElementById('final-order-summary');

  // عرض بيانات العميل
  document.getElementById('customer-name').textContent = billing.name || 'N/A';
  document.getElementById('customer-address').textContent = billing.address || 'N/A';
  document.getElementById('customer-city').textContent = billing.city || 'N/A';
  document.getElementById('customer-phone').textContent = billing.phone || 'N/A';
  document.getElementById('customer-card-number').textContent = payment.cardNumber || 'N/A';
  document.getElementById('customer-payment-method').textContent =
    payment.paymentMethod === 'credit-card' ? 'Visa' : 'Cash on Delivery';

  // عرض ملخص الطلب
  orderSummary.innerHTML = '';
  if (cart.length === 0) {
    orderSummary.innerHTML = '<p>Your cart is empty.</p>';
  } else {
    cart.forEach(item => {
      const p = document.createElement('p');
      p.innerHTML = `<strong>${item.title}</strong>: ${item.quantity} x $${item.price.toFixed(2)} = $${(item.price * item.quantity).toFixed(2)}`;
      orderSummary.appendChild(p);
    });
  }

  // حساب الإجمالي
  const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
  document.getElementById('final-total').textContent = `$${total.toFixed(2)}`;
}

function removeItem(productId) {
  cart = cart.filter(item => item.id != productId);
  localStorage.setItem('cart', JSON.stringify(cart));
  renderCartItems();
  showNotification('Item removed from cart');
}

function updateQuantity(input) {
  const productId = input.closest('tr').dataset.id;
  const newQuantity = parseInt(input.value) || 1;

  cart = cart.map(item => {
    if (item.id == productId) {
      return { ...item, quantity: newQuantity };
    }
    return item;
  });

  localStorage.setItem('cart', JSON.stringify(cart));
  renderCartItems();
}

function updateTotal() {
  const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
  document.getElementById('total-price').textContent = total.toFixed(2);
}

function showError(message) {
  const errorElement = document.getElementById('error-message');
  errorElement.textContent = message;
  errorElement.style.display = 'block';
}

function hideError() {
  const errorElement = document.getElementById('error-message');
  errorElement.style.display = 'none';
}

function showNotification(message) {
  const notification = document.createElement('div');
  notification.className = 'notification';
  notification.textContent = message;
  notification.style.cssText = `
    position: fixed;
    top: 20px;
    right: 20px;
    background: #28a745;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    z-index: 1000;
  `;
  document.body.appendChild(notification);

  setTimeout(() => {
    notification.remove();
  }, 2000);
}

function initMap() {
  const myLocation = { lat: -34.397, lng: 150.644 }; // قم بتغيير الإحداثيات حسب موقعك
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 8,
    center: myLocation,
  });
  new google.maps.Marker({
    position: myLocation,
    map: map,
  });
}