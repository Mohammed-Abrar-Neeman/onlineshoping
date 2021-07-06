<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:index.php');
    exit;
}?>
<?php 
ob_start();
session_start();
include 'admin/inc/config.php';
unset($_SESSION['customer']);
header("location: ".'index.php'); 
?>
