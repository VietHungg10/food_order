<?php


 if(!isset($_SESSION['user'])){
    $_SESSION['need-login']="<div class='error'> You have to login to access Admin panel</div>";
    header('location:'.SITEURL.'admin/login.php');
 }

?>