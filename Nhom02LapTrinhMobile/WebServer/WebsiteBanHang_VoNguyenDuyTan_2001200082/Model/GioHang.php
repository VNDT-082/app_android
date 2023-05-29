<?php
class GioHang
{
    public $Id;
    public $MaNguoiDung;
    public $MaSanPham;
    public $MaSize;
    public $SoLuong;
    public $LuongDuong;
    public $LuongDa;
    public $HinhAnh;
    public $GiaBan;
    public $TenSanPham;

    public function __construct($Id="",$MaNguoiDung="",$MaSanPham="",
    $MaSize="SM",$SoLuong=0, $LuongDuong="Vừa đủ", $LuongDa="Vừa đủ", $HinhAnh="",$GiaBan=0,$TenSanPham="")
    {
        $this->Id=$Id;
        $this->MaNguoiDung=$MaNguoiDung;
        $this->MaSanPham=$MaSanPham;
        $this->MaSize=$MaSize;
        $this->SoLuong=$SoLuong;
        $this->LuongDuong=$LuongDuong;
        $this->LuongDa=$LuongDa;
        $this->HinhAnh=$HinhAnh;
        $this->GiaBan=$GiaBan;
        $this->TenSanPham=$TenSanPham;
    }

    public function getDanhSachTopping($id)
    {
        $dsTopping=array();
        $dsTopping=ChiTietToppingGioHang::getAll($id);
        return $dsTopping;
    }

    public static function getAll($MaNguoiDung)
    {
         $connection=new Connection();
        
        $sql="SELECT giohang.ID, giohang.MaNguoiDung, giohang.MaSanPham, giohang.MaSize, giohang.SoLuong, giohang.LuongDuong, "
        ."giohang.LuongDa,sanpham.HinhAnh, sanpham.GiaBan, sanpham.TenSanPham FROM giohang, sanpham WHERE giohang.MaSanPham=sanpham.MaSanPham "
        ."AND giohang.MaNguoiDung='$MaNguoiDung'";
        $resultData=$connection->excuteQuery($sql);
        $listGioHang=array();
        if($resultData!=null)
        {
            foreach($resultData as $gioHang)
            {
                $cart=new GioHang();
                $cart->Id=$gioHang["ID"];
                $cart->MaNguoiDung=$gioHang["MaNguoiDung"];
                $cart->MaSanPham=$gioHang["MaSanPham"];
                $cart->MaSize=$gioHang["MaSize"];
                $cart->SoLuong=$gioHang["SoLuong"];
                $cart->LuongDuong=$gioHang["LuongDuong"];
                $cart->LuongDa=$gioHang["LuongDa"];
                $cart->HinhAnh=$gioHang["HinhAnh"];
                $cart->GiaBan=$gioHang["GiaBan"];
                $cart->TenSanPham=$gioHang["TenSanPham"];
                $listGioHang[]=$cart;
            }
            return $listGioHang;
        }
        return null;
    }
    public function ThemSanPhamVaoGioHang( $DanhSachTopping)
    {
        $connection=new Connection();
        $kq=false;
        $sql="INSERT INTO `giohang`( `MaNguoiDung`, `MaSanPham`, `MaSize`, `SoLuong`, `LuongDuong`, `LuongDa`) VALUES ".
        "('".$this->MaNguoiDung."','".$this->MaSanPham."','".$this->MaSize."','".$this->SoLuong."','".
        $this->LuongDuong."','".$this->LuongDa."')";
        $this->Id = $connection->excuteInsert($sql);
        echo"id gio hang ne";
        var_dump($this->Id);
        $kq=true;
        if($kq==true)
        {
           
            foreach($DanhSachTopping as $Top)
            {
                $kq=false;
                $sql_child="INSERT INTO `chitiettoppinggiohang`(`ID`, `MaTopping`, `Gia`) VALUES ('".
                $this->Id."','".$Top->MaTopping."','".$Top->Gia."')";
                $result=$connection->excuteInsert($sql_child);
                $kq=true;
            }
        }
        return $kq;
    }

    public static function XoaMotSanPhamKhoiGioHang($ID)
    {
        $connection=new Connection();
        $kq=false;
        $sql="DELETE FROM giohang WHERE giohang.ID=$ID;";
        $kq= $connection->excuteUpdate($sql);
        return $kq;
    }
    public static function SuaChiTietSanPham($ID_SP,$Size,$SoLuong,$LuongDuong,$LuongDa)
    {
        $sql="UPDATE giohang SET  MaSize ='".$Size."', SoLuong ='".$SoLuong."', LuongDuong ='".$LuongDuong."', LuongDa='".$LuongDa
        ."' WHERE ID=".$ID_SP.";";
        $connection=new Connection();
        $kq=false;
        $kq= $connection->excuteUpdate($sql);
        return $kq;
    }
    
}
?>