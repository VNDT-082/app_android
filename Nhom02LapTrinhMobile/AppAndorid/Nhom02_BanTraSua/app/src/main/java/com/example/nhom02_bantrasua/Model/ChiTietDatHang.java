package com.example.nhom02_bantrasua.Model;

public class ChiTietDatHang {
    private String MaSanPham;
    private String TenSanPham;
    private String MaDonHang;
    private String SoLuong;
    private String GiaBan;
    private String KhuyenMai;
    private String GiamCon;
    private String MaSize;
    private String LuongDuong;
    private String LuongDa;

    public String getMaSanPham() {
        return MaSanPham;
    }

    public void setMaSanPham(String maSanPham) {
        MaSanPham = maSanPham;
    }

    public String getTenSanPham() {
        return TenSanPham;
    }

    public void setTenSanPham(String tenSanPham) {
        TenSanPham = tenSanPham;
    }

    public String getMaDonHang() {
        return MaDonHang;
    }

    public void setMaDonHang(String maDonHang) {
        MaDonHang = maDonHang;
    }

    public String getSoLuong() {
        return SoLuong;
    }

    public void setSoLuong(String soLuong) {
        SoLuong = soLuong;
    }

    public String getGiaBan() {
        return GiaBan;
    }

    public void setGiaBan(String giaBan) {
        GiaBan = giaBan;
    }

    public String getKhuyenMai() {
        return KhuyenMai;
    }

    public void setKhuyenMai(String khuyenMai) {
        KhuyenMai = khuyenMai;
    }

    public String getGiamCon() {
        return GiamCon;
    }

    public void setGiamCon(String giamCon) {
        GiamCon = giamCon;
    }

    public String getMaSize() {
        return MaSize;
    }

    public void setMaSize(String maSize) {
        MaSize = maSize;
    }

    public String getLuongDuong() {
        return LuongDuong;
    }

    public void setLuongDuong(String luongDuong) {
        LuongDuong = luongDuong;
    }

    public String getLuongDa() {
        return LuongDa;
    }

    public void setLuongDa(String luongDa) {
        LuongDa = luongDa;
    }

    public ChiTietDatHang(String maSanPham, String tenSanPham, String maDonHang, String soLuong, String giaBan,
                          String khuyenMai, String giamCon, String maSize, String luongDuong, String luongDa) {
        MaSanPham = maSanPham;
        TenSanPham = tenSanPham;
        MaDonHang = maDonHang;
        SoLuong = soLuong;
        GiaBan = giaBan;
        KhuyenMai = khuyenMai;
        GiamCon = giamCon;
        MaSize = maSize;
        LuongDuong = luongDuong;
        LuongDa = luongDa;
    }

    public ChiTietDatHang() {
        MaSanPham = "";
        TenSanPham = "";
        MaDonHang = "";
        SoLuong = "";
        GiaBan = "";
        KhuyenMai = "";
        GiamCon = "";
        MaSize = "";
        LuongDuong = "";
        LuongDa = "";
    }
}
