<?php
include "header.php";
include "config.php";
session_start();

// Check if the user is logged in
if (!isset($_SESSION["login_user"])) {
    header("location: login.php");
    exit();
}

// Initialize variables to store form data and messages
$name = "";
$error = "";
$success = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = mysqli_real_escape_string($db, $_POST["name"]);

    // Prepare the SQL insert query
    $sql = "INSERT INTO categories (name) VALUES ('$name')"; // Removed id from insert, auto-increment is assumed

    // Execute the query and check for success
    if (mysqli_query($db, $sql)) {
        $_SESSION["success"] = "New category added successfully!";
        header("location: categories.php");
        exit();
    } else {
        $_SESSION["error"] = "Error: " . mysqli_error($db);
        header("location: categories.php");
        exit();
    }
}
?>

<main class="bg-light">
    <div class="container py-4">
        <h3>Add New Category</h3>

        <!-- Category addition form -->
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Add Category</button>
        </form>
    </div>
</main>

<?php include "footer.php"; ?>
