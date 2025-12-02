<?php
include_once 'navbar.php';
require_once 'dbcon.php';

$categories = mysqli_query($con, "SELECT DISTINCT item_cat FROM food_items");

$filter = "";
if (isset($_GET['cat']) && $_GET['cat'] !== "all") {
    $cat = mysqli_real_escape_string($con, $_GET['cat']);
    $filter = "WHERE item_cat = '$cat' AND is_available = 1";
} else {
    $filter = "WHERE is_available = 1";
}

$items = mysqli_query($con, "SELECT * FROM food_items $filter");
?>
<div class="container mt-4">

    <h3 class="mb-3">Menu</h3>

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

    <div class="row">
    <?php while ($item = mysqli_fetch_assoc($items)): ?>
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm menu-card h-100">
          <img src="../upload_img/<?= $item['item_img']; ?>" class="card-img-top" height="300">
          <div class="card-body d-flex flex-column">
                <h5><?= $item['item_name']; ?></h5>
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <p class="text-muted mb-0"><?= $item['item_cat']; ?></p>
                    <span class="badge bg-warning-subtle text-dark"><?= $item['item_rating']; ?> ⭐</span>
                </div>
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

