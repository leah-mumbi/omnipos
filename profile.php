<?php
include "header.php";
include "config.php";
session_start();

if (!isset($_SESSION["login_user"])) {
    header("location: login.php");
    exit();
}

// Get the current user's ID from the session
$user_id = $_SESSION["user_id"]; // Assuming you stored user_id in the session upon login

// Fetch user data from the database
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($db, $sql);

// Initialize user data variables
$user = null;

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "<div class='alert alert-danger'>User not found.</div>";
}
?>

<main class="bg-light">
    <div class="container py-4">
        <h1>User Profile</h1>

        <?php if ($user): ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars(
                        $user["first_name"] . " " . $user["last_name"]
                    ); ?></h5>
                    <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars(
                        $user["email"]
                    ); ?></p>
                    <p class="card-text"><strong>Phone:</strong> <?php echo htmlspecialchars(
                        $user["phone"]
                    ); ?></p>
                    <p class="card-text"><strong>Admin User:</strong> <?php echo $user[
                        "is_admin"
                    ]
                        ? "Yes"
                        : "No"; ?></p>
                    <a href="change_password.php?user_id=<?php echo $user[
                        "id"
                    ]; ?>" class="btn btn-primary">Change Password</a>
                    <?php if (
                        isset($_SESSION["role_user"]) &&
                        $_SESSION["role_user"] == 1
                    ): ?>
                    <a href="user_management.php" class="btn btn-secondary">Back to User Management</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include "footer.php"; ?>
