  document.addEventListener('DOMContentLoaded', function() {
  // Product image slider
  const imgs = document.querySelectorAll('.img-select a');
  const imgBtns = [...imgs];
  let imgId = 1;
  imgBtns.forEach((imgItem) => {
  imgItem.addEventListener('click', (event) => {
  event.preventDefault();
  imgId = imgItem.dataset.id;
  slideImage();
  });
  });
  function slideImage() {
  const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;
  document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
  }
  // Window resize event to maintain proper image slider
  window.addEventListener('resize', function() {
  slideImage();
  });
  // Color selector
  const colorBoxes = document.querySelectorAll('.color-box');
  colorBoxes.forEach(box => {
  box.addEventListener('click', () => {
  // Remove selected class from all boxes
  colorBoxes.forEach(b => b.classList.remove('selected'));
  // Add selected class to clicked box
  box.classList.add('selected');
      document.body.style.backgroundColor = box.style.backgroundColor;
  });
  });
  // Tab switching system
  const tabs = document.querySelectorAll('.Details__tab');
  const tabContents = document.querySelectorAll('.tab-content');
  tabs.forEach(tab => {
  tab.addEventListener('click', () => {
  const targetTab = tab.getAttribute('data-tab');
  // Remove active class from all tabs and contents
  tabs.forEach(t => t.classList.remove('active'));
  tabContents.forEach(content => content.classList.remove('active'));
  // Add active class to current tab and content
  tab.classList.add('active');
  document.getElementById(targetTab).classList.add('active');
  });
  });
  // Add to cart functionality
  document.getElementById('add-to-cart').addEventListener('click', function() {
  addToCart();
  });
  // Buy now functionality
  document.getElementById('buy-now').addEventListener('click', function() {
  buyNow();
  });
  function addToCart() {
  const quantity = document.getElementById('quantity').value;
  const size = document.getElementById('size-select').value;
  let color = 'Yellow'; // Default
  colorBoxes.forEach(box => {
  if (box.classList.contains('selected')) {
  color = box.getAttribute('data-color');
  }
  });
  // Here you would typically add the item to cart using an API call
  alert(`Added ${quantity} item(s) to cart.\nSize: ${size}\nColor: ${color}`);
  }
  function buyNow() {
  addToCart();
  // Then redirect to checkout
  alert('Redirecting to checkout...');
  // window.location.href = '/checkout'; // Uncomment in production
  }
  // Review form submission
  document.getElementById('review-form').addEventListener('submit', function(e) {
  e.preventDefault();
  const formData = new FormData(this);
  // Here you would typically submit the review data
  alert('Thank you for your review! It will be published after moderation.');
  this.reset();
  });
  // Initialize: Select first color by default
  colorBoxes[0].classList.add('selected');
  });