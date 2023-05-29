<?php
class nhanXet
{
    public $id;
    public $MaNguoiDung;
    public $TenNguoiDung;
    public $MaSanPham;
    public $NoiDung;
    public $DanhGia;
    public $NgayDang;
    public function __construct($id="",$MaNguoiDung="",$TenNguoiDung="",$MaSanPham="",$NoiDung="",$DanhGia="",$NgayDang="")
    {
        $this->id=$id;
        $this->MaNguoiDung=$MaNguoiDung;
        $this->TenNguoiDung=$TenNguoiDung;
        $this->MaSanPham=$MaSanPham;
        $this->NoiDung=$NoiDung;
        $this->DanhGia=$DanhGia;
        $this->NgayDang=$NgayDang;
    }
    public static function getAllWithProductID($MaSanPham)
    {
        $sql="SELECT * FROM `nhanxet` WHERE nhanxet.MaSanPham= $MaSanPham ;";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        $dsNhanXet=array();
        if($resultData!=null)
        {
            foreach($resultData as $nhanXet)
            {
                $nx=new nhanXet();
                $nx->id=$nhanXet['id'];
                $nx->MaNguoiDung=$nhanXet['MaNguoiDung'];
                $nx->MaSanPham=$nhanXet['MaSanPham'];
                $nx->NoiDung=$nhanXet['NoiDung'];
                $nx->DanhGia=$nhanXet['DanhGia'];
                $nx->NgayDang=$nhanXet['NgayDang'];
                $dsNhanXet[]=$nx;
            }
            return $dsNhanXet;
        }
        return null;
    }
    public function ThemNhanXet()
    {
        $connection=new Connection();
        
        $sql="INSERT INTO `nhanxet`( `MaNguoiDung`, `MaSanPham`, `NoiDung`, `DanhGia`) VALUES ('"
        .$this->MaNguoiDung."','".$this->MaSanPham."','".$this->NoiDung."','".$this->DanhGia."')";
        $this->id = $connection->excuteInsert($sql);
        return $this->id;
    }
    public static function LayTatCa()
    {
        $sql="SELECT * FROM nhanxet ;";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        $dsNhanXet=array();
        if($resultData!=null)
        {
            foreach($resultData as $nhanXet)
            {
                $nx=new nhanXet();
                $nx->id=$nhanXet['id'];
                $nx->MaNguoiDung=$nhanXet['MaNguoiDung'];
                $nx->MaSanPham=$nhanXet['MaSanPham'];
                $nx->NoiDung=$nhanXet['NoiDung'];
                $nx->DanhGia=$nhanXet['DanhGia'];
                $nx->NgayDang=$nhanXet['NgayDang'];
                $dsNhanXet[]=$nx;
            }
            return $dsNhanXet;
        }
        return null;
    }

}
?>