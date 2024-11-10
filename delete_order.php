<?php
include "config.php";
session_start();


if (!isset($_SESSION["login_user"])) {
    header("location: login.php");
    exit();
}


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $order_id = $_GET['id'];

    // Prepare the SQL statement to delete the order
    $delete_sql = "DELETE FROM orders WHERE order_id = ?";
    $stmt = $db->prepare($delete_sql);
    $stmt->bind_param("i", $order_id);

    // Execute the delete query
    if ($stmt->execute()) {
        $_SESSION["success"] = "Order deleted successfully!";
    } else {
        $_SESSION["error"] = "Error deleting order.";
    }
} else {
    $_SESSION["error"] = "Invalid order ID.";
}

// Redirect back to the orders page
header("Location: orders.php");
exit();
?>
