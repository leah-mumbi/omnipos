<?php
include 'header.php';
include 'config.php';

session_start();
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = $_POST['password'];

    // Check the user in the database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($db, $sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        // if (!password_verify($password, hash: $row["password"])) {
        if ($password != $row["password"]) {
            $error = "Invalid credentials";
        } else {
            $_SESSION['login_user'] = $email;
            header("location: index.php");
        }
    }
}
?>
<style>
 form{
    padding: 30px;
  width: auto;
  
 }
 footer{
    padding-top: 170px;
    font-size:10px;
    
 }
</style>

<main class="d-flex justify-content-center align-items-center">

    <form action="" method="POST">
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger mt-3"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="email1" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email1" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>

    </form>
</main>

<?php include 'footer.php'; ?>