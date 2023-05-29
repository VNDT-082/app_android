<?php
require("..//Model/Connection.php");
$SDTDangNhap=$_GET["SDTDangNhap"];

$connection=new Connection;
$sql="SELECT nguoidung.MaNguoiDung, nguoidung.MaLoaiKH, loaikhachhang.TenLoaiKhach, loaikhachhang.UuDai ,nguoidung.TenNguoiDung,"
." nguoidung.SDTDangNhap, nguoidung.SDTLienHe, nguoidung.Email, nguoidung.AnhDaiDien, nguoidung.GioiTinh, nguoidung.NgaySinh "
."FROM nguoidung, loaikhachhang  WHERE nguoidung.MaLoaiKH=loaikhachhang.MaLoaiKH AND nguoidung.SDTDangNhap=".$SDTDangNhap.";";
$KhachHang=$connection->excuteQuery($sql);
echo json_encode($KhachHang);

?>