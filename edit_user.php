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
$firstName = $lastName = $email = $phone = $isAdmin = $password = "";
$error = $success = "";

// Fetch existing user data
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($db, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $firstName = $user["first_name"];
    $lastName = $user["last_name"];
    $email = $user["email"];
    $phone = $user["phone"];
    $isAdmin = $user["is_admin"];
} else {
    $error = "User not found.";
}

// Check if form was submitted for updating user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $firstName = mysqli_real_escape_string($db, $_POST["first_name"]);
    $lastName = mysqli_real_escape_string($db, $_POST["last_name"]);
    $email = mysqli_real_escape_string($db, $_POST["email"]);
    $phone = mysqli_real_escape_string($db, $_POST["phone"]);
    $isAdmin = isset($_POST["is_admin"]) ? 1 : 0;

    // Prepare the SQL update query
    $sql = "UPDATE users SET
                first_name = '$firstName',
                last_name = '$lastName',
                email = '$email',
                phone = '$phone',
                is_admin = '$isAdmin'
            WHERE id = $user_id";

    // Execute the query and check for success
    if (mysqli_query($db, $sql)) {
        $success = "User updated successfully!";
        header("location: user_management.php"); // Redirect after successful update
        exit();
    } else {
        $error = "Error updating user: " . mysqli_error($db);
    }
}
?>

<main class="bg-light">
    <div class="container py-4">
        <h3>Edit User</h3>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php elseif ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form action="" method="post">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars(
                    $firstName
                ); ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="<?php echo htmlspecialchars(
                    $lastName
                ); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars(
                    $email
                ); ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars(
                    $phone
                ); ?>">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" name="is_admin" class="form-check-input" <?php if (
                    $isAdmin == 1
                ) {
                    echo "checked";
                } ?>>
                <label class="form-check-label" for="is_admin">Admin User</label>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update User</button>
        </form>
    </div>
</main>

<?php include "footer.php"; ?>
