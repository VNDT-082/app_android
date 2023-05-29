package com.example.nhom02_bantrasua.Model;

public class Topping {
    public String MaTopping;
    public String TenTopping;
    public double Gia;
    public String HinhAnh;

    public String getMaTopping() {
        return MaTopping;
    }

    public void setMaTopping(String maTopping) {
        MaTopping = maTopping;
    }

    public String getTenTopping() {
        return TenTopping;
    }

    public void setTenTopping(String tenTopping) {
        TenTopping = tenTopping;
    }

    public double getGia() {
        return Gia;
    }

    public void setGia(double gia) {
        Gia = gia;
    }

    public String getHinhAnh() {
        return HinhAnh;
    }

    public void setHinhAnh(String hinhAnh) {
        HinhAnh = hinhAnh;
    }
    public Topping() {
        MaTopping = "";
        TenTopping = "";
        Gia = 0;
        HinhAnh = "ThachCaPhe.png";
    }
    public Topping(String maTopping, String tenTopping, double gia, String hinhAnh) {
        MaTopping = maTopping;
        TenTopping = tenTopping;
        Gia = gia;
        HinhAnh = hinhAnh;
    }

}
