<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once "navbar.php"; // your navbar
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Cart | QuickBite</title>
    <link rel="stylesheet" href="../asset/bootstrap.min.css">

    <style>
        body { background:#f8f9fa; font-family:Arial; }
        .cart-img { width:70px; height:60px; border-radius:8px; object-fit:cover; }
        .qty-btn { width:30px; height:30px; padding:0; }
    </style>
</head>
<body>

<div class="container mt-4">
    <h3>Your Cart</h3>
    <div id="cartBox" class="mt-3"></div>

    <div class="d-flex justify-content-between mt-3">
        <h5 id="totalBox">Total: ₹0</h5>
        <button class="btn btn-success" onclick="placeOrder()">Place Order</button>
    </div>

    <button class="btn btn-secondary mt-3" onclick="window.location='menu.php'">← Back to Menu</button>
</div>

<script>
// ----------------- CART FUNCTIONS -----------------

function loadCart() {
    let cart = localStorage.getItem("qb_cart");
    return cart ? JSON.parse(cart) : [];
}

function saveCart(cart) {
    localStorage.setItem("qb_cart", JSON.stringify(cart));
}

function renderCart() {
    let cart = loadCart();
    let box = document.getElementById("cartBox");

    if (cart.length === 0) {
        box.innerHTML = "<p class='text-muted'>Your cart is empty.</p>";
        document.getElementById("totalBox").innerText = "Total: ₹0";
        return;
    }

    let html = '<ul class="list-group">', total = 0;

    cart.forEach(item => {
        total += item.price * item.qty;

        html += `
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <img src="${item.img}" class="cart-img">
                    <div>
                        <strong>${item.name}</strong><br>
                        <small>₹${item.price} × ${item.qty}</small>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-outline-dark qty-btn" onclick="changeQty(${item.id}, -1)">-</button>
                    <span>${item.qty}</span>
                    <button class="btn btn-outline-dark qty-btn" onclick="changeQty(${item.id}, 1)">+</button>
                    <button class="btn btn-danger btn-sm" onclick="removeItem(${item.id})">X</button>
                </div>
            </li>
        `;
    });

    html += "</ul>";
    box.innerHTML = html;
    document.getElementById("totalBox").innerText = "Total: ₹" + total;
}

function changeQty(id, change) {
    let cart = loadCart();
    let item = cart.find(i => i.id === id);

    if (!item) return;

    item.qty += change;
    if (item.qty <= 0) cart = cart.filter(i => i.id !== id);

    saveCart(cart);
    renderCart();
}

function removeItem(id) {
    let cart = loadCart().filter(i => i.id !== id);
    saveCart(cart);
    renderCart();
}

function placeOrder() {
    let cart = loadCart();

    if (cart.length === 0) {
        alert("Cart is empty!");
        return;
    }

    alert("Order placed successfully!");
    localStorage.removeItem("qb_cart");
    renderCart();
}

// load on page open
renderCart();
</script>

</body>
</html>
