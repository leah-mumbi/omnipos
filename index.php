<?php
include "header.php";
include "config.php";
session_start();

// Ensure the user is logged in
if (!isset($_SESSION["login_user"])) {
    header("location: login.php");
    exit();
}

// Initialize variables for metrics
$todays_orders_count = 0;
$todays_sales_total = 0.0;
$total_sales = 0.0;
$top_orders = [];

// Get today's date
$todays_date = date("Y-m-d");

// Query for Today's Orders Count and Sales Total
$todays_orders_sql = "
    SELECT COUNT(id) AS orders_count, SUM(amount) AS sales_total
    FROM orders
    WHERE DATE(created_at) = ? AND status = 1"; // Assuming 'status = 1' is for completed orders
$stmt = $db->prepare($todays_orders_sql);
$stmt->bind_param("s", $todays_date);
$stmt->execute();
$stmt->bind_result($todays_orders_count, $todays_sales_total);
$stmt->fetch();
$stmt->close();

// Query for Total Sales
$total_sales_sql =
    "SELECT SUM(amount) AS total_sales FROM orders WHERE status = 1";
$result = $db->query($total_sales_sql);
if ($row = $result->fetch_assoc()) {
    $total_sales = $row["total_sales"];
}

// Query for Top Orders
$top_orders_sql = "
    SELECT id, amount
    FROM orders
    WHERE status = 1
    ORDER BY amount DESC
    LIMIT 10";
$result = $db->query($top_orders_sql);
while ($row = $result->fetch_assoc()) {
    $top_orders[] = $row;
}
?>

<main class="bg-light">
    <div class="container-fluid py-4">
        <p>Welcome back, <strong><?php echo $_SESSION[
            "login_user"
        ]; ?>!</strong></p>

        <!-- Dashboard Stats Section -->
        <div class="row mb-4">
            <!-- Today's Orders Count -->
            <div class="col-md-3">
                <div class="card text-white bg-info mb-3 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo $todays_orders_count; ?></h3>
                        <p class="card-text">Today's Orders</p>
                        <div class="icon"><i class="fas fa-box"></i></div>
                    </div>
                </div>
            </div>

            <!-- Today's Sales Total -->
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title">Kes <?php echo number_format(
                            $todays_sales_total,
                            2
                        ); ?></h3>
                        <p class="card-text">Today's Sales</p>
                        <div class="icon"><i class="fas fa-dollar-sign"></i></div>
                    </div>
                </div>
            </div>

            <!-- Total Sales -->
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title">Kes <?php echo number_format(
                            $total_sales,
                            2
                        ); ?></h3>
                        <p class="card-text">Total Sales</p>
                        <div class="icon"><i class="fas fa-chart-line"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Orders Section -->
        <section id="top-orders" class="mb-4">
            <h3>Top Orders</h3>
            <div class="list-group">
                <?php foreach ($top_orders as $order): ?>
                <a href="order_details.php?id=<?php echo htmlspecialchars(
                    $order["id"]
                ); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                       Order #<?php echo htmlspecialchars(
                                           $order["id"]
                                       ); ?>
                                       <span class="badge badge-secondary badge-pill">Kes <?php echo number_format(
                                           (float) $order["amount"],
                                           2
                                       ); ?></span>
                                   </a>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</main>

<?php include "footer.php"; ?>
