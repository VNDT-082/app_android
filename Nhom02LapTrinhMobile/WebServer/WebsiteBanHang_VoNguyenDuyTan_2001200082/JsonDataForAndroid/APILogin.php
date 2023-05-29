<?php
require("..//Model/Connection.php");
require("..//Model/TaiKhoan.php");

$SDTDangNhap="";
$MatKhau="";
$SDTDangNhap=$_POST["SDTDangNhap"];
$MatKhau=$_POST["MatKhau"];

$TaiKhoan=TaiKhoan::getOneBySDTDangNhap($SDTDangNhap);
if($TaiKhoan!=null)
{
    if (password_verify($MatKhau, $TaiKhoan->MatKhau)) {
            echo $TaiKhoan->LoaiTaiKhoan;
            
        } else {
            echo "err";
        }
}

?>