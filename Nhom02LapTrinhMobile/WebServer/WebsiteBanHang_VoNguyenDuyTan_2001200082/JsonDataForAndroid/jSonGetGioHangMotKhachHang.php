<?php
require("..//Model/Connection.php");
$MaKhachHang=0;
if(isset($_GET["MaKhachHang"]))
{
    $MaKhachHang=$_GET["MaKhachHang"];

}
$connection=new Connection();
$sql="SELECT giohang.ID, giohang.MaNguoiDung, giohang.MaSanPham,sanpham.TenSanPham, sanpham.GiaBan, sanpham.HinhAnh, giohang.MaSize,size.Gia,".
" giohang.SoLuong, giohang.LuongDuong, giohang.LuongDa FROM giohang, sanpham, size WHERE giohang.MaNguoiDung=".$MaKhachHang.
" AND giohang.MaSanPham=sanpham.MaSanPham AND giohang.MaSize=size.MaSize;";
$result_GioHang=$connection->excuteQuery($sql);
echo json_encode($result_GioHang);
?>