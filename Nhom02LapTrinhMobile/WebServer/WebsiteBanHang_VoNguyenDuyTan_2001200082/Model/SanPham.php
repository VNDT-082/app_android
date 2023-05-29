<?php
class SanPham
{
    public $maSanPham;
    public $tenSanPham;
    public $maLoai;
    public $moTa;
    public $luotMua;
    public $hinhAnh;
    public $giaBan;
    public $trangThai;

    public function getMaSanPham()
    {
        return $this->maSanPham;
    }
    public function setMaSanPham($maSanPham)
    {
        $this->maSanPham=$maSanPham;
    }
    public function getTenSanPham()
    {
        return $this->tenSanPham;
    }
    public function setTenSanPham($tenSanPham)
    {
        $this->tenSanPham=$tenSanPham;
    }
    public function getMaLoai()
    {
        return $this->maLoai;
    }
    public function setMaLoai($maLoai)
    {
        $this->maLoai=$maLoai;
    }

    public function getMoTa()
    {
        return $this->moTa;
    }
    public function setMoTa($moTa)
    {
        $this->moTa=$moTa;
    }
    public function getLuotMua()
    {
        return $this->luotMua;
    }
    public function setLuotMua($luotMua)
    {
        $this->luotMua=$luotMua;
    }
    public function getHinhAnh()
    {
        return $this->hinhAnh;
    }
    public function setHinhAnh($hinhAnh)
    {
        $this->hinhAnh=$hinhAnh;
    }
    public function getGiaBan()
    {
        return $this->giaBan;
    }
    public function setGiaBan($giaBan)
    {
        $this->giaBan=$giaBan;
    }
    public function getTrangThai()
    {
        return $this->trangThai;
    }
    public function setTrangThai($trangThai)
    {
        $this->trangThai=$trangThai;
    }

    public function __construct($maSanPham="",$tenSanPham="",$maLoai="",$moTa="",$luotMua=0, $hinhAnh="",$giaBan=0,$trangThai=1)
    {
        $this->maSanPham=$maSanPham;
        $this->tenSanPham=$tenSanPham;
        $this->maLoai=$maLoai;
        $this->moTa=$moTa;
        $this->luotMua=$luotMua;
        $this->hinhAnh=$hinhAnh;
        $this->giaBan=$giaBan;
        $this->trangThai=$trangThai;
    }
    public function ThemMotSanPham()
    {
        $sql="INSERT INTO sanpham(TenSanPham, MaLoai, MoTa, HinhAnh, GiaBan, TrangThai) VALUES ".
        " ('".$this->tenSanPham."','".$this->maLoai."','".$this->moTa."','".$this->hinhAnh."','".$this->giaBan."',0);";
        $connection=new Connection();
        $this->maSanPham= $connection->excuteInsert($sql);
        return $this->maSanPham;
    }
    public function SuaMotSanPham()
    {
        $sql="UPDATE sanpham SET TenSanPham='".$this->tenSanPham."',MaLoai='".$this->maLoai."',MoTa='".$this->moTa."',HinhAnh='".$this->hinhAnh.
        "',GiaBan='".$this->giaBan."',TrangThai=".$this->trangThai." WHERE MaSanPham=".$this->maSanPham.";";

        $connection=new Connection();
        $kq= $connection->excuteUpdate($sql);
        return $kq;
    }
    public function XoaMotSanPham()
    {
        $sql="DELETE FROM sanpham WHERE MaSanPham=".$this->maSanPham.";";

        $connection=new Connection();
        $kq= $connection->excuteUpdate($sql);
        return $kq;
    }
    public function ChuyenMaLoaiVeDefault()
    {
        $sql="UPDATE sanpham SET MaLoai=5 WHERE MaSanPham=".$this->maSanPham.";";
        $connection=new Connection();
        $kq= $connection->excuteUpdate($sql);
        return $kq;
    }
    public static function getAll($values)
    {
        $data_output=array();
        foreach($values as $value)
        {
            $sp=new SanPham();
            $sp->setMaSanPham($value["MaSanPham"]);
            $sp->setTenSanPham($value["TenSanPham"]);
            $sp->setMaLoai($value["MaLoai"]);
            $sp->setMoTa($value["MoTa"]);
            $sp->setLuotMua($value["LuotMua"]);
            $sp->setHinhAnh($value["HinhAnh"]);
            $sp->setGiaBan($value["GiaBan"]);
            $sp->setTrangThai($value["TrangThai"]);
            $data_output[]=$sp;
        }
        return $data_output;

    }
    public static function getOne($value)
    {
        $sp=new SanPham();
        $sp->setMaSanPham($value[0]["MaSanPham"]);
        $sp->setTenSanPham($value[0]["TenSanPham"]);
        $sp->setMaLoai($value[0]["MaLoai"]);
        $sp->setMoTa($value[0]["MoTa"]);
        $sp->setLuotMua($value[0]["LuotMua"]);
        $sp->setHinhAnh($value[0]["HinhAnh"]);
        $sp->setGiaBan($value[0]["GiaBan"]);
        $sp->setTrangThai($value[0]["TrangThai"]);
        return $sp;

    }
    public static function LayTamSanPhamMuaNhieu()
    {
        $sql="select*from sanpham ORDER BY LuotMua LIMIT 8;";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        $listProduct=array();
        if($resultData!=null)
        {
            foreach($resultData as $value)
            {
                $sp=new SanPham();
                $sp->setMaSanPham($value["MaSanPham"]);
                $sp->setTenSanPham($value["TenSanPham"]);
                $sp->setMaLoai($value["MaLoai"]);
                $sp->setMoTa($value["MoTa"]);
                $sp->setLuotMua($value["LuotMua"]);
                $sp->setHinhAnh($value["HinhAnh"]);
                $sp->setGiaBan($value["GiaBan"]);
                $sp->setTrangThai($value["TrangThai"]);
                $listProduct[]=$sp;
            }
            return $listProduct;
        }
        return null;
        
    }

