<?php
include "header.php";
include "config.php";
session_start();

// Check if the user is logged in
if (!isset($_SESSION["login_user"])) {
    header("location: login.php");
    exit();
}
$sql = "SELECT * from categories";
$result = mysqli_query($db, $sql);

// Initialize variables to store form data and messages
$name = "";
$error = "";
$success = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $category = mysqli_real_escape_string($db, $_POST["category"]);
    $name = mysqli_real_escape_string($db, $_POST["name"]);
    $price = mysqli_real_escape_string($db, $_POST["price"]);
    $quantity = mysqli_real_escape_string($db, $_POST["quantity"]);




    // Prepare the SQL insert query
    $sql = "INSERT INTO `products` (`name`, `category`, `price`, `quantity`) VALUES ('$name', '$category', '$price', '$quantity')"; 


    // Execute the query and check for success
    if (mysqli_query($db, $sql)) {
        $_SESSION["success"] = "New product added successfully!";
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
        <h3>Add New Product</h3>

        <!-- Product addition form -->
        <form action="" method="post">
            <div class="form-group">
                
                <label for="category">Choose a category:</label>
                <select name="category" id="category">
                    <?php 
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
                        }
                    } else {
                        echo "<option value=''>No categories available</option>"; // Handle case with no categories
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="text" name="quantity" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Add Product</button>
        </form>
    </div>
</main>

<?php include "footer.php"; ?>