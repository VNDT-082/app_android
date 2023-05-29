<?php
    session_start();
    unset($_SESSION['KhachHang']);
    header('location: index.php');
    exit();
?>