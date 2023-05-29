<?php
require("HomeController.php");
if($_SERVER['REQUEST_METHOD'] == 'POST' )
{
    if(isset($_POST["search"]))
    {
        $value=$_POST["TimKiem_"];
        $url="DanhSachSanPhamTimKiem.php?value=".$value;
        header('location:'. $url);
        exit();
    }
}

?>