<?php
require("..//HomeController.php");

$Size=$_POST['MaSize'];
$LuongDuong=$_POST['LuongDuong'];
$Luongda=$_POST['LuongDa'];
$SoLuong=$_POST['SoLuong'];
$MaSanPham=$_POST['MaSanPham'];
$MaNguoiDung=$_POST['MaNguoiDung'];

// $Size="SM";
// $LuongDuong="vừa đủ";
// $Luongda="vừa đủ";
// $SoLuong="2";
// $MaSanPham="16";
// $MaNguoiDung="1";

$GioHangInsert=new GioHang();
$GioHangInsert->MaNguoiDung=$MaNguoiDung;
$GioHangInsert->MaSanPham=$MaSanPham;
$GioHangInsert->MaSize=$Size;
$GioHangInsert->LuongDa=$Luongda;
$GioHangInsert->LuongDuong=$LuongDuong;
$GioHangInsert->SoLuong=$SoLuong;

$connection=new Connection();
$sql="INSERT INTO `giohang`( `MaNguoiDung`, `MaSanPham`, `MaSize`, `SoLuong`, `LuongDuong`, `LuongDa`) VALUES ".
"('".$GioHangInsert->MaNguoiDung."','".$GioHangInsert->MaSanPham."','".$GioHangInsert->MaSize."','".$GioHangInsert->SoLuong."','".
$GioHangInsert->LuongDuong."','".$GioHangInsert->LuongDa."')";
$GioHangInsert->Id = $connection->excuteInsert($sql);
if($GioHangInsert->Id!=0)
{
    echo $GioHangInsert->Id;
}
else{
    echo "err";
}

?>