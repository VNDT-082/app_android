<?php
class TaiKhoan
{
    public $SDTDangNhap;
    public $MatKhau;
    public $LoaiTaiKhoan;
    public function __construct($SDTDangNhap="",$MatKhau="",$LoaiTaiKhoan=0)
    {
        $this->SDTDangNhap=$SDTDangNhap;
        $this->MatKhau=$MatKhau;
        $this->LoaiTaiKhoan=$LoaiTaiKhoan;
    }
    public function ThemMotTaiKhoanKhachHang()
    {
        $sql="INSERT INTO `taikhoan`(`SDTDangNhap`, `MatKhau`, `LoaiTaiKhoan`) VALUES ('".$this->SDTDangNhap
        ."','".$this->MatKhau."',0)";
        $connection=new Connection();
        $kq=$connection->excuteUpdate($sql);
        return $kq;
    }
    public function ThemMotTaiKhoanNhanVien()
    {
        $sql="INSERT INTO `taikhoan`(`SDTDangNhap`, `MatKhau`, `LoaiTaiKhoan`) VALUES ('".$this->SDTDangNhap
        ."','".$this->MatKhau."',1)";
        $connection=new Connection();
        $kq=$connection->excuteUpdate($sql);
        return $kq;
    }
     public function DoiMatKhauMotTaiKhoanKhachHang()
    {
        $sql="UPDATE taikhoan SET MatKhau='".$this->MatKhau."'  WHERE SDTDangNhap='".$this->SDTDangNhap."';";
        $connection=new Connection();
        $kq=$connection->excuteUpdate($sql);
        return $kq;
    }
    public static function DangNhap($SDTDangNhap, $MatKhau)
    {
        $connection=new Connection();
        $sql="SELECT * FROM taikhoan WHERE taikhoan.SDTDangNhap=$SDTDangNhap AND taikhoan.MatKhau=".$MatKhau.";";
        $resultData=$connection->excuteQuery($sql);
        if($resultData!=null)
        {
            foreach($resultData as $data)
            {
                $taiKhoan=new TaiKhoan();
                $taiKhoan->SDTDangNhap=$data["SDTDangNhap"];
                $taiKhoan->MatKhau=$data["MatKhau"];
                $taiKhoan->LoaiTaiKhoan=$data["LoaiTaiKhoan"];
                return $taiKhoan;
            }
        }
        return null;
    }
    public static function getOneBySDTDangNhap($SDTDangNhap)
    {
        $connection=new Connection();
        $sql="SELECT * FROM taikhoan WHERE taikhoan.SDTDangNhap=$SDTDangNhap;";
        $resultData=$connection->excuteQuery($sql);
        if($resultData!=null)
        {
            foreach($resultData as $data)
            {
                $taiKhoan=new TaiKhoan();
                $taiKhoan->SDTDangNhap=$data["SDTDangNhap"];
                $taiKhoan->MatKhau=$data["MatKhau"];
                $taiKhoan->LoaiTaiKhoan=$data["LoaiTaiKhoan"];
                return $taiKhoan;
            }
        }
        return null;
    }

    public static function LayTatCa()
    {
        $connection=new Connection();
        $sql="SELECT * FROM taikhoan;";
        $resultdata=$connection->excuteQuery($sql);
        if($resultdata!=null)
        {
            foreach($resultdata as $data)
            {
                $taiKhoan=new TaiKhoan();
                $taiKhoan->SDTDangNhap=$data["SDTDangNhap"];
                $taiKhoan->MatKhau=$data["MatKhau"];
                $taiKhoan->LoaiTaiKhoan=$data["LoaiTaiKhoan"];
                return $taiKhoan;
            }
        }
        return null;
    }

}
?>