<?php
include "header.php";
include "config.php";
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location: login.php");
    exit();
}

// Initialize variables to store form data and errors
$firstName = $lastName = $email = $phone = $isAdmin = $password = "";
$error = $success = "";

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $firstName = mysqli_real_escape_string($db, $_POST["first_name"]);
    $lastName = mysqli_real_escape_string($db, $_POST["last_name"]);
    $email = mysqli_real_escape_string($db, $_POST["email"]);
    $phone = mysqli_real_escape_string($db, $_POST["phone"]);
    $isAdmin = isset($_POST["is_admin"]) ? 1 : 0;
    $password = mysqli_real_escape_string($db, $_POST["password"]);
    // $password = password_hash(
    //     mysqli_real_escape_string($db, $_POST["password"]),
    //     PASSWORD_BCRYPT
    // ); // Hash password

    $sql = "INSERT INTO users (first_name, last_name, email, phone, is_admin, password)
            VALUES ('$firstName', '$lastName', '$email', '$phone', '$isAdmin', '$password')";

    if (mysqli_query($db, $sql)) {
        $success = "New user added successfully!";
        header("location: user_management.php");
    } else {
        $error = "Error: " . mysqli_error($db);
    }
}
?>

<main class="bg-light">
    <div class="container py-4">
        <h3>Add New User</h3>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php elseif ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form action="" method="post">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" name="is_admin" class="form-check-input">
                <label class="form-check-label" for="is_admin">Admin User</label>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add User</button>
        </form>
    </div>
</main>

<?php include "footer.php"; ?>
