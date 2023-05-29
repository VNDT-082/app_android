<?php
class ChiTietDatHang
{
    public $MaSanPham;
    public $MaDonHang;
    public $SoLuong;
    public $GiaBan;
    public $KhuyenMai;
    public $GiamCon;
    public $MaSize;
    public $LuongDuong;
    public $LuongDa;

    public function __construct($MaSanPham="",$MaDonHang="",$SoLuong=0,$GiaBan=0,$KhuyenMai=0,$GiamCon=0, $MaSize="SM", $LuongDuong="", $LuongDa="")
    {
        $this->MaSanPham=$MaSanPham;
        $this->MaDonHang=$MaDonHang;
        $this->SoLuong=$SoLuong;
        $this->GiaBan=$GiaBan;
        $this->KhuyenMai=$KhuyenMai;
        $this->GiamCon=$GiamCon;
        $this->MaSize=$MaSize;
        $this->LuongDuong=$LuongDuong;
        $this->LuongDa=$LuongDa;
    }
    public function insertOneChiTietDatHang()
    {
        $sql="INSERT INTO chitietdathang(MaSanPham, MaDonHang, SoLuong, GiaBan, KhuyenMai, GiamCon, MaSize, LuongDuong, LuongDa) VALUES ".
        "('".$this->MaSanPham."','".$this->MaDonHang."','".$this->SoLuong."','".$this->GiaBan."','"
        .$this->KhuyenMai."','".$this->GiamCon."', '".$this->MaSize."','".$this->LuongDuong."' ,'".$this->LuongDa."');";
        $connection=new Connection();
        $kq=$connection->excuteUpdate($sql);
        return $kq;
    }
    public static function XoaNhungChiTietBangMaDonHang($MaDonHang)
    {
        $sql="DELETE FROM chitietdathang WHERE MaDonHang=".$MaDonHang.";";
        $connection=new Connection();
        $kq=$connection->excuteUpdate($sql);
        return $kq;
    }
    public static function LayDanhSachDonHangMaDonHangVaMaNguoiDung($MaDonHang)
    {
        $sql="SELECT * FROM chitietdathang WHERE chitietdathang.MaDonHang=$MaDonHang;";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        $DanhSachChiTietDatHang=array();
        if($resultData!=null)
        {
            foreach($resultData as $data)
            {
                $ChiTietDatHang=new ChiTietDatHang();
                $ChiTietDatHang->MaSanPham=$data["MaSanPham"];
                $ChiTietDatHang->MaDonHang=$data["MaDonHang"];
                $ChiTietDatHang->SoLuong=$data["SoLuong"];
                $ChiTietDatHang->GiaBan=$data["GiaBan"];
                $ChiTietDatHang->KhuyenMai=$data["KhuyenMai"];
                $ChiTietDatHang->GiamCon=$data["GiamCon"];
                $ChiTietDatHang->MaSize=$data["MaSize"];
                $ChiTietDatHang->LuongDuong=$data["LuongDuong"];
                $ChiTietDatHang->LuongDa=$data["LuongDa"];
                $DanhSachChiTietDatHang[]=$ChiTietDatHang;
            }
            return $DanhSachChiTietDatHang;
        }
        return null;
    }
}
?>