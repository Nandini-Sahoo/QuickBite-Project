<?php
include_once 'navbar.php';
require_once 'dbcon.php';

// Fetch categories
$categories = mysqli_query($con, "SELECT DISTINCT item_cat FROM food_items");

// Filtering
$filter = "";
if (isset($_GET['cat']) && $_GET['cat'] !== "all") {
    $cat = mysqli_real_escape_string($con, $_GET['cat']);
    $filter = "WHERE item_cat = '$cat' AND is_available = 1";
} else {
    $filter = "WHERE is_available = 1";  // default: show all
}

// Fetch items
$items = mysqli_query($con, "SELECT * FROM food_items $filter");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Menu</title>
    <style>
        .menu-card { border-radius: 15px; overflow: hidden; transition: 0.2s; }
        .menu-card:hover { transform: scale(1.03); }
        .cat-btn { margin-right: 10px; }
    </style>
</head>

<body class="bg-light">

<div class="container mt-4">

    <h3 class="mb-3">Menu</h3>

    <!-- CATEGORY FILTERS -->
    <div class="mb-4">
        <a href="menu.php?cat=all"
           class="btn btn-<?php echo (!isset($_GET['cat']) || $_GET['cat']=='all') ? 'primary' : 'secondary'; ?> cat-btn">
            All
        </a>

        <?php while ($c = mysqli_fetch_assoc($categories)): ?>
            <a href="menu.php?cat=<?= $c['item_cat']; ?>"
               class="btn btn-<?php echo (isset($_GET['cat']) && $_GET['cat']==$c['item_cat']) ? 'primary' : 'outline-primary'; ?> cat-btn">
                <?= $c['item_cat']; ?>
            </a>
        <?php endwhile; ?>
    </div>

    <!-- FOOD ITEMS -->
    <div class="row">
    <?php while ($item = mysqli_fetch_assoc($items)): ?>
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm menu-card h-100">
          <img src="../upload_img/<?= $item['item_img']; ?>" class="card-img-top">
          <div class="card-body d-flex flex-column">
                <h5><?= $item['item_name']; ?></h5>
                <p class="text-muted"><?= $item['item_cat']; ?></p>
                <p class="desc-text flex-grow-1">
                    <?= $item['item_desc']; ?>
                </p>
                <h5 class="fw-bold mt-2">₹<?= $item['item_prc']; ?></h5>
                <form action="cart_add.php" method="POST">
                    <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">                    
                    <button type="submit" class="btn btn-warning w-100">ADD</button>
                </form>


            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>
</div>

