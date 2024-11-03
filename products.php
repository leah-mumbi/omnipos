<?php
include "header.php";
include "config.php";
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location: login.php");
}

// $sql = "INSERT INTO `products` ( `name`, `category`, `price`, `quantity`) VALUES ('Xiaomi Redmi 12(4+128)', '1', '13399', '10')"
?>

<main class="bg-light">
    <h1>Products page</h1>
</main>

<?php include "footer.php"; ?>
