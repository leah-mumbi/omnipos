<?php
include "header.php";
include "config.php";
session_start();

// Ensure the user is logged in
if (!isset($_SESSION["login_user"])) {
    header("location: login.php");
    exit();
}

// Fetch products from the database
$product_sql = "SELECT * FROM products"; // Get all products
$product_result = mysqli_query($db, $product_sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission to create a new order
    $product_id = $_POST["product_id"];
    $quantity = $_POST["quantity"];

    // Get the product price for the selected product
    $price_sql = "SELECT price FROM products WHERE id = ?";
    $stmt = $db->prepare($price_sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($price);
    $stmt->fetch();
    $stmt->close();

    $total_price = $price * $quantity;

    // Add item to the session cart
    $_SESSION["cart"][] = [
        "product_id" => $product_id,
        "product_name" => $product_name,
        "quantity" => $quantity,
        "price" => $price,
        "total_price" => $total_price,
    ];

    $_SESSION["success"] = "Item added to cart!";
    header("Location: new_order.php"); // Refresh page to update cart
    exit();
}
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
            <h3>Create a New Order</h3>
        </div>

        <!-- New Order Form -->
        <form method="POST" action="new_order.php">
            <div class="form-group">
                <label for="product_id">Select Product</label>
                <select class="form-control" id="product_id" name="product_id" required>
                    <option value="">Select a product</option>
                    <?php while (
                        $product = mysqli_fetch_assoc($product_result)
                    ): ?>
                        <option value="<?php echo $product["id"]; ?>">
                            <?php echo $product[
                                "name"
                            ]; ?> - $<?php echo $product["price"]; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
            </div>
            <button type="submit" class="btn btn-success">Add Item</button>
            <a class="btn btn-success" href="finalize_order.php">Finish Order</a>
        </form>
    </section>
</main>

<?php include "footer.php"; ?>
