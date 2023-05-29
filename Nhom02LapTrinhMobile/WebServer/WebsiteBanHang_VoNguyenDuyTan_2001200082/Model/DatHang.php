<?php
class DatHang{
    public $MaDonHang;
    public $MaNguoiDung;
    public $MaChiNhanh;
    public $TongTien;
    public $UuDai;
    public $GiaGiamCon;
    public $TrangThai;
    public $NgayMua;
    public  function __construct($MaDonHang="",$MaNguoiDung="",$MaChiNhanh="",$TongTien=0,$UuDai="",$GiaGiamCon=0,$TrangThai=0, $NgayMua="")
    {
        $this->MaDonHang=$MaDonHang;
        $this->MaNguoiDung=$MaNguoiDung;
        $this->MaChiNhanh=$MaChiNhanh;
        $this->TongTien=$TongTien;
        $this->UuDai=$UuDai;
        $this->GiaGiamCon=$GiaGiamCon;
        $this->TrangThai=$TrangThai;
        $this->NgayMua=$NgayMua;
    }

    public function insertOne()
    {
        $sql="INSERT INTO dathang( MaNguoiDung, MaChiNhanh, TongTien, UuDai, GiaGiamCon, TrangThai) VALUES ".
        "('".$this->MaNguoiDung."','".$this->MaChiNhanh."','".$this->TongTien."','".$this->UuDai."','".$this->GiaGiamCon."',0)";
        $connection=new Connection();
        $this->MaDonHang=$connection->excuteInsert($sql);
        return $this->MaDonHang;
    }

    public function DuyetDon()
    {
        $sql="UPDATE dathang SET TrangThai= 1 WHERE MaDonHang=".$this->MaDonHang.";";
        $connection=new Connection();
        $kq=$connection->excuteUpdate($sql);
        return $kq;
    }
    public function HuyDon()
    {
        $sql="DELETE FROM dathang WHERE MaDonHang=".$this->MaDonHang.";";
        $connection=new Connection();
        $kq=$connection->excuteUpdate($sql);
        return $kq;
    }
    public static function HuyDonHang($MaDonHang)
    {
        $sql="DELETE FROM dathang WHERE MaDonHang=".$MaDonHang."";
        $connection=new Connection();
        $kq=$connection->excuteUpdate($sql);
        return $kq;
    }
    public static function LaySanPhamDangChoDuyet($MaNguoiDung)
    {
        $sql="SELECT * FROM dathang WHERE dathang.MaNguoiDung=$MaNguoiDung AND dathang.TrangThai=0;";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        $DanhSachDatHang=array();
        if($resultData!=null)
        {
            foreach($resultData as $data)
            {
                $DatHang=new DatHang();
                $DatHang->MaDonHang=$data["MaDonHang"];
                $DatHang->MaNguoiDung=$data["MaNguoiDung"];
                $DatHang->MaChiNhanh=$data["MaChiNhanh"];
                $DatHang->TongTien=$data["TongTien"];
                $DatHang->UuDai=$data["UuDai"];
                $DatHang->GiaGiamCon=$data["GiaGiamCon"];
                $DatHang->TrangThai=$data["TrangThai"];
                $DatHang->NgayMua=$data["NgayMua"];
                $DanhSachDatHang[]=$DatHang;
            }
            return $DanhSachDatHang;
        }
        return null;
    }


    public static function LayTatCaDonCuaMotKhachHang($MaNguoiDung)
    {
        $sql="SELECT * FROM dathang WHERE dathang.MaNguoiDung=$MaNguoiDung ;";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        $DanhSachDatHang=array();
        if($resultData!=null)
        {
            foreach($resultData as $data)
            {
                $DatHang=new DatHang();
                $DatHang->MaDonHang=$data["MaDonHang"];
                $DatHang->MaNguoiDung=$data["MaNguoiDung"];
                $DatHang->MaChiNhanh=$data["MaChiNhanh"];
                $DatHang->TongTien=$data["TongTien"];
                $DatHang->UuDai=$data["UuDai"];
                $DatHang->GiaGiamCon=$data["GiaGiamCon"];
                $DatHang->TrangThai=$data["TrangThai"];
                $DatHang->NgayMua=$data["NgayMua"];
                $DanhSachDatHang[]=$DatHang;
            }
            return $DanhSachDatHang;
        }
        return null;
    }

