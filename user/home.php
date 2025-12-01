<?php
include_once 'navbar.php';
?> 
<section class="py-5" style="background:#fafafa;">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <h1 class="fw-bold mb-3 text-danger-emphasis">Where Hunger Meets Its Match</h1>
        <p class="text-secondary-emphasis mb-4">
          Hungry? Let's fix that. QuickBite serves your cravings faster than you can say 
          “Extra cheese, please!” Whether it's spicy, cheesy, crunchy or sweet—we deliver 
          happiness straight to your plate.
        </p>
            <?php if (isset($_SESSION['user_id'])): ?>
        <a href="menu.php" class="btn btn-danger px-4 py-2">
            Explore Menu
        </a>
        <?php else: ?>
            <button class="btn btn-danger px-4 py-2" disabled>
                Explore Menu
            </button>
            <p class="text-muted mt-2 small">
                Login to explore our menu!
            </p>
        <?php endif; ?>
      </div>
      <div class="col-lg-6 text-center">
        <img src="../images/banner.jpg" class="img-fluid rounded-4 shadow-sm" 
             style="max-width:430px;" alt="banner">
      </div>
    </div>
  </div>
</section>
<section id="menu" class="py-5">
  <div class="container">
    <h3 class="fw-semibold">Popular Picks</h3>

    <div class="row g-4 mt-2">
      <div class="col-md-4">
        <div class="food-card shadow-sm border-0 rounded-4">
          <img src="../images/home_img1.jpeg" class="food-img rounded-top-4" alt="">
          <div class="card-body">
            <h5 class="card-title">Margherita Pizza</h5>
            <p class="text-muted small">Mozzarella & basil</p>
            <strong>₹299</strong>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="food-card shadow-sm border-0 rounded-4">
          <img src="../images/home_img2.jpeg" class="food-img rounded-top-4" alt="">
          <div class="card-body">
            <h5 class="card-title">Cheeseburger</h5>
            <p class="text-muted small">Cheddar & lettuce</p>
            <strong>₹249</strong>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="food-card shadow-sm border-0 rounded-4">
          <img src="../images/home_img3.jpeg" class="food-img rounded-top-4" alt="">
          <div class="card-body">
            <h5 class="card-title">Chocolate Brownie</h5>
            <p class="text-muted small">Warm & fudgy</p>
            <strong>₹149</strong>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ABOUT -->
<section id="about-us" class="container py-5">
  <h3 class="text-danger-emphasis fw-bold mb-3">About QuickBite</h3>
  <p class="text-dark">
    QuickBite began with a simple goal — make food ordering fast, smooth, and 
    absolutely stress-free. No complicated menus, no endless waiting. Just good 
    food delivered with zero drama.
    <br><br>
    From comfort classics to spicy indulgences, every dish you see here is 
    hand-picked to satisfy different cravings and different moods. Whether 
    you're studying late, chilling with friends, or just too tired to cook, 
    QuickBite always has your back.
    <br><br>
    We don't just deliver food — we deliver instant happiness.
  </p>
</section>
<!-- CONTACT -->
<section id="contact-us" class="container py-5">
  <h3 class="text-danger-emphasis fw-bold mb-3">Contact Us</h3>
  <p class="text-dark mb-1">Got suggestions, issues, or just want to say hi?</p>
  <p class="text-dark mb-2">We'd love to hear from you.</p>

  <ul class="text-dark">
    <li><b>Email:</b> support@quickbite.com</li>
    <li><b>Phone:</b> +91 98765 43210</li>
    <li><b>Location:</b> Bhubaneswar, Odisha</li>
  </ul>
</section>
<!-- FOOTER -->
<footer class="bg-dark py-4 mt-4">
  <div class="container text-center text-white small">
    <div class="mb-2">&copy | 2025 | QuickBite | All Rights Reserved </div>
    <div class="d-flex justify-content-center gap-4">
      <a href="#" class="text-white text-decoration-none"><i class="bi bi-facebook"></i> Facebook</a>
      <a href="#" class="text-white text-decoration-none"><i class="bi bi-instagram"></i> Instagram</a>
      <a href="#" class="text-white text-decoration-none"><i class="bi bi-twitter-x"></i> Twitter</a>
      <a href="#" class="text-white text-decoration-none"><i class="bi bi-youtube"></i> YouTube</a>
    </div>
  </div>
</footer>