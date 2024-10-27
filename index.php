<?php
include("header.php");
include("config.php");
?>
<?php 
    session_start();
    if(isset($_SESSION["login_user"])){
        echo "welcome back! " . $_SESSION["login_user"];
    }else{
        header("location: login.php");
    }
    
?>

<?php include("footer.php"); ?>