    public static function LayTatCaDonHangChoDuyet()
    {
        $sql="SELECT * FROM dathang WHERE dathang.TrangThai=0;";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        $DanhSachDatHang=array();
        if($resultData!=null)
        {
            foreach($resultData as $data)
            {
                $DatHang=new DatHang();
                $DatHang->MaDonHang=$data["MaDonHang"];
                $DatHang->MaNguoiDung=$data["MaNguoiDung"];
                $DatHang->MaChiNhanh=$data["MaChiNhanh"];
                $DatHang->TongTien=$data["TongTien"];
                $DatHang->UuDai=$data["UuDai"];
                $DatHang->GiaGiamCon=$data["GiaGiamCon"];
                $DatHang->TrangThai=$data["TrangThai"];
                $DatHang->NgayMua=$data["NgayMua"];
                $DanhSachDatHang[]=$DatHang;
            }
            return $DanhSachDatHang;
        }
        return null;
    }
    public static function LayTatCaDonDangDaDuyet()
    {
        $sql="SELECT * FROM dathang WHERE dathang.TrangThai=1 ORDER BY MaDonHang DESC;";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        $DanhSachDatHang=array();
        if($resultData!=null)
        {
            foreach($resultData as $data)
            {
                $DatHang=new DatHang();
                $DatHang->MaDonHang=$data["MaDonHang"];
                $DatHang->MaNguoiDung=$data["MaNguoiDung"];
                $DatHang->MaChiNhanh=$data["MaChiNhanh"];
                $DatHang->TongTien=$data["TongTien"];
                $DatHang->UuDai=$data["UuDai"];
                $DatHang->GiaGiamCon=$data["GiaGiamCon"];
                $DatHang->TrangThai=$data["TrangThai"];
                $DatHang->NgayMua=$data["NgayMua"];
                $DanhSachDatHang[]=$DatHang;
            }
            return $DanhSachDatHang;
        }
        return null;
    }
    public static function LaySanPhamDaMua($MaNguoiDung)
    {
        $sql="SELECT * FROM dathang WHERE dathang.MaNguoiDung=$MaNguoiDung AND dathang.TrangThai=1;";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        $DanhSachDatHang=array();
        if($resultData!=null)
        {
            foreach($resultData as $data)
            {
                $DatHang=new DatHang();
                $DatHang->MaDonHang=$data["MaDonHang"];
                $DatHang->MaNguoiDung=$data["MaNguoiDung"];
                $DatHang->MaChiNhanh=$data["MaChiNhanh"];
                $DatHang->TongTien=$data["TongTien"];
                $DatHang->UuDai=$data["UuDai"];
                $DatHang->GiaGiamCon=$data["GiaGiamCon"];
                $DatHang->TrangThai=$data["TrangThai"];
                $DatHang->NgayMua=$data["NgayMua"];
                $DanhSachDatHang[]=$DatHang;
            }
            return $DanhSachDatHang;
        }
        return null;
    }
    public static function LayTatCa()
    {
        $sql="SELECT * FROM dathang ;";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        $DanhSachDatHang=array();
        if($resultData!=null)
        {
            foreach($resultData as $data)
            {
                $DatHang=new DatHang();
                $DatHang->MaDonHang=$data["MaDonHang"];
                $DatHang->MaNguoiDung=$data["MaNguoiDung"];
                $DatHang->MaChiNhanh=$data["MaChiNhanh"];
                $DatHang->TongTien=$data["TongTien"];
                $DatHang->UuDai=$data["UuDai"];
                $DatHang->GiaGiamCon=$data["GiaGiamCon"];
                $DatHang->TrangThai=$data["TrangThai"];
                $DatHang->NgayMua=$data["NgayMua"];
                $DanhSachDatHang[]=$DatHang;
            }
            return $DanhSachDatHang;
        }
        return null;
    }
    public static function LayMotDonDatBangMaDonHang($MaDonHang)
    {
        $sql="SELECT * FROM dathang WHERE MaDonHang=".$MaDonHang.";";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        if($resultData!=null)
        {
            foreach($resultData as $data)
            {
                $DatHang=new DatHang();
                $DatHang->MaDonHang=$data["MaDonHang"];
                $DatHang->MaNguoiDung=$data["MaNguoiDung"];
                $DatHang->MaChiNhanh=$data["MaChiNhanh"];
                $DatHang->TongTien=$data["TongTien"];
                $DatHang->UuDai=$data["UuDai"];
                $DatHang->GiaGiamCon=$data["GiaGiamCon"];
                $DatHang->TrangThai=$data["TrangThai"];
                $DatHang->NgayMua=$data["NgayMua"];
                return $DatHang;
            }
        }
        return null;
    }
    public static function LayDonHangDaMuaTrongThangHT()
    {
        $sql="SELECT * FROM dathang WHERE dathang.NgayMua<  ADDDATE(CURRENT_DATE(),1) AND  MONTH(CURRENT_DATE())=  MONTH(dathang.NgayMua);";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        $DanhSachDatHang=array();
        if($resultData!=null)
        {
            foreach($resultData as $data)
            {
                $DatHang=new DatHang();
                $DatHang->MaDonHang=$data["MaDonHang"];
                $DatHang->MaNguoiDung=$data["MaNguoiDung"];
                $DatHang->MaChiNhanh=$data["MaChiNhanh"];
                $DatHang->TongTien=$data["TongTien"];
                $DatHang->UuDai=$data["UuDai"];
                $DatHang->GiaGiamCon=$data["GiaGiamCon"];
                $DatHang->TrangThai=$data["TrangThai"];
                $DatHang->NgayMua=$data["NgayMua"];
                $DanhSachDatHang[]=$DatHang;
            }
            return $DanhSachDatHang;
        }
        return null;
    }
    
}
?>