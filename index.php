<?php
include "header.php";
include "config.php";
?>
<main>
    <?php
    session_start();
    if (isset($_SESSION["login_user"])) {
        echo "welcome back! " . $_SESSION["login_user"];
    } else {
        header("location: login.php");
    }
    ?>

</main>
<?php include "footer.php"; ?>
