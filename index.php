<?php
include "header.php";
include "config.php";
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location: login.php");
}
?>

<main class="bg-light">
    <div class="container-fluid py-4">
        <p>Welcome back, <strong><?php echo $_SESSION[
            "login_user"
        ]; ?>! </strong></p>

        <!-- Dashboard Stats Section -->
        <div class="row mb-4">
            <!-- Example Metric Card -->
            <div class="col-md-3">
                <div class="card text-white bg-info mb-3 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title">6</h3>
                        <p class="card-text">Today's Orders</p>
                        <div class="icon"><i class="fas fa-box"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title">$20.45K</h3>
                        <p class="card-text">Today's Sales</p>
                        <div class="icon"><i class="fas fa-dollar-sign"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title">1</h3>
                        <p class="card-text">Today's Refund Order</p>
                        <div class="icon"><i class="fas fa-undo"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title">$66.42K</h3>
                        <p class="card-text">Total Sales</p>
                        <div class="icon"><i class="fas fa-chart-line"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Products Section -->
        <section id="top-products" class="mb-4">
            <h3>Top Products</h3>
            <div class="list-group">
                <!-- Placeholder data for Top Products -->
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    Product A
                    <span class="badge badge-primary badge-pill">150 units</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    Product B
                    <span class="badge badge-primary badge-pill">120 units</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    Product C
                    <span class="badge badge-primary badge-pill">110 units</span>
                </a>
            </div>
        </section>

        <!-- Top Orders Section -->
        <section id="top-orders" class="mb-4">
            <h3>Top Orders</h3>
            <div class="list-group">
                <!-- Placeholder data for Top Orders -->
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    Order #1021
                    <span class="badge badge-secondary badge-pill">$1,200</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    Order #1018
                    <span class="badge badge-secondary badge-pill">$950</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    Order #1015
                    <span class="badge badge-secondary badge-pill">$870</span>
                </a>
            </div>
        </section>
    </div>
</main>

<?php include "footer.php"; ?>
