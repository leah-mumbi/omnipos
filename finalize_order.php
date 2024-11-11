<?php
include "header.php";
include "config.php";
session_start();

// Ensure the user is logged in
if (!isset($_SESSION["login_user"])) {
    header("location: login.php");
    exit();
}

// Check if there are items in the cart
if (empty($_SESSION["cart"])) {
    $_SESSION["error"] = "No items in the cart to place an order.";
    header("Location: new_order.php");
    exit();
}

// Calculate the total amount for the order
$total_amount = array_sum(array_column($_SESSION["cart"], "total_price"));
$status = 1; // Assuming '1' represents "Pending" status in the orders table

// Start a database transaction
$db->begin_transaction();

try {
    // Insert a new order in the `orders` table
    $order_sql =
        "INSERT INTO orders (amount, payment_method, status, created_at, updated_at) VALUES (?, 'cash', ?, NOW(), NOW())";
    $stmt = $db->prepare($order_sql);
    $stmt->bind_param("di", $total_amount, $status);
    $stmt->execute();
    $order_id = $stmt->insert_id; // Get the last inserted order ID
    $stmt->close();

    // Prepare the order items insertion query
    $order_item_sql =
        "INSERT INTO order_items (order_id, product_id, quantity, price, total_price) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($order_item_sql);

    // Insert each item from the cart into the `order_items` table
    foreach ($_SESSION["cart"] as $item) {
        $stmt->bind_param(
            "iiidd",
            $order_id,
            $item["product_id"],
            $item["quantity"],
            $item["price"],
            $item["total_price"]
        );
        $stmt->execute();
    }
    $stmt->close();

    // Commit the transaction
    $db->commit();

    // Clear the cart after successful order placement
    unset($_SESSION["cart"]);
    $_SESSION["success"] = "Order placed successfully!";
    header("Location: orders.php");
    exit();
} catch (Exception $e) {
    // Rollback the transaction if any error occurs
    $db->rollback();
    $_SESSION["error"] = "Error placing order. Please try again.";
    header("Location: new_order.php");
    exit();
}
?>
