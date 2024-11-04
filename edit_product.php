
<?php
include "header.php";
include "config.php";
session_start();

// Check if the user is logged in
if (!isset($_SESSION["login_user"])) {
    header("location: login.php");
    exit();
}

if (!isset($_GET["id"])) {
    header("location: products.php");
    exit();
}

$id = $_GET["id"];
$sql = "SELECT * from products WHERE id = $id";
$result = mysqli_query($db, $sql);

$name = "";
if ($result && mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_assoc($result);
    $name = $product["name"];
} else {
    $_SESSION["error"] = "product not found.";
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = mysqli_real_escape_string($db, $_POST["name"]);

    // Prepare the SQL insert query
    $sql = "UPDATE products  SET name='$name' WHERE id=$id";

    // Execute the query and check for success
    if (mysqli_query($db, $sql)) {
        $_SESSION["success"] = "New product updated successfully!";
        header("location: products.php");
        exit();
    } else {
        $_SESSION["error"] = "Error: " . mysqli_error($db);
        header("location: products.php");
        exit();
    }
}
?>

<main class="bg-light">
    <div class="container py-4">
        <h3>Edit product</h3>

        <!-- product addition form -->
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" class="form-control" required value="<?php echo htmlspecialchars(
                    $name
                ); ?>">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Product</button>
        </form>
    </div>
</main>

<?php include "footer.php"; ?>