    public static function LayDanhSachSanPhamMuaNhieu()
    {
        $sql="select*from sanpham ORDER BY LuotMua LIMIT 4;";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        $listProduct=array();
        if($resultData!=null)
        {
            foreach($resultData as $value)
            {
                $sp=new SanPham();
                $sp->setMaSanPham($value["MaSanPham"]);
                $sp->setTenSanPham($value["TenSanPham"]);
                $sp->setMaLoai($value["MaLoai"]);
                $sp->setMoTa($value["MoTa"]);
                $sp->setLuotMua($value["LuotMua"]);
                $sp->setHinhAnh($value["HinhAnh"]);
                $sp->setGiaBan($value["GiaBan"]);
                $sp->setTrangThai($value["TrangThai"]);
                $listProduct[]=$sp;
            }
            return $listProduct;
        }
        return null;
        
    }
     public static function getAllProductSameCategory($maLoai)
    {
        $sql="select*from sanpham where MaLoai='$maLoai';";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        $listProduct=array();
        if($resultData!=null)
        {
            foreach($resultData as $value)
            {
                $sp=new SanPham();
                $sp->setMaSanPham($value["MaSanPham"]);
                $sp->setTenSanPham($value["TenSanPham"]);
                $sp->setMaLoai($value["MaLoai"]);
                $sp->setMoTa($value["MoTa"]);
                $sp->setLuotMua($value["LuotMua"]);
                $sp->setHinhAnh($value["HinhAnh"]);
                $sp->setGiaBan($value["GiaBan"]);
                $sp->setTrangThai($value["TrangThai"]);
                $listProduct[]=$sp;
            }
            return $listProduct;
        }
        return null;
        
    }
    public static function getLimit($start,$quatity)
    {
        $sql="SELECT * FROM sanpham LIMIT $start, $quatity;";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        $listProduct=array();
        if($resultData!=null)
        {
            foreach($resultData as $value)
            {
                $sp=new SanPham();
                $sp->setMaSanPham($value["MaSanPham"]);
                $sp->setTenSanPham($value["TenSanPham"]);
                $sp->setMaLoai($value["MaLoai"]);
                $sp->setMoTa($value["MoTa"]);
                $sp->setLuotMua($value["LuotMua"]);
                $sp->setHinhAnh($value["HinhAnh"]);
                $sp->setGiaBan($value["GiaBan"]);
                $sp->setTrangThai($value["TrangThai"]);
                $listProduct[]=$sp;
            }
            return $listProduct;
        }
        return null;
        
    }
    public static function getProductSameCategory($maLoai)
    {
        $sql="select*from sanpham where MaLoai='$maLoai' LIMIT 4";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        $listProduct=array();
        if($resultData!=null)
        {
            foreach($resultData as $value)
            {
                $sp=new SanPham();
                $sp->setMaSanPham($value["MaSanPham"]);
                $sp->setTenSanPham($value["TenSanPham"]);
                $sp->setMaLoai($value["MaLoai"]);
                $sp->setMoTa($value["MoTa"]);
                $sp->setLuotMua($value["LuotMua"]);
                $sp->setHinhAnh($value["HinhAnh"]);
                $sp->setGiaBan($value["GiaBan"]);
                $sp->setTrangThai($value["TrangThai"]);
                $listProduct[]=$sp;
            }
            return $listProduct;
        }
        return null;
        
    }

