<?php
class chitiettoppingdathang{
    public $MaSanPham;
    public $MaDonHang;
    public $MaTopping;
    public $Gia;
    public function __construct($MaSanPham="",$MaDonHang="",$MaTopping="",$Gia=0)
    {
        $this->MaSanPham=$MaSanPham;
        $this->MaDonHang=$MaDonHang;
        $this->MaTopping=$MaTopping;
        $this->Gia=$Gia;
    }
    public function insertOneChiTietToppingDatHang()
    {
        $sql="INSERT INTO chitiettoppingdathang(MaSanPham, MaDonHang, MaTopping, Gia) VALUES ".
        "('".$this->MaSanPham."','".$this->MaDonHang."','".$this->MaTopping."','".$this->Gia."');";
        $connection=new Connection();
        $kq=$connection->excuteUpdate($sql);
        return $kq;
    }
    public static function XoaNhungToppingTheoMaDonHang($MaDonHang)
    {
        $sql="DELETE FROM chitiettoppingdathang WHERE MaDonHang=".$MaDonHang.";";
        $connection=new Connection();
        $kq=$connection->excuteUpdate($sql);
        return $kq;
    }
    public static function LayDanhSachToppingTheoMaCTDH($MaSanPham,$MaDonHang)
    {
        $sql="SELECT MaSanPham, MaDonHang, MaTopping, Gia FROM chitiettoppingdathang WHERE chitiettoppingdathang.MaSanPham=".$MaSanPham.
        " AND chitiettoppingdathang.MaDonHang=".$MaDonHang.";";

        $connection=new Connection();
        $ResultData=$connection->excuteQuery($sql);
        $listTopping=array();
        if($ResultData!=null)
        {
            foreach($ResultData as $topping)
            {
                $ChiTietTopping=new chitiettoppingdathang();
                $ChiTietTopping->MaSanPham=$topping["MaSanPham"];
                $ChiTietTopping->MaDonHang=$topping["MaDonHang"];
                $ChiTietTopping->MaTopping=$topping["MaTopping"];
                $ChiTietTopping->Gia=$topping["Gia"];
                $listTopping[]=$ChiTietTopping;
            }
            return $listTopping;
        }
        return null;
    }
    public static function LayDanhSachToppingTheoMaDonHang($MaDonHang)
    {
        $sql="SELECT MaSanPham, MaDonHang, MaTopping, Gia FROM chitiettoppingdathang WHERE chitiettoppingdathang.MaDonHang="
        .$MaDonHang.";";

        $connection=new Connection();
        $ResultData=$connection->excuteQuery($sql);
        $listTopping=array();
        if($ResultData!=null)
        {
            foreach($ResultData as $topping)
            {
                $ChiTietTopping=new chitiettoppingdathang();
                $ChiTietTopping->MaSanPham=$topping["MaSanPham"];
                $ChiTietTopping->MaDonHang=$topping["MaDonHang"];
                $ChiTietTopping->MaTopping=$topping["MaTopping"];
                $ChiTietTopping->Gia=$topping["Gia"];
                $listTopping[]=$ChiTietTopping;
            }
            return $listTopping;
        }
        return null;
    }

}

?>