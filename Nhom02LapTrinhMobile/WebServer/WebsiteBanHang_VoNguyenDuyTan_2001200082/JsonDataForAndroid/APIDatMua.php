<?php
require("..//HomeController.php");

$MaNguoiDung_=$_POST['MaNguoiDung'];
$DiaChiNhan=$_POST['DiaChiNhanHang'];

$TOTAL=0;
$gioHang=GioHang::getAll($MaNguoiDung_);

$DatHang=new DatHang();
$DatHang->MaChiNhanh=$DiaChiNhan;
$DatHang->MaNguoiDung=$MaNguoiDung_;

foreach($gioHang as $gioHangItem)
{
    $TOTAL+=$gioHangItem->GiaBan;
    $ChiTietToppingGioHang=ChiTietToppingGioHang::getAll($gioHangItem->Id);
    if($ChiTietToppingGioHang!=null)
    {
        foreach($ChiTietToppingGioHang as $toppingItem)
        {
            $TOTAL+=$toppingItem->Topping->getGia();
        }
    }
    
}
$DatHang->TongTien=$TOTAL;


//$DatHang->TongTien=$TOTAL;
$LoaiKhach=LoaiKhachHang::getOneByIdKhachHang($MaNguoiDung_);
if($LoaiKhach!=null)
{
    $DatHang->UuDai=$LoaiKhach->UuDai;
}
$DatHang->GiaGiamCon=$DatHang->TongTien-$DatHang->TongTien*$DatHang->UuDai/100;

$DatHang->MaDonHang=$DatHang->insertOne();
if( $DatHang->MaDonHang<=0)
{
    echo "-1";
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
            $TongTienSanPhamSauGiam_=($TongTienTopping_+($gh->GiaBan-($gh->GiaBan*$KhuyenMai_->ChiTiet/100))+$GiaSize_)*$gh->SoLuong;
        }
        $TongTienSanPham_= ($TongTienTopping_+ $gh->GiaBan +$GiaSize_)*$gh->SoLuong;
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

                echo "1";
            }
            else if($kq<=0)
            {
                echo "0";
            }
        }
    }
}

?>