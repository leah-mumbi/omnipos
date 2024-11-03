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
if (!isset($_GET["user_id"])) {
    header("location: user_management.php");
    exit();
}

$user_id = intval($_GET["user_id"]);

// Initialize variables for messages
$error = $success = "";

// Fetch existing user data to confirm deletion
$sql = "SELECT first_name, last_name FROM users WHERE id = $user_id";
$result = mysqli_query($db, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $firstName = htmlspecialchars($user["first_name"]);
    $lastName = htmlspecialchars($user["last_name"]);
} else {
    $error = "User not found.";
}

// Check if form was submitted for deleting user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm_delete"])) {
    // Prepare the SQL delete query
    $sql = "DELETE FROM users WHERE id = $user_id";

    // Execute the query and check for success
    if (mysqli_query($db, $sql)) {
        $_SESSION["success"] = "User deleted successfully!";
        header("location: user_management.php");
        exit();
    } else {
        $error = "Error deleting user: " . mysqli_error($db);
    }
}
?>

<main class="bg-light">
    <div class="container py-4">
        <h3>Delete User</h3>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php elseif ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php else: ?>
            <p>Are you sure you want to delete the user <strong><?php echo "$firstName $lastName"; ?></strong>?</p>
        <?php endif; ?>

        <form action="" method="post">
            <input type="hidden" name="confirm_delete" value="1">
            <button type="submit" class="btn btn-danger">Confirm Delete</button>
            <a href="user_management.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</main>

<?php include "footer.php"; ?>
