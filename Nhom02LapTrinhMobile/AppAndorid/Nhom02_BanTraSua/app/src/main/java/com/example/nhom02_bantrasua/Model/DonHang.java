package com.example.nhom02_bantrasua.Model;

import java.util.ArrayList;

public class DonHang {
    private String MaDonHang;
    private String MaNguoiDung;
    private String DiaChiNhan;
    private String TongTien;
    private String UuDai;
    private String GiamGiaCon;
    private String TrangThai;
    private String NgayMua;
    private ArrayList<ChiTietDatHang> dsSanPham;

    public ArrayList<ChiTietDatHang> getDsSanPham() {
        return dsSanPham;
    }

    public void setDsSanPham(ArrayList<ChiTietDatHang> dsSanPham) {
        this.dsSanPham = dsSanPham;
    }



    public String getMaDonHang() {
        return MaDonHang;
    }

    public void setMaDonHang(String maDonHang) {
        MaDonHang = maDonHang;
    }

    public String getMaNguoiDung() {
        return MaNguoiDung;
    }

    public void setMaNguoiDung(String maNguoiDung) {
        MaNguoiDung = maNguoiDung;
    }

    public String getDiaChiNhan() {
        return DiaChiNhan;
    }

    public void setDiaChiNhan(String diaChiNhan) {
        DiaChiNhan = diaChiNhan;
    }

    public String getTongTien() {
        return TongTien;
    }

    public void setTongTien(String tongTien) {
        TongTien = tongTien;
    }

    public String getUuDai() {
        return UuDai;
    }

    public void setUuDai(String uuDai) {
        UuDai = uuDai;
    }

    public String getGiamGiaCon() {
        return GiamGiaCon;
    }

    public void setGiamGiaCon(String giamGiaCon) {
        GiamGiaCon = giamGiaCon;
    }

    public String getTrangThai() {
        return TrangThai;
    }

    public void setTrangThai(String trangThai) {
        TrangThai = trangThai;
    }

    public String getNgayMua() {
        return NgayMua;
    }

    public void setNgayMua(String ngayMua) {
        NgayMua = ngayMua;
    }

    public DonHang(String maDonHang, String maNguoiDung, String diaChiNhan, String tongTien, String uuDai,
                   String giamGiaCon, String trangThai, String ngayMua, ArrayList<ChiTietDatHang> danhSachSanPham) {
        MaDonHang = maDonHang;
        MaNguoiDung = maNguoiDung;
        DiaChiNhan = diaChiNhan;
        TongTien = tongTien;
        UuDai = uuDai;
        GiamGiaCon = giamGiaCon;
        TrangThai = trangThai;
        NgayMua = ngayMua;
        this.dsSanPham=danhSachSanPham;
    }

    public DonHang()
    {   MaDonHang = "";
        MaNguoiDung = "";
        DiaChiNhan = "";
        TongTien = "";
        UuDai = "";
        GiamGiaCon = "";
        TrangThai = "";
        NgayMua = "";
        dsSanPham=new ArrayList<ChiTietDatHang>();
    }
}
