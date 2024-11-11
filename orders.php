<?php
include "header.php";
include "config.php";
session_start();

// Ensure the user is logged in
if (!isset($_SESSION["login_user"])) {
    header("location: login.php");
    exit();
}

// Fetch all orders from the database
$sql = "SELECT * FROM orders";
$result = mysqli_query($db, $sql);
?>

<main class="bg-light">
    <section class="row m-auto">
        <p>Welcome back, <strong><?php echo $_SESSION[
            "login_user"
        ]; ?>!</strong></p>

        <!-- Display success or error messages -->
        <?php if (!empty($_SESSION["success"])): ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION["success"];
                unset($_SESSION["success"]);
                ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($_SESSION["error"])): ?>
            <div class="alert alert-danger">
                <?php
                echo $_SESSION["error"];
                unset($_SESSION["error"]);
                ?>
            </div>
        <?php endif; ?>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>All Orders</h3>
            <a href="new_order.php" class="btn btn-success">New Order</a>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Payment_method</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created_at</th>
                    <th scope="col">Updated_at</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && mysqli_num_rows($result) > 0) {
                    $counter = 1; // Counter for row numbers
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Calculate total price
                        $total_price = $row["quantity"] * $row["price"]; // Assuming each order has a price per item

                        echo "<tr>";
                        echo "<th scope='row'>{$row["id"]}</th>";
                        echo "<td>{$row["amount"]}</td>";
                        echo "<td>{$row["payment_method"]}</td>";
                        echo "<td>{$row["status"]}</td>";
                        echo "<td>{$row["created_at"]}</td>";
                        echo "<td>{$row["updated_at"]}</td>";
                        echo "<td>
                            <a class='btn btn-sm btn-primary' href='order_details.php?id={$row["id"]}'>View</a>
                            <a class='btn btn-sm btn-danger' href='delete_order.php?id={$row["id"]}' onclick='return confirm(\"Are you sure you want to delete this order?\")'>Delete</a>
                            </td>";
                        echo "</tr>";
                        $counter++;
                    }
                } else {
                    echo "<tr><td colspan='8'>No orders found.</td></tr>";
                } ?>
            </tbody>
        </table>
    </section>
</main>

<?php include "footer.php"; ?>
