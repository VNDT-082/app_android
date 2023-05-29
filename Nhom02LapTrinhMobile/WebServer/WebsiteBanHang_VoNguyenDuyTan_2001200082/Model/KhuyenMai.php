<?php
class KhuyenMai{
    public $id;
    public $MaSanPham;
    public $NoiDung;
    public $ChiTiet;
    public $NgayBatDau;
    public $NgayKetThuc;
    public $HinhAnh;

    public function __construct($id=0,$MaSanPham="",$NoiDung="",$ChiTiet="",$NgayBatDau="2000/01/01",$NgayKetThuc="2000/02/02",$HinhAnh="qc_h1.png")
    {
        $this->id=$id;
        $this->MaSanPham=$MaSanPham;
        $this->NoiDung=$NoiDung;
        $this->ChiTiet=$ChiTiet;
        $this->NgayBatDau=$NgayBatDau;
        $this->NgayKetThuc=$NgayKetThuc;
        $this->HinhAnh=$HinhAnh;
    }
    public function ThemMotKhuyenMai()
    {
        $sql="INSERT INTO khuyenmai(MaSanPham, NoiDung, ChiTiet, NgayBatDau, NgayKetThuc, HinhAnh) VALUES ('".$this->MaSanPham.
        "','".$this->NoiDung."','".$this->ChiTiet."','".$this->NgayBatDau."','".$this->NgayKetThuc."','".$this->HinhAnh."');";
        $connection=new Connection();
        $this->id=$connection->excuteInsert($sql);
        return $this->id;
    }
    public function SuaMotKhuyenMai()
    {
        $sql="UPDATE khuyenmai SET MaSanPham='".$this->MaSanPham."',NoiDung='".$this->NoiDung."',ChiTiet='".$this->ChiTiet.
        "',NgayBatDau='".$this->NgayBatDau."',NgayKetThuc='".$this->NgayKetThuc."' WHERE IdKhuyenMai=".$this->id.";";
        $connection=new Connection();
        $kq=$connection->excuteUpdate($sql);
        return $kq;
    }
    public function XoaMotKhuyenMai()
    {
        $sql="DELETE FROM khuyenmai WHERE IdKhuyenMai=".$this->id.";";
        $connection=new Connection();
        $kq=$connection->excuteUpdate($sql);
        return $kq;
    }
    public static function getOneByIdProduct($MaSanPham)
    {
        $connection=new Connection();
        $sql="SELECT * FROM `khuyenmai` WHERE MaSanPham='$MaSanPham' AND NgayBatDau< DATE(NOW()) AND NgayKetThuc>DATE(NOW());";
        $resultData=$connection->excuteQuery($sql);
        if($resultData!=null)
        {
            $KhuyenMai=new KhuyenMai();
            $KhuyenMai->id=$resultData[0]['IdKhuyenMai'];
            $KhuyenMai->MaSanPham=$resultData[0]['MaSanPham'];
            $KhuyenMai->NoiDung=$resultData[0]['NoiDung'];
            $KhuyenMai->ChiTiet=$resultData[0]['ChiTiet'];
            $KhuyenMai->NgayBatDau=$resultData[0]['NgayBatDau'];
            $KhuyenMai->NgayKetThuc=$resultData[0]['NgayKetThuc'];
            $KhuyenMai->HinhAnh=$resultData[0]['HinhAnh'];
            return $KhuyenMai;
        }
        return null;
    }
     public static function LayTatCa()
    {
        $connection=new Connection();
        $sql="SELECT * FROM khuyenmai  ORDER BY IdKhuyenMai DESC ";
        $result=$connection->excuteQuery($sql);
        $DanhSachKhuyenMai=array();
        if($result!=null)
        {
            foreach($result as $resultData )
            {
                $KhuyenMai=new KhuyenMai();
                $KhuyenMai->id=$resultData['IdKhuyenMai'];
                $KhuyenMai->MaSanPham=$resultData['MaSanPham'];
                $KhuyenMai->NoiDung=$resultData['NoiDung'];
                $KhuyenMai->ChiTiet=$resultData['ChiTiet'];
                $KhuyenMai->NgayBatDau=$resultData['NgayBatDau'];
                $KhuyenMai->NgayKetThuc=$resultData['NgayKetThuc'];
                $KhuyenMai->HinhAnh=$resultData['HinhAnh'];
                $DanhSachKhuyenMai[]=$KhuyenMai;
            }
            return $DanhSachKhuyenMai;
            
        }
        return null;
    }

     public static function LayBaKhuyenMaiMoiNhat()
    {
        $connection=new Connection();
        $sql="SELECT * FROM khuyenmai  ORDER BY IdKhuyenMai DESC LIMIT 0,3";
        $result=$connection->excuteQuery($sql);
        $DanhSachKhuyenMai=array();
        if($result!=null)
        {
            foreach($result as $resultData )
            {
                $KhuyenMai=new KhuyenMai();
                $KhuyenMai->id=$resultData['IdKhuyenMai'];
                $KhuyenMai->MaSanPham=$resultData['MaSanPham'];
                $KhuyenMai->NoiDung=$resultData['NoiDung'];
                $KhuyenMai->ChiTiet=$resultData['ChiTiet'];
                $KhuyenMai->NgayBatDau=$resultData['NgayBatDau'];
                $KhuyenMai->NgayKetThuc=$resultData['NgayKetThuc'];
                $KhuyenMai->HinhAnh=$resultData['HinhAnh'];
                $DanhSachKhuyenMai[]=$KhuyenMai;
            }
            return $DanhSachKhuyenMai;
            
        }
        return null;
    }
    public static function LayKhuyenMaiMoiNhat()
    {
        $connection=new Connection();
        $sql="SELECT * FROM khuyenmai  WHERE IdKhuyenMai=(SELECT MAX(IdKhuyenMai) FROM khuyenmai)";
        $result=$connection->excuteQuery($sql);
        if($result!=null)
        {
            foreach($result as $resultData )
            {
                $KhuyenMai=new KhuyenMai();
                $KhuyenMai->id=$resultData['IdKhuyenMai'];
                $KhuyenMai->MaSanPham=$resultData['MaSanPham'];
                $KhuyenMai->NoiDung=$resultData['NoiDung'];
                $KhuyenMai->ChiTiet=$resultData['ChiTiet'];
                $KhuyenMai->NgayBatDau=$resultData['NgayBatDau'];
                $KhuyenMai->NgayKetThuc=$resultData['NgayKetThuc'];
                $KhuyenMai->HinhAnh=$resultData['HinhAnh'];
                return $KhuyenMai;
            }
        }
        return null;
    }
    public static function LayMotKhuyenMai($id_KhuyenMai)
    {
        $connection=new Connection();
        $sql="SELECT * FROM khuyenmai  WHERE IdKhuyenMai=".$id_KhuyenMai.";";
        $result=$connection->excuteQuery($sql);
        if($result!=null)
        {
            foreach($result as $resultData )
            {
                $KhuyenMai=new KhuyenMai();
                $KhuyenMai->id=$resultData['IdKhuyenMai'];
                $KhuyenMai->MaSanPham=$resultData['MaSanPham'];
                $KhuyenMai->NoiDung=$resultData['NoiDung'];
                $KhuyenMai->ChiTiet=$resultData['ChiTiet'];
                $KhuyenMai->NgayBatDau=$resultData['NgayBatDau'];
                $KhuyenMai->NgayKetThuc=$resultData['NgayKetThuc'];
                $KhuyenMai->HinhAnh=$resultData['HinhAnh'];
                return $KhuyenMai;
            }
        }
        return null;
    }
}
?>