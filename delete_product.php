<?php
include "header.php";
include "config.php";
session_start();

// Check if user is logged in
if (!isset($_SESSION["login_user"])) {
    header("location: login.php");
    exit();
}

// Ensure only admins can access this page
if (isset($_SESSION["role_user"]) && $_SESSION["role_user"] != 1) {
    header("location: index.php");
    exit();
}

// Check if user_id is provided in the URL
if (!isset($_GET["id"])) {
    header("location: products.php");
    exit();
}

$id = intval($_GET["id"]);


    


// Fetch existing user data to confirm deletion
$sql = "SELECT name FROM products WHERE id = $id";
$result = mysqli_query($db, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_assoc($result);
    $name = htmlspecialchars($product["name"]);
} else {
    $error = "Product not found.";
}

// Check if form was submitted for deleting user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm_delete"])) {
    // Prepare the SQL delete query
    $sql = "DELETE FROM products WHERE id = $id";

    // Execute the query and check for success
    if (mysqli_query($db, $sql)) {
        $_SESSION["success"] = "Product deleted successfully!";
        header("location: products.php");
        exit();
    } else {
        $error = "Error deleting product: " . mysqli_error($db);
    }
}
?>

<main class="bg-light">
    <div class="container py-4">
        <h3>Delete Product</h3>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php elseif ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php else: ?>
            <p>Are you sure you want to delete the <strong><?php echo "$name"; ?></strong> product?</p>
        <?php endif; ?>

        <form action="" method="post">
            <input type="hidden" name="confirm_delete" value="1">
            <button type="submit" class="btn btn-danger">Confirm Delete</button>
            <a href="categories.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</main>

<?php include "footer.php"; ?>
