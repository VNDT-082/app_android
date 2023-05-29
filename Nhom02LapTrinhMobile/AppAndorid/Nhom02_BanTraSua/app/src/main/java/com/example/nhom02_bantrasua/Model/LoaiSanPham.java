package com.example.nhom02_bantrasua.Model;

public class LoaiSanPham {
    private String MaLoai;
    private String TenLoai;
    private String hinhAnh;

    public String getMaLoai() {
        return MaLoai;
    }

    public void setMaLoai(String maLoai) {
        MaLoai = maLoai;
    }

    public String getTenLoai() {
        return TenLoai;
    }

    public void setTenLoai(String tenLoai) {
        TenLoai = tenLoai;
    }

    public String getHinhAnh() {
        return hinhAnh;
    }

    public void setHinhAnh(String hinhAnh) {
        this.hinhAnh = hinhAnh;
    }

    public LoaiSanPham() {
        MaLoai = "";
        TenLoai = "";
        hinhAnh = "";
    }
    public LoaiSanPham(String maLoai, String tenLoai, String hinhAnh) {
        MaLoai = maLoai;
        TenLoai = tenLoai;
        this.hinhAnh = hinhAnh;
    }
}
