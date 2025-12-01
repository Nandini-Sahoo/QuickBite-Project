<?php
include_once 'navbar.php';
?> 
<!--container -->
<section class="py-4">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <h1>Fast. Fresh. Delivered.</h1>
        <p class="text-muted">Welcome to QuickBite — simple demo. Use Signup then Login to see personalized navbar.</p>
      </div>
      <div class="col-lg-6 text-center">
        <!-- local image file path (your uploaded file) -->
        <img src="../images/banner.jpg" style="max-width:320px;border-radius:10px;" alt="screenshot">
      </div>
    </div>
  </div>
</section>

<!-- SIMPLE MENU -->
<section id="menu" class="py-3">
  <div class="container">
    <h3>Popular picks</h3>
    <div class="row g-3 mt-2">
      <div class="col-md-4">
        <div class="food-card">
          <img class="food-img" src="https://images.unsplash.com/photo-1548365328-6c42b1b2d0c0?q=80&w=800" alt="">
          <div class="p-3">
            <h5>Margherita Pizza</h5>
            <p class="text-muted small">Mozzarella & basil</p>
            <div class="d-flex justify-content-between">
              <strong>₹299</strong>
              <button class="btn btn-sm btn-orange" onclick="addToCart(1,'Margherita Pizza',299,'https://images.unsplash.com/photo-1548365328-6c42b1b2d0c0?q=80&w=800')">Add</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="food-card">
          <img class="food-img" src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=800" alt="">
          <div class="p-3">
            <h5>Cheeseburger</h5>
            <p class="text-muted small">Cheddar & lettuce</p>
            <div class="d-flex justify-content-between">
              <strong>₹249</strong>
              <button class="btn btn-sm btn-orange" onclick="addToCart(2,'Cheeseburger',249,'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=800')">Add</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="food-card">
          <img class="food-img" src="https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=800" alt="">
          <div class="p-3">
            <h5>Chocolate Brownie</h5>
            <p class="text-muted small">Warm & fudgy</p>
            <div class="d-flex justify-content-between">
              <strong>₹149</strong>
              <button class="btn btn-sm btn-orange" onclick="addToCart(3,'Brownie',149,'https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=800')">Add</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ABOUT -->
<section id="about" class="container py-3">
  <h4>About QuickBite</h4>
  <p class="text-muted">Simple demo to show signup/login flow and navbar state using PHP sessions.</p>
</section>

<!-- FOOTER -->
<footer class="bg-dark py-3 border-top mt-3">
  <div class="container text-center text-white small">
    &copy | 2025 | QuickBite | All Rights Reserved
  </div>
</footer>

<!-- CART MODAL -->
<div class="modal fade" id="cartModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5>Your Cart</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body" id="cart-body">Cart is empty.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" onclick="window.location='cart.php'">Checkout</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Use localStorage so cart persists across pages.
// localStorage key: 'qb_cart' -> array of {id,name,price,qty,img}

const CART_KEY = 'qb_cart';

// load cart from localStorage
function loadCart(){
  try{
    const raw = localStorage.getItem(CART_KEY);
    return raw ? JSON.parse(raw) : [];
  } catch(e){ return []; }
}

// save cart to localStorage and update badge
function saveCart(cart){
  localStorage.setItem(CART_KEY, JSON.stringify(cart));
  updateCartCount();
}

// add item (called by Add buttons)
function addToCart(id, name, price, img){
  const cart = loadCart();
  const found = cart.find(i => i.id === id);
  if(found) found.qty++;
  else cart.push({id, name, price, qty:1, img});
  saveCart(cart);
  // small visual feedback
  alert(name + " added to cart");
}

// update the cart-count badge in navbar
function updateCartCount(){
  const cart = loadCart();
  const count = cart.reduce((s,i)=>s + i.qty, 0);
  const badge = document.getElementById('cart-count');
  if(badge) badge.innerText = count;
}

// open cart modal and render cart items
function openCart(){
  const cart = loadCart();
  const body = document.getElementById('cart-body');
  if(cart.length === 0){
    body.innerHTML = '<p class="text-muted">Cart is empty.</p>';
  } else {
    let html = '<ul class="list-group mb-2">';
    cart.forEach(i => {
      html += `<li class="list-group-item d-flex justify-content-between align-items-center">
        <div>
          <strong>${escapeHtml(i.name)}</strong><br>
          <small class="text-muted">₹${i.price} × ${i.qty}</small>
        </div>
        <div>
          <button class="btn btn-sm btn-outline-secondary" onclick="changeQty(${i.id}, -1)">-</button>
          <button class="btn btn-sm btn-outline-secondary ms-1" onclick="changeQty(${i.id}, 1)">+</button>
          <button class="btn btn-sm btn-danger ms-2" onclick="removeItem(${i.id})">Remove</button>
        </div>
      </li>`;
    });
    html += '</ul>';
    const total = cart.reduce((s,i)=>s + i.price * i.qty, 0);
    html += `<div class="d-flex justify-content-between"><strong>Total</strong><strong>₹${total}</strong></div>`;
    body.innerHTML = html;
  }
  const m = new bootstrap.Modal(document.getElementById('cartModal'));
  m.show();
}

// change quantity for an item
function changeQty(id, delta){
  const cart = loadCart();
  const idx = cart.findIndex(i => i.id === id);
  if(idx === -1) return;
  cart[idx].qty += delta;
  if(cart[idx].qty <= 0) cart.splice(idx,1);
  saveCart(cart);
  openCart(); // refresh modal
}

// remove item completely
function removeItem(id){
  let cart = loadCart();
  cart = cart.filter(i => i.id !== id);
  saveCart(cart);
  openCart();
}

// escape to prevent small XSS from item names (good practice)
function escapeHtml(s){
  return String(s).replace(/[&<>"']/g, function(m){ return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]; });
}

// update badge on page load
document.addEventListener('DOMContentLoaded', updateCartCount);

// Also update badge when storage changes (another tab)
window.addEventListener('storage', function(e){
  if(e.key === CART_KEY) updateCartCount();
});
</script>

</body>
</html>