    public static function TimKiem($value)
    {
        $sql="SELECT * FROM sanpham WHERE TenSanPham LIKE '%".$value."%'";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        $listProduct=array();
        if($resultData!=null)
        {
            foreach($resultData as $value)
            {
                $sp=new SanPham();
                $sp->setMaSanPham($value["MaSanPham"]);
                $sp->setTenSanPham($value["TenSanPham"]);
                $sp->setMaLoai($value["MaLoai"]);
                $sp->setMoTa($value["MoTa"]);
                $sp->setLuotMua($value["LuotMua"]);
                $sp->setHinhAnh($value["HinhAnh"]);
                $sp->setGiaBan($value["GiaBan"]);
                $sp->setTrangThai($value["TrangThai"]);
                $listProduct[]=$sp;
            }
            return $listProduct;
        }
        return null;
    }

     public static function getListProductByUserId($MaNguoiDung)
    {
        $sql="SELECT sanpham.MaSanPham, sanpham.TenSanPham, sanpham.MaLoai, sanpham.MoTa, sanpham.LuotMua,sanpham.HinhAnh,".
        " sanpham.GiaBan, sanpham.TrangThai FROM sanpham, chitietdathang, dathang where sanpham.MaSanPham=chitietdathang.MaSanPham ".
        " AND dathang.MaDonHang=chitietdathang.MaDonHang AND dathang.MaNguoiDung=".$MaNguoiDung.";";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        $listProduct=array();
        if($resultData!=null)
        {
            foreach($resultData as $value)
            {
                $sp=new SanPham();
                $sp->setMaSanPham($value["MaSanPham"]);
                $sp->setTenSanPham($value["TenSanPham"]);
                $sp->setMaLoai($value["MaLoai"]);
                $sp->setMoTa($value["MoTa"]);
                $sp->setLuotMua($value["LuotMua"]);
                $sp->setHinhAnh($value["HinhAnh"]);
                $sp->setGiaBan($value["GiaBan"]);
                $sp->setTrangThai($value["TrangThai"]);
                $listProduct[]=$sp;
            }
            return $listProduct;
        }
        return null;
        
    }
    public static function LayMotSanPham($MaSanPham)
    {
        $sql="SELECT * FROM sanpham WHERE MaSanPham =".$MaSanPham.";";
        $connection=new Connection();
        $value=$connection->excuteQuery($sql);
        if($value!=null)
        {
            $sp=new SanPham();
            $sp->setMaSanPham($value[0]["MaSanPham"]);
            $sp->setTenSanPham($value[0]["TenSanPham"]);
            $sp->setMaLoai($value[0]["MaLoai"]);
            $sp->setMoTa($value[0]["MoTa"]);
            $sp->setLuotMua($value[0]["LuotMua"]);
            $sp->setHinhAnh($value[0]["HinhAnh"]);
            $sp->setGiaBan($value[0]["GiaBan"]);
            $sp->setTrangThai($value[0]["TrangThai"]);
            return $sp;
        }
        return null;
    }


    public static function LayTatCa()
    {
        $sql="SELECT * FROM sanpham ORDER BY MaSanPham DESC;";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        $listProduct=array();
        if($resultData!=null)
        {
            foreach($resultData as $value)
            {
                $sp=new SanPham();
                $sp->setMaSanPham($value["MaSanPham"]);
                $sp->setTenSanPham($value["TenSanPham"]);
                $sp->setMaLoai($value["MaLoai"]);
                $sp->setMoTa($value["MoTa"]);
                $sp->setLuotMua($value["LuotMua"]);
                $sp->setHinhAnh($value["HinhAnh"]);
                $sp->setGiaBan($value["GiaBan"]);
                $sp->setTrangThai($value["TrangThai"]);
                $listProduct[]=$sp;
            }
            return $listProduct;
        }
        return null;
        
    }

}
?>