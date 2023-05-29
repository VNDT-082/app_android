<?php
require("HomeController.php");
require ("send-email.php");
if($_SERVER['REQUEST_METHOD'] == 'POST' )
{
    if(isset($_POST['NhanDonHang']))
    {
        $MaDonHang=$_POST["MaDonHang"];
        $DonHang=DatHang::LayMotDonDatBangMaDonHang($MaDonHang);
        if($DonHang!=null)
        {
            
            $kq=$DonHang->DuyetDon();
            if($kq<=0)
            {
                header('location: NoConnect.php');
                exit();
            }
            else
            {
                $KhachHang=NguoiDung::LayMotNguoiDung($DonHang->MaNguoiDung);
                if($KhachHang!=null)
                {
                    $kq=guimailCamOn($KhachHang->Email,$KhachHang->TenNguoiDung);
                    header('location: QuanLyDonHang.php');
                    exit();
                }
                
               
            }
        }
    }
    if(isset($_POST['HuyDonHang']))
    {
        $MaDonHang=$_POST["MaDonHang"];
        $DonHang=DatHang::LayMotDonDatBangMaDonHang($MaDonHang);
        var_dump($DonHang);
        if($DonHang!=null)
        {
            $DanhSachToppingHuy=chitiettoppingdathang::LayDanhSachToppingTheoMaDonHang($MaDonHang);
            if($DanhSachToppingHuy!=null)
            {
                $kq=chitiettoppingdathang::XoaNhungToppingTheoMaDonHang($MaDonHang);
            }
            
            if($kq<=0)
            {
                // header('location: NoConnect.php');
                // exit();
            }
            else
            {
                $DanhSachChiTietDonHuy=ChiTietDatHang::LayDanhSachDonHangMaDonHangVaMaNguoiDung($MaDonHang);
                if($DanhSachChiTietDonHuy!=null)
                {
                    $kq=ChiTietDatHang::XoaNhungChiTietBangMaDonHang($MaDonHang);
                }
                
                if($kq<=0)
                {
                    header('location: NoConnect.php');
                    exit();
                }
                else
                {
                    var_dump($DonHang);
                    $kq=DatHang::HuyDonHang($MaDonHang);
                    if($kq<=0)
                    {
                        header('location: NoConnect.php');
                        exit();
                    }
                    else
                    {
                        header('location: QuanLyDonHang.php');
                        exit();
                    }
                }
            }
        }
    }
}
?>