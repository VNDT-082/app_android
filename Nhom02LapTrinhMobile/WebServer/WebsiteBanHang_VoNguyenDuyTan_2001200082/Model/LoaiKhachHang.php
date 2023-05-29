<?php
class LoaiKhachHang
{
    public $MaLoaiKhach;
    public $TenLoaiKhach;
    public $UuDai;
    public function __construct($MaLoaiKhach="", $TenLoaiKhach="",$UuDai=0)
    {
        $this->MaLoaiKhach=$MaLoaiKhach;
        $this->TenLoaiKhach=$TenLoaiKhach;
        $this->UuDai=$UuDai;
    }
    public static function getOneByIdKhachHang($MaNguoiDung)
    {
        $connection=new Connection();
        $sql="SELECT loaikhachhang.MaLoaiKH, loaikhachhang.TenLoaiKhach, loaikhachhang.UuDai FROM loaikhachhang, nguoidung".
        " WHERE loaikhachhang.MaLoaiKH=nguoidung.MaLoaiKH AND nguoidung.MaNguoiDung=".$MaNguoiDung."; ";
        $resultData=$connection->excuteQuery($sql);
        foreach($resultData as $data)
        {
            $loaiKhach=new LoaiKhachHang();
            $loaiKhach->MaLoaiKhach=$data["MaLoaiKH"];
            $loaiKhach->TenLoaiKhach=$data["TenLoaiKhach"];
            $loaiKhach->UuDai=$data["UuDai"];
            return $loaiKhach;
        }
        return null;
    }
}
?>