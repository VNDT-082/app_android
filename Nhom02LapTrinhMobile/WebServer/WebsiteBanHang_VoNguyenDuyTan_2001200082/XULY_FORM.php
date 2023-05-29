<?php
require("HomeController.php");
if($_SERVER['REQUEST_METHOD'] == 'POST' )
{
    if(isset($_POST['sua']))
    {
        $size_=$_POST['size'];
        $ID_SP1_=$_POST['ID_SP1'];
        $SoLuong_=$_POST['soluong'];
        $LuongDuong_=$_POST['luongduong'];
        $LuongDa_=$_POST['luongda'];
        $kq=GioHang::SuaChiTietSanPham($ID_SP1_,$size_,$SoLuong_,$LuongDuong_,$LuongDa_);
        var_dump($kq);
        if($kq<=0)
        {
            header('location: NoConnect.php');
            exit();
        }
        else
        {
            header('location: ViewGioHang.php');
            exit();
        }
    }
    if(isset($_POST['dathang']))
    {
        $MaNguoiDung_=$_POST['MaNguoiDung'];
        $TOTAL=$_POST['TOTAL'];
        $gioHang=GioHang::getAll($MaNguoiDung_);
        var_dump($gioHang);
        $DatHang=new DatHang();
        $DatHang->MaChiNhanh=$_POST['chinhanh_'];
        $DatHang->MaNguoiDung=$MaNguoiDung_;
        $DatHang->TongTien=$TOTAL;
        $LoaiKhach=LoaiKhachHang::getOneByIdKhachHang($MaNguoiDung_);
        if($LoaiKhach!=null)
        {
            $DatHang->UuDai=$LoaiKhach->UuDai;
        }
        $DatHang->GiaGiamCon=$DatHang->TongTien-$DatHang->TongTien*$DatHang->UuDai/100;

        $DatHang->MaDonHang=$DatHang->insertOne();
        if( $DatHang->MaDonHang<=0)
        {
            header('location: NoConnect.php');
            exit();
        }
        $kq=0;
        if($DatHang->MaDonHang>0)
        {
            foreach($gioHang as $gh)
            {
                $ChiTietDatHang=new ChiTietDatHang();
                $ChiTietDatHang->MaDonHang=$DatHang->MaDonHang;
                $ChiTietDatHang->MaSanPham=$gh->MaSanPham;
                $ChiTietDatHang->SoLuong=$gh->SoLuong;
                $TongTienSanPham_=0;
                $TongTienSanPhamSauGiam_=0;
                $KhuyenMai_=KhuyenMai::getOneByIdProduct($gh->MaSanPham);
                
                $ListSize=Size::getAll();
                $listTopping_=ChiTietToppingGioHang::getAll($gh->Id);
                $TongTienTopping_=0;
                $GiaSize_=0;
                if($listTopping_!=null)
                {
                    foreach($listTopping_ as $toppingItem_)
                    {
                        $TongTienTopping_+=$toppingItem_->Topping->Gia;
                    }
                }
                foreach($ListSize as $s)
                {
                    if($s->MaSize==$gh->MaSize)
                    {
                        $GiaSize_=$s->Gia;
                    }
                }
                if($KhuyenMai_!=null)
                {
                    $TongTienSanPhamSauGiam_=($TongTienTopping+($gh->GiaBan-($gh->GiaBan*$KhuyenMai_->ChiTiet/100))+$GiaSize_)*$gh->SoLuong;
                }
                $TongTienSanPham_= ($TongTienTopping+ $gh->GiaBan +$GiaSize_)*$gh->SoLuong;
                $ChiTietDatHang->GiaBan=$TongTienSanPham_;
                if($KhuyenMai_!=null)
                {
                    $ChiTietDatHang->KhuyenMai=$KhuyenMai_->ChiTiet;
                }
                else
                {
                    $ChiTietDatHang->KhuyenMai=0;
                }
                $ChiTietDatHang->GiamCon=$TongTienSanPhamSauGiam_;
                $ChiTietDatHang->MaSize=$gh->MaSize;
                $ChiTietDatHang->LuongDuong=$gh->LuongDuong;
                $ChiTietDatHang->LuongDa=$gh->LuongDa;
                
                $kq=$ChiTietDatHang->insertOneChiTietDatHang();
                if($kq>0)
                {
                    foreach($listTopping_ as $toppingItem_)
                    {
                        $ChiTietToppingDatHang_=new ChiTietToppingDatHang();
                        $ChiTietToppingDatHang_->MaDonHang=$ChiTietDatHang->MaDonHang;
                        $ChiTietToppingDatHang_->MaSanPham=$ChiTietDatHang->MaSanPham;
                        $ChiTietToppingDatHang_->MaTopping=$toppingItem_->Topping->MaTopping;
                        $ChiTietToppingDatHang_->Gia=$toppingItem_->Topping->Gia;
                        
                        $kq=$ChiTietToppingDatHang_->insertOneChiTietToppingDatHang();
                    }
                    if($kq>0)
                    {
                        $kq=ChiTietToppingGioHang::XoaHetToppingKhoiSanPham($gh->Id);
                        
                        $kq=GioHang::XoaMotSanPhamKhoiGioHang($gh->Id);

                        // header('location: ViewGioHang.php');
                        // exit();
                    }
                    else if($kq<=0)
                    {
                        // header('location: NoConnect.php');
                        // exit();
                    }
                }
            }

        }
        if($kq>0)
                    {
                        // $kq=ChiTietToppingGioHang::XoaHetToppingKhoiSanPham($gh->Id);
                        
                        // $kq=GioHang::XoaMotSanPhamKhoiGioHang($gh->Id);

                        header('location: ViewGioHang.php');
                        exit();
                    }
                    else if($kq<=0)
                    {
                        header('location: NoConnect.php');
                        exit();
                    }
    }
}
    


?>