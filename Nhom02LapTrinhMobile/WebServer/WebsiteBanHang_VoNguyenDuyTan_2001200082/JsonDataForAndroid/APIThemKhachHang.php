<?php
require("..//HomeController.php");

$TenKhachHang=$_POST["TenKhachHang"];
$SDTDangNhap=$_POST["SDT"];
$NgaySinh=$_POST["NgaySinh"];
$MatKhau=$_POST["MatKhau"];
$GioiTinh=$_POST["GioiTinh"];
$Email=$_POST["Email"];
$taiKhoan=new TaiKhoan();
$taiKhoan->SDTDangNhap=$SDTDangNhap;
$taiKhoan->MatKhau = password_hash($MatKhau, PASSWORD_DEFAULT);
$kq=$taiKhoan->ThemMotTaiKhoanKhachHang();
if($kq>0)
{
    $connection=new Connection();
    $KhachHang=new NguoiDung();
    $KhachHang->TenNguoiDung=$TenKhachHang;
    $KhachHang->SDTDangNhap=$SDTDangNhap;
    $KhachHang->SDTLienHe=$SDTDangNhap;
    $KhachHang->NgaySinh=$NgaySinh;
    $KhachHang->GioiTinh=$GioiTinh;
    $KhachHang->Email=$Email;
    $KhachHang->MaNguoiDung=$KhachHang->ThemMotKhachHang();
    if($KhachHang->MaNguoiDung>0)
    {
        echo $KhachHang->MaNguoiDung;
    }
}
else{
    echo "0";
}


?>