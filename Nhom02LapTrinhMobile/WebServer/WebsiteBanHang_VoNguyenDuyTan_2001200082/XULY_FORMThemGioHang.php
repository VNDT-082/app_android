<?php
require("HomeController.php");
session_start();
$id=$_GET["id"];
$sanpham=SanPham::LayMotSanPham($id);
$ListTopping=Topping::getAll();
//lay list size
$ListSize=Size::getAll();
//lay list san pham cung loai
$listProductSameCategory=SanPham::getProductSameCategory($sanpham->getMaLoai());
//lay khuyen mai
$KhuyenMai=KhuyenMai::getOneByIdProduct($sanpham->getMaSanPham());
$GiaSauGiam=0;
if($KhuyenMai!=null)
{
    $GiaSauGiam=$sanpham->getGiaBan() - $sanpham->getGiaBan()*$KhuyenMai->ChiTiet/100;
} 
//lay danh gia san pham;
$ListCommnet=NhanXet::getAllWithProductID($sanpham->maSanPham);
if(isset($_SESSION["KhachHang"]))
{
    $KhachHang=$_SESSION["KhachHang"];
    if($_SERVER['REQUEST_METHOD'] == 'POST' )
 {
    
    if(isset($_POST['themvaogiohang']))
    {
        $Size=$_POST['selectElement'];
        $LuongDuong=$_POST['luongduong'];
        $Luongda=$_POST['luongda'];
        $SoLuong=$_POST['soluong'];
        $dsTopping_insert=array();
        foreach($ListTopping as $topping)
        {
            if(isset($_POST[$topping->getMaTopping()]))
            {
                $tp=Topping::getOneByID($topping->getMaTopping());
                $dsTopping_insert[]=$tp;
            }
            
        }
        $GioHangInsert=new GioHang();
        $GioHangInsert->MaNguoiDung=$KhachHang->MaNguoiDung;
        $GioHangInsert->MaSanPham=$sanpham->maSanPham;
        $GioHangInsert->MaSize=$Size;
        $GioHangInsert->LuongDa=$Luongda;
        $GioHangInsert->LuongDuong=$LuongDuong;
        $GioHangInsert->SoLuong=$SoLuong;
        $GioHangInsert->Id= $GioHangInsert->ThemSanPhamVaoGioHang($dsTopping_insert);
        if($GioHangInsert->Id>0)
            {
                echo '<script type="text/javascript">
                            window.onload = function () { alert("Đã thêm sản phẩm: '.$sanpham->tenSanPham.' vào giỏ hàng."); }
                </script>';
                $url="ChiTietSanPham.php?id=".$sanpham->maSanPham;
                header('location:'. $url);
                exit();

            }
            else
            {
                echo '<script type="text/javascript">
                            window.onload = function () { alert("Thêm sản phẩm: '.$sanpham->tenSanPham .' vào giỏ hàng không thành công."); }
                </script>';
                 header('location: NoConnect.php');
                exit();

            }

    }
    else if(isset($_POST['ThemNhanXet']))
    {
        $SanPhamDaMua= SanPham::getListProductByUserId($KhachHang->MaNguoiDung);
        if($SanPhamDaMua==null)
        {
            echo '<script type="text/javascript">
                        window.onload = function () { alert("Thêm nhận xét không thành công!"); }
            </script>';
             header('location: NoConnect.php');
                exit();
        }
        else
        {
            $NhanXet=$_POST['NhanXet'];
            $DanhGia=$_POST['star'];
            $Cmt=new NhanXet();
            $Cmt->MaNguoiDung=$KhachHang->MaNguoiDung;
            $Cmt->MaSanPham=$sanpham->maSanPham;
            $Cmt->NoiDung=$NhanXet;
            $Cmt->DanhGia=$DanhGia;
            $Cmt->id=$Cmt->ThemNhanXet();
            if($Cmt->id>0)
            {
                echo '<script type="text/javascript">
                            window.onload = function () { alert("Đã thêm nhận xét thành công!"); }
                </script>';

                $url="ChiTietSanPham.php?id=".$sanpham->maSanPham;
                header('location:'. $url);
                exit();
            }
            else
            {
                echo '<script type="text/javascript">
                            window.onload = function () { alert("Thêm nhận xét không thành công!"); }
                </script>';
                 header('location: NoConnect.php');
                exit();

            }
        }
        
    }
    
}
}
else{
    $url="ChiTietSanPham.php?id=".$sanpham->maSanPham;
    header('location:'. $url);
    exit();
}



?>