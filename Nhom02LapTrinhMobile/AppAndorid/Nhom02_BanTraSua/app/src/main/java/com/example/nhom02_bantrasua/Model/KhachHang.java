package com.example.nhom02_bantrasua.Model;

import java.io.Serializable;

public class KhachHang implements Serializable {
    private String MaNguoiDung;
    private String MaLoaiKhach;
    private String TenLoaiKhach;
    private  String TenNguoiDung;
    private String SDTDangNhap;
    private String SDTLienHe;
    private String AnhDaiDien;
    private String GioiTinh;
    private String NgaySinh;
    private String Email;
    private String MatKhau;

    public int getUuDai() {
        return UuDai;
    }

    public void setUuDai(int uuDai) {
        UuDai = uuDai;
    }

    private int UuDai;

    public String getMaNguoiDung() {
        return MaNguoiDung;
    }

    public void setMaNguoiDung(String maNguoiDung) {
        MaNguoiDung = maNguoiDung;
    }

    public String getMaLoaiKhach() {
        return MaLoaiKhach;
    }

    public void setMaLoaiKhach(String maLoaiKhach) {
        MaLoaiKhach = maLoaiKhach;
    }

    public String getTenLoaiKhach() {
        return TenLoaiKhach;
    }

    public void setTenLoaiKhach(String tenLoaiKhach) {
        TenLoaiKhach = tenLoaiKhach;
    }

    public String getTenNguoiDung() {
        return TenNguoiDung;
    }

    public void setTenNguoiDung(String tenNguoiDung) {
        TenNguoiDung = tenNguoiDung;
    }

    public String getSDTDangNhap() {
        return SDTDangNhap;
    }

    public void setSDTDangNhap(String SDTDangNhap) {
        this.SDTDangNhap = SDTDangNhap;
    }

    public String getSDTLienHe() {
        return SDTLienHe;
    }

    public void setSDTLienHe(String SDTLienHe) {
        this.SDTLienHe = SDTLienHe;
    }

    public String getAnhDaiDien() {
        return AnhDaiDien;
    }

    public void setAnhDaiDien(String anhDaiDien) {
        AnhDaiDien = anhDaiDien;
    }

    public String getGioiTinh() {
        return GioiTinh;
    }

    public void setGioiTinh(String gioiTinh) {
        GioiTinh = gioiTinh;
    }

    public String getNgaySinh() {
        return NgaySinh;
    }

    public void setNgaySinh(String ngaySinh) {
        NgaySinh = ngaySinh;
    }

    public String getEmail() {
        return Email;
    }

    public void setEmail(String email) {
        Email = email;
    }

    public String getMatKhau() {
        return MatKhau;
    }

    public void setMatKhau(String matKhau) {
        MatKhau = matKhau;
    }

    public KhachHang(String maNguoiDung, String maLoaiKhach, String tenLoaiKhach, String tenNguoiDung,
                     String SDTDangNhap, String SDTLienHe, String anhDaiDien, String gioiTinh, String ngaySinh,
                     String email, String matKhau, int uuDai) {
        this.MaNguoiDung = maNguoiDung;
        this.MaLoaiKhach = maLoaiKhach;
        this.TenLoaiKhach = tenLoaiKhach;
        this.TenNguoiDung = tenNguoiDung;
        this.SDTDangNhap = SDTDangNhap;
        this.SDTLienHe = SDTLienHe;
        this.AnhDaiDien = anhDaiDien;
        this.GioiTinh = gioiTinh;
        this.NgaySinh = ngaySinh;
        this.Email = email;
        this.MatKhau = matKhau;
        this.UuDai=uuDai;
    }
    public KhachHang() {
        this.MaNguoiDung = "";
        this.MaLoaiKhach = "";
        this.TenLoaiKhach = "";
        this.TenNguoiDung = "";
        this.SDTDangNhap = "";
        this.SDTLienHe = "";
        this.AnhDaiDien = "";
        this.GioiTinh = "";
        this.NgaySinh = "";
        this.Email = "";
        this.MatKhau = "";
        this.UuDai=0;
    }
    public KhachHang(KhachHang khachHang)
    {
        this.MaNguoiDung=khachHang.MaNguoiDung;
        this.MaLoaiKhach=khachHang.MaLoaiKhach;
        this.TenLoaiKhach=khachHang.TenLoaiKhach;
        this.TenNguoiDung=khachHang.TenNguoiDung;
        this.SDTDangNhap=khachHang.SDTDangNhap;
        this.SDTLienHe=khachHang.SDTLienHe;
        this.AnhDaiDien=khachHang.AnhDaiDien;
        this.GioiTinh=khachHang.GioiTinh;
        this.NgaySinh=khachHang.NgaySinh;
        this.Email=khachHang.Email;
        this.MatKhau=khachHang.MatKhau;
        this.UuDai=khachHang.UuDai;

    }
}
