<?php
class LoaiSanPham
{
    public $maLoai;
    public $tenLoai;
    public $hinhAnh;
    public function getMaLoai()
    {
        return $this->maLoai;
    }
    public function setMaLoai($maLoai)
    {
        $this->maLoai=$maLoai;
    }
    public function getTenLoai()
    {
        return $this->tenLoai;
    }
    public function setTenLoai($tenLoai)
    {
        $this->tenLoai=$tenLoai;
    }
    public function getHinhAnh()
    {
        return $this->hinhAnh;
    }
    public function setHinhAnh($hinhAnh)
    {
        $this->hinhAnh=$hinhAnh;
    }
    public function __construct($maLoai="",$tenLoai="",$hinhAnh="")
    {
        $this->maLoai=$maLoai;
        $this->tenLoai=$tenLoai;
        $this->hinhAnh=$hinhAnh;
    }
    public function getAll($values)
    {
        $data=array();
        foreach($values as $value)
        {
            $l=new LoaiSanPham();
            $l->setMaLoai($value["MaLoai"]);
            $l->setTenLoai($value["TenLoai"]);
            $l->setHinhAnh($value["hinhanh"]);
            $data[]=$l;
        }
        return $data;

    }

    public function ThemLoaiSanPham()
    {
        $connection=new Connection();
        $sql="INSERT INTO loaisanpham(TenLoai, hinhanh) VALUES ('".$this->tenLoai."','".$this->hinhAnh."');";
        $this->maLoai=$connection->excuteInsert($sql);
        return $this->maLoai;
    }
    public function SuaLoaiSanPham()
    {
        $connection=new Connection();
        $sql="UPDATE loaisanpham SET TenLoai='".$this->tenLoai."', hinhanh ='".$this->hinhAnh."' WHERE MaLoai=".$this->maLoai.";";
        $kq=$connection->excuteUpdate($sql);
        return $kq;
    }
    public function SuaLoaiSanPhamKhongUploadAnh()
    {
        $connection=new Connection();
        $sql="UPDATE loaisanpham SET TenLoai='".$this->tenLoai."' WHERE MaLoai=".$this->maLoai.";";
        $kq=$connection->excuteUpdate($sql);
        return $kq;
    }
    public function XoaMotLoaiSanPham()
    {
        $connection=new Connection();
        $sql="DELETE FROM loaisanpham WHERE loaisanpham.MaLoai=".$this->maLoai.";";
        $kq=$connection->excuteUpdate($sql);
        return $kq;
    }
    public static function LayTatCa()
    {
        $connection=new Connection();
        $sql="SELECT * FROM loaisanpham ;";
        $values=$connection->excuteQuery($sql);
        $data=array();
        foreach($values as $value)
        {
            $l=new LoaiSanPham();
            $l->setMaLoai($value["MaLoai"]);
            $l->setTenLoai($value["TenLoai"]);
            $l->setHinhAnh($value["hinhanh"]);
            $data[]=$l;
        }
        return $data;

    }
     public static function LayTatCaTruDefault()
    {
        $connection=new Connection();
        $sql="SELECT * FROM loaisanpham WHERE MaLoai<>5;";
        $values=$connection->excuteQuery($sql);
        $data=array();
        foreach($values as $value)
        {
            $l=new LoaiSanPham();
            $l->setMaLoai($value["MaLoai"]);
            $l->setTenLoai($value["TenLoai"]);
            $l->setHinhAnh($value["hinhanh"]);
            $data[]=$l;
        }
        return $data;

    }
    public static function LayBonLoaiTruDefault()
    {
        $connection=new Connection();
        $sql="SELECT * FROM loaisanpham WHERE MaLoai<>5 LIMIT 0, 4;";
        $values=$connection->excuteQuery($sql);
        $data=array();
        foreach($values as $value)
        {
            $l=new LoaiSanPham();
            $l->setMaLoai($value["MaLoai"]);
            $l->setTenLoai($value["TenLoai"]);
            $l->setHinhAnh($value["hinhanh"]);
            $data[]=$l;
        }
        return $data;

    }
    public static function LayMotLoaiSanPham($MaLoai)
    {
        $connection=new Connection();
        $sql="SELECT * FROM loaisanpham WHERE MaLoai = ".$MaLoai." ;";
        $values=$connection->excuteQuery($sql);
        if($values!=null)
        {
            foreach($values as $value)
            {
                $l=new LoaiSanPham();
                $l->setMaLoai($value["MaLoai"]);
                $l->setTenLoai($value["TenLoai"]);
                $l->setHinhAnh($value["hinhanh"]);
                return $l;
            }
        }
        return null;
    }
}

?>