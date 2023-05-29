<?php
class NguoiDung
{
    public $MaNguoiDung;
    public $MaLoaiKH;
    public $TenNguoiDung;
    public $SDTDangNhap;
    public $SDTLienHe;
    public $AnhDaiDien;
    public $GioiTinh;
    public $NgaySinh;

    public $Email;

    public function __construct($MaNguoiDung="",$MaLoaiKH="",$TenNguoiDung="",
    $SDTDangNhap="",$SDTLienHe="",$AnhDaiDien="",
    $GioiTinh="",$NgaySinh="", $Email="")
    {
        $this->MaNguoiDung=$MaNguoiDung;
        $this->MaLoaiKH=$MaLoaiKH;
        $this->TenNguoiDung=$TenNguoiDung;
        $this->SDTDangNhap=$SDTDangNhap;
        $this->SDTLienHe=$SDTLienHe;
        $this->AnhDaiDien=$AnhDaiDien;
        $this->$GioiTinh=$GioiTinh;
        $this->NgaySinh=$NgaySinh;
        $this->Email=$Email;
    }
    public function ThemMotKhachHang()
    {
        $sql="INSERT INTO `nguoidung`(`TenNguoiDung`, `SDTDangNhap`, `SDTLienHe`, `Email`, `GioiTinh`, `NgaySinh`) VALUES ".
        "('".$this->TenNguoiDung."','".$this->SDTDangNhap."','".$this->SDTDangNhap."','".$this->Email."
        ',".$this->GioiTinh.",'".$this->NgaySinh."')";
        $connection=new Connection();
        $this->MaNguoiDung=$connection->excuteInsert($sql);
        return $this->MaNguoiDung;
    }
    public static function getOneBySDT($SDTDangNhap)
    {
        $connection=new Connection();
        
        $sql="SELECT * FROM nguoidung WHERE SDTDangNhap='$SDTDangNhap';";
        $ResultData=$connection->excuteQuery($sql);
        if($ResultData!=null)
        {
            foreach($ResultData as $nguoidung)
            {
                $custommer=new NguoiDung();
                $custommer->MaNguoiDung=$nguoidung["MaNguoiDung"];
                $custommer->MaLoaiKH=$nguoidung["MaLoaiKH"];
                $custommer->TenNguoiDung=$nguoidung["TenNguoiDung"];
                $custommer->SDTDangNhap=$nguoidung["SDTDangNhap"];
                $custommer->SDTLienHe=$nguoidung["SDTLienHe"];
                $custommer->Email=$nguoidung["Email"];
                $custommer->AnhDaiDien=$nguoidung["AnhDaiDien"];
                $custommer->GioiTinh=$nguoidung["GioiTinh"];
                $custommer->NgaySinh=$nguoidung["NgaySinh"];
                return $custommer;
            }
        }
    }
    public static function getOneByID($pdo,$MaNguoiDung)
    {
        $sql="SELECT * FROM nguoidung WHERE MaNguoiDung='$MaNguoiDung';";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'NguoiDung');
            return $stmt->fetchAll();
        }
    }

     public static function LayMotNguoiDung($MaNguoiDung)
    {
        $connection=new Connection();
        $sql="SELECT * FROM nguoidung WHERE MaNguoiDung='$MaNguoiDung';";
        $ResultDataNguoiDung=$connection->excuteQuery($sql);
        $DanhSachNguoiDung=array();
        if($ResultDataNguoiDung!=null)
        {
            foreach($ResultDataNguoiDung as $nguoidung)
            {
                $custommer=new NguoiDung();
                $custommer->MaNguoiDung=$nguoidung["MaNguoiDung"];
                $custommer->MaLoaiKH=$nguoidung["MaLoaiKH"];
                $custommer->TenNguoiDung=$nguoidung["TenNguoiDung"];
                $custommer->SDTDangNhap=$nguoidung["SDTDangNhap"];
                $custommer->SDTLienHe=$nguoidung["SDTLienHe"];
                $custommer->Email=$nguoidung["Email"];
                $custommer->AnhDaiDien=$nguoidung["AnhDaiDien"];
                $custommer->GioiTinh=$nguoidung["GioiTinh"];
                $custommer->NgaySinh=$nguoidung["NgaySinh"];
                return $custommer;
            }
        }
        return null;
    }
    public static function LayTatCa()
    {
        $connection=new Connection();
        
        $sql="SELECT * FROM nguoidung;";
        $ResultDataNguoiDung=$connection->excuteQuery($sql);
        $DanhSachNguoiDung=array();
        if($ResultDataNguoiDung!=null)
        {
            foreach($ResultDataNguoiDung as $nguoidung)
            {
                $custommer=new NguoiDung();
                $custommer->MaNguoiDung=$nguoidung["MaNguoiDung"];
                $custommer->MaLoaiKH=$nguoidung["MaLoaiKH"];
                $custommer->TenNguoiDung=$nguoidung["TenNguoiDung"];
                $custommer->SDTDangNhap=$nguoidung["SDTDangNhap"];
                $custommer->SDTLienHe=$nguoidung["SDTLienHe"];
                $custommer->Email=$nguoidung["Email"];
                $custommer->AnhDaiDien=$nguoidung["AnhDaiDien"];
                $custommer->GioiTinh=$nguoidung["GioiTinh"];
                $custommer->NgaySinh=$nguoidung["NgaySinh"];
                $DanhSachNguoiDung[]=$custommer;
            }
            return $DanhSachNguoiDung;
        }
        return null;
    }
}
?>