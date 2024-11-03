<?php
include "header.php";
include "config.php";
session_start();

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

// Initialize variables to store form data and errors
$error = $success = "";

// Fetch existing user data
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($db, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    $error = "User not found.";
}

// Check if form was submitted for updating the password
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $old_password = mysqli_real_escape_string($db, $_POST["old_password"]);
    $new_password = mysqli_real_escape_string($db, $_POST["new_password"]);
    $confirm_password = mysqli_real_escape_string(
        $db,
        $_POST["confirm_password"]
    );

    // Validate the new password
    if ($new_password !== $confirm_password) {
        $error = "New password and confirmation do not match.";
    } elseif (strlen($new_password) < 8) {
        $error = "Password must be at least 8 characters long.";
    } else {
        if ($old_password != $user["password"]) {
            $error = "Old password is incorrect.";
        } else {
            // Prepare the SQL update query for password
            $sql = "UPDATE users SET password = '$new_password' WHERE id = $user_id";

            // Execute the query and check for success
            if (mysqli_query($db, $sql)) {
                $success = "Password updated successfully!";
                header("location: user_management.php"); // Redirect after successful update
                exit();
            } else {
                $error = "Error updating password: " . mysqli_error($db);
            }
        }
    }
}
?>

<main class="bg-light">
    <div class="container py-4">
        <h3>Change Password</h3>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php elseif ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form action="" method="post">
            <div class="form-group">
                <label for="old_password">Old Password</label>
                <input type="password" name="old_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" name="new_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Password</button>
        </form>
    </div>
</main>

<?php include "footer.php"; ?>
