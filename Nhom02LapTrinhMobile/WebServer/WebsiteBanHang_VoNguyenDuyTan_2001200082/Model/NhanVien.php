<?php
class NhanVien
{
    public $MaNhanVien;
    public $MaChiNhanh;
    public $TenNhanVien;
    public $SDTDangNhap;
    public $SDTLienHe;
    public $AnhDaiDien;
    public $GioiTinh;
    public $NgaySinh;
    public $NgayVaoLam;
    public function __construct($MaNhanVien="",$MaChiNhanh="",$TenNhanVien="",$SDTDangNhap="",
    $SDTLienHe="",$AnhDaiDien="",$GioiTinh=1,$NgaySinh="",$NgayVaoLam="")
    {
        $this->MaNhanVien=$MaNhanVien;
        $this->MaChiNhanh=$MaChiNhanh;
        $this->TenNhanVien=$TenNhanVien;
        $this->SDTDangNhap=$SDTDangNhap;
        $this->SDTLienHe=$SDTLienHe;
        $this->AnhDaiDien=$AnhDaiDien;
        $this->GioiTinh=$GioiTinh;
        $this->NgaySinh=$NgaySinh;
        $this->NgayVaoLam=$NgayVaoLam;
    }
    public function ThemMotNhanVien()
    {
         $sql="INSERT INTO `nhanvien`(`MaChiNhanh`, `TenNhanVien`, `SDTDangNhap`, `SDTLienHe`, `GioiTinh`, `NgaySinh`,".
         " `NgayVaoLam`) VALUES ('".$this->MaChiNhanh."','".$this->TenNhanVien."','".$this->SDTDangNhap.
         "','".$this->SDTLienHe."',".$this->GioiTinh.",'".$this->NgaySinh."','".$this->NgayVaoLam."')";
        $connection=new Connection();
        $this->MaNhanVien=$connection->excuteInsert($sql);
        return $this->MaNhanVien;
    }
    public static function LayTatCa()
    {
        $sql="SELECT * FROM nhanvien ;";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        $DanhSachNhanVien=array();
        if($resultData!=null)
        {
            foreach($resultData as $data)
            {
                $NhanVien=new NhanVien();
                $NhanVien->MaNhanVien=$data["MaNhanVien"];
                $NhanVien->MaChiNhanh=$data["MaChiNhanh"];
                $NhanVien->TenNhanVien=$data["TenNhanVien"];
                $NhanVien->SDTDangNhap=$data["SDTDangNhap"];
                $NhanVien->SDTLienHe=$data["SDTLienHe"];
                $NhanVien->AnhDaiDien=$data["AnhDaiDien"];
                $NhanVien->GioiTinh=$data["GioiTinh"];
                $NhanVien->NgaySinh=$data["NgaySinh"];
                $NhanVien->NgayVaoLam=$data["NgayVaoLam"];
                $DanhSachNhanVien[]=$NhanVien;
            }
            return $DanhSachNhanVien;
        }
        return null;
    }
    public static function LayMotNhanVienBangSDTDangNhap($SDTDangNhap)
    {
        $sql="SELECT * FROM nhanvien WHERE SDTDangNhap='".$SDTDangNhap."';";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        if($resultData!=null)
        {
            foreach($resultData as $data)
            {
                $NhanVien=new NhanVien();
                $NhanVien->MaNhanVien=$data["MaNhanVien"];
                $NhanVien->MaChiNhanh=$data["MaChiNhanh"];
                $NhanVien->TenNhanVien=$data["TenNhanVien"];
                $NhanVien->SDTDangNhap=$data["SDTDangNhap"];
                $NhanVien->SDTLienHe=$data["SDTLienHe"];
                $NhanVien->AnhDaiDien=$data["AnhDaiDien"];
                $NhanVien->GioiTinh=$data["GioiTinh"];
                $NhanVien->NgaySinh=$data["NgaySinh"];
                $NhanVien->NgayVaoLam=$data["NgayVaoLam"];
                return $NhanVien;
            }
        }
        return null;
    }
}
?>