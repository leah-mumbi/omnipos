<?php
include "header.php";
include "config.php";
session_start();

// Ensure the user is logged in
if (!isset($_SESSION["login_user"])) {
    header("location: login.php");
    exit();
}

// Check if order_id is provided in the URL
if (!isset($_GET["id"])) {
    $_SESSION["error"] = "Order ID is missing.";
    header("Location: orders.php");
    exit();
}

$order_id = $_GET["id"];

// Fetch order details from the `orders` table
$order_sql =
    "SELECT amount, payment_method, status, created_at FROM orders WHERE id = ?";
$stmt = $db->prepare($order_sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order_result = $stmt->get_result();
$order = $order_result->fetch_assoc();
$stmt->close();

if (!$order) {
    $_SESSION["error"] = "Order not found.";
    header("Location: orders.php");
    exit();
}

// Fetch order items from the `order_items` table
$order_items_sql = "SELECT oi.product_id, p.name AS product_name, oi.quantity, oi.price, oi.total_price
                    FROM order_items oi
                    JOIN products p ON oi.product_id = p.id
                    WHERE oi.order_id = ?";
$stmt = $db->prepare($order_items_sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order_items_result = $stmt->get_result();
$order_items = $order_items_result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<main class="container">
    <h2>Order Details</h2>

    <!-- Order Summary -->
    <div class="order-summary mb-4">
        <h4>Order Summary</h4>
        <p><strong>Order ID:</strong> <?php echo htmlspecialchars(
            $order_id
        ); ?></p>
        <p><strong>Total Amount:</strong> Kes <?php echo number_format(
            $order["amount"],
            2
        ); ?></p>
        <p><strong>Payment Method:</strong> <?php echo htmlspecialchars(
            $order["payment_method"]
        ); ?></p>
        <p><strong>Status:</strong> <?php echo $order["status"] == 1
            ? "Pending"
            : "Completed"; ?></p>
        <p><strong>Order Date:</strong> <?php echo htmlspecialchars(
            $order["created_at"]
        ); ?></p>
    </div>

    <!-- Order Items Table -->
    <h4>Order Items</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order_items as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars(
                        $item["product_name"]
                    ); ?></td>
                    <td><?php echo htmlspecialchars($item["quantity"]); ?></td>
                    <td>Kes <?php echo number_format($item["price"], 2); ?></td>
                    <td>Kes <?php echo number_format(
                        $item["total_price"],
                        2
                    ); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="orders.php" class="btn btn-primary">Back to Orders</a>
</main>

<?php include "footer.php"; ?>
