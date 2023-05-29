package com.example.nhom02_bantrasua.Model;

import java.util.ArrayList;

public class GioHang {
    private String ID;
    private String MaNguoiDung;
    private String MaSanPham;
    private String TenSanPham;
    private String MaSize;
    private String SoLuong;
    private String LuongDuong;
    private String LuongDa;
    private String GiaSize;
    private String GiaSanPham;
    private String HinhAnh;
    private ArrayList<ChiTietToppingGioHang> ChiTietTopping;

    public ArrayList<ChiTietToppingGioHang> getChiTietTopping() {
        return ChiTietTopping;
    }

    public void setChiTietTopping(ArrayList<ChiTietToppingGioHang> chiTietTopping) {
        ChiTietTopping = chiTietTopping;
    }



    public String getHinhAnh() {
        return HinhAnh;
    }

    public void setHinhAnh(String hinhAnh) {
        HinhAnh = hinhAnh;
    }

    public String getGiaSize() {
        return GiaSize;
    }

    public void setGiaSize(String giaSize) {
        GiaSize = giaSize;
    }

    public String getGiaSanPham() {
        return GiaSanPham;
    }

    public void setGiaSanPham(String giaSanPham) {
        GiaSanPham = giaSanPham;
    }

    public String getID() {
        return ID;
    }

    public void setID(String ID) {
        this.ID = ID;
    }

    public String getMaNguoiDung() {
        return MaNguoiDung;
    }

    public void setMaNguoiDung(String maNguoiDung) {
        MaNguoiDung = maNguoiDung;
    }

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

    public String getMaSize() {
        return MaSize;
    }

    public void setMaSize(String maSize) {
        MaSize = maSize;
    }

    public String getSoLuong() {
        return SoLuong;
    }

    public void setSoLuong(String soLuong) {
        SoLuong = soLuong;
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

    public GioHang() {
        this.ID = "";
        this.MaNguoiDung = "";
        this.MaSanPham = "";
        this.TenSanPham = "";
        this.MaSize = "";
        this.SoLuong = "";
        this.LuongDuong = "";
        this.LuongDa = "";
        this.GiaSize="";
        this.GiaSanPham="";
        this.HinhAnh="";
        this.ChiTietTopping=new ArrayList<ChiTietToppingGioHang>();
    }

    public GioHang(String ID, String maNguoiDung, String maSanPham, String tenSanPham, String maSize, String soLuong,
                   String luongDuong, String luongDa, String giaSize, String giaSanPham, String hinhAnh,
                   ArrayList<ChiTietToppingGioHang> ChiTietTopping) {
        this.ID = ID;
        this.MaNguoiDung = maNguoiDung;
        this.MaSanPham = maSanPham;
        this.TenSanPham = tenSanPham;
        this.MaSize = maSize;
        this.SoLuong = soLuong;
        this.LuongDuong = luongDuong;
        this.LuongDa = luongDa;
        this.GiaSize = giaSize;
        this.GiaSanPham = giaSanPham;
        this.HinhAnh=hinhAnh;
        this.ChiTietTopping=ChiTietTopping;
    }


}
