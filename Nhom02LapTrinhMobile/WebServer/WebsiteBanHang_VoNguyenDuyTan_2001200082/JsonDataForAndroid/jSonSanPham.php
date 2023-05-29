<?php
require("..//Controller/HomeController.php");
$home=new HomeController();
$stringSelect="SELECT *FROM sanpham ;";
$listProduct=$home->getListProduct($stringSelect);
echo json_encode($listProduct);
?>