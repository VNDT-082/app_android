<?php
require("HomeController.php");
  if($_SERVER['REQUEST_METHOD'] == 'POST' )
 {
    
    if(isset($_POST['ThemNhanVien']))
    {
        $NhanVien=new NhanVien();
        $NhanVien->TenNhanVien=$_POST["TenNhanVien"];
        $NhanVien->GioiTinh=$_POST["GioiTinh"];
        $NhanVien->NgaySinh=$_POST["NgaySinh"];
        $NhanVien->MaChiNhanh=$_POST["ChiNhanh"];
        $NhanVien->SDTDangNhap=$_POST["SDTDangNhap"];
        $NhanVien->SDTLienHe=$_POST["SDTLienHe"];
        $NhanVien->NgayVaoLam=$_POST["NgayVaoLam"];

        $TaiKhoan=new TaiKhoan();
        $TaiKhoan->SDTDangNhap=$_POST["SDTDangNhap"];
        $TaiKhoan->LoaiTaiKhoan=$_POST["TrangThai"];
        $TaiKhoan->MatKhau=$_POST["MatKhau"];
        $TaiKhoan->MatKhau=password_hash($TaiKhoan->MatKhau, PASSWORD_DEFAULT);
        $kq=$TaiKhoan->ThemMotTaiKhoanNhanVien();
        if($kq<=0)
        {
            header('location: NoConnect.php');
            exit();
        }
        else
        {
            $NhanVien->MaNhanVien=$NhanVien->ThemMotNhanVien();
            if($NhanVien->MaNhanVien<=0)
            {
                header('location: NoConnect.php');
                exit();
            }
            else
            {
                header('location: QuanLyNhanVien.php');
                exit();
            }
        }

    }
    if(isset($_POST['SuaNhanVien']))
    {

        $TaiKhoan=new TaiKhoan();
        $TaiKhoan->SDTDangNhap=$_POST["SDTDangNhap"];
        $TaiKhoan->LoaiTaiKhoan=$_POST["TrangThai"];
        $TaiKhoan->MatKhau=$_POST["MatKhau"];
            var_dump($TaiKhoan);
        $TaiKhoan->MatKhau=password_hash($TaiKhoan->MatKhau, PASSWORD_DEFAULT);
        $kq=$TaiKhoan->DoiMatKhauMotTaiKhoanKhachHang();
        if($kq<=0)
        {
            // header('location: NoConnect.php');
            // exit();
        }
        else
        {
             header('location: QuanLyNhanVien.php');
                exit();
        }

    }
}
?>