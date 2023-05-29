<?php
require("..//Model/Connection.php");
$SDTDangNhap=0;
if(isset($_GET["SDTDangNhap"]));
{
    $SDTDangNhap=$_GET["SDTDangNhap"];
}
$connection=new Connection();
$sql="SELECT nguoidung.MaNguoiDung, nguoidung.MaLoaiKH, loaikhachhang.TenLoaiKhach,nguoidung.TenNguoiDung, nguoidung.SDTDangNhap,".
" nguoidung.SDTLienHe, nguoidung.AnhDaiDien, nguoidung.GioiTinh, nguoidung.NgaySinh, nguoidung.Email, taikhoan.MatKhau ".
" FROM nguoidung, taikhoan, loaikhachhang WHERE nguoidung.SDTDangNhap=taikhoan.SDTDangNhap ".
" AND nguoidung.MaLoaiKH=loaikhachhang.MaLoaiKH AND nguoidung.SDTDangNhap='$SDTDangNhap';";
$sp=$connection->excuteQuery($sql);
echo json_encode($sp);

?>