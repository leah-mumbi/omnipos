<?php
include "header.php";
include "config.php";
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location: login.php");
}
?>

<main class="bg-light">
    <h1>Inventory reports page</h1>
</main>

<?php include "footer.php"; ?>