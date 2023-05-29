<?php
require("HomeController.php");

if($_SERVER['REQUEST_METHOD'] == 'POST' )
{
    if(isset($_POST['DangKy']))
    {
        $NguoiDung=new NguoiDung();
        $taiKhoan=new TaiKhoan();
        $taiKhoan->SDTDangNhap=$_POST["sdt"];
        $MatKhau=$_POST["pass"];
        $taiKhoan->MatKhau = password_hash($MatKhau, PASSWORD_DEFAULT);


        $NguoiDung->TenNguoiDung=$_POST[""];
        $NguoiDung->SDTDangNhap=$_POST["sdt"];
        $NguoiDung->SDTLienHe=$_POST["sdt"];
        $NguoiDung->TenNguoiDung=$_POST["TenNguoiDung"];
        $NguoiDung->NgaySinh=$_POST["NgaySinh"];
        $NguoiDung->Email=$_POST["Email"];
        $NguoiDung->GioiTinh=$_POST["GioiTinh"];
        $kq=$taiKhoan->ThemMotTaiKhoanKhachHang();
        var_dump($taiKhoan);
        if($kq<=0)
        {
            header('location: NoConnect.php');
            exit();
        }
        else
        {
            $NguoiDung->MaNguoiDung=$NguoiDung->ThemMotKhachHang();
            if($NguoiDung->MaNguoiDung<=0)
            {
                header('location: NoConnect.php');
                exit();
            }
            else
            {
                header('location: Login.php');
                exit();
            }
        }
    }
}

?>