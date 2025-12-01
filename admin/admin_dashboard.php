<?php
include_once 'admin_navbar.php';
require_once 'dbcon.php';
$qry = "SELECT COUNT(order_id) AS total_orders FROM orders";
$res = $con->query($qry);
$total_order=$res->fetch_assoc()['total_orders'];

$qry = "SELECT COUNT(item_id) AS total_items FROM food_items";
$res = $con->query($qry);
$total_item=$res->fetch_assoc()['total_items'];

$qry = "SELECT COUNT(user_id) AS total_users FROM users";
$res = $con->query($qry);
$total_user=$res->fetch_assoc()['total_users'];

$qry = "SELECT COUNT(order_id) AS confirmed_orders FROM orders WHERE order_status='Confirmed'";
$res = $con->query($qry);
$confirmed_orders = $res->fetch_assoc()['confirmed_orders'];

$qry = "SELECT COUNT(order_id) AS cancelled_orders FROM orders WHERE order_status='Cancelled'";
$res = $con->query($qry);
$cancelled_orders = $res->fetch_assoc()['cancelled_orders'];

$qry = "SELECT SUM(total_amount) AS total_revenue FROM orders WHERE order_status='Confirmed'";
$res = $con->query($qry);
$total_revenue = $res->fetch_assoc()['total_revenue'];
if (!$total_revenue) $total_revenue = 0;
$con->close();
?>
<div class="container m-5">
    <div class="row g-5">
        <div class="col-md-4">
            <div class="box card card-body">
                <h5 class="card-title">TOTAL ORDER</h5><hr>
                <p class="card-text fs-2"><?= $total_order ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box card card-body">
                <h5 class="card-title">TOTAL ITEM</h5><hr>
                <p class="card-text fs-2"><?= $total_item ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box card card-body">
                <h5 class="card-title">TOTAL USER</h5><hr>
                <p class="card-text fs-2"><?= $total_user ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box card card-body">
                <h5 class="card-title">CONFIRMED ORDER</h5><hr>
                <p class="card-text fs-2"><?= $confirmed_orders ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box card card-body">
                <h5 class="card-title">CANCELLED ORDER</h5><hr>
                <p class="card-text fs-2"><?= $cancelled_orders ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box card card-body">
                <h5 class="card-title">TOTAL REVENUE</h5><hr>
                <p class="card-text text-success fs-2"><?= $total_revenue ?> /-</p>
            </div>
        </div>
    </div>
</div>