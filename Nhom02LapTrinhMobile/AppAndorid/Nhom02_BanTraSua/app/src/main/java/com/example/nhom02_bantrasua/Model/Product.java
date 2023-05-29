package com.example.nhom02_bantrasua.Model;

import java.io.Serializable;
import java.util.ArrayList;

public class Product implements Serializable {
    private String maSanPham;
    private  String maLoai;
    private  String tenSanPham;
    private  String moTa;
    private int luotMua;
    private  String hinhAnh;
    private  double giaBan;
    private  int trangThai;

    public int getTrangThai() {
        return trangThai;
    }

    public void setTrangThai(int trangThai) {
        this.trangThai = trangThai;
    }

    public String getMaSanPham() {
        return maSanPham;
    }

    public void setMaSanPham(String maSanPham) {
        this.maSanPham = maSanPham;
    }

    public String getMaLoai() {
        return maLoai;
    }

    public void setMaLoai(String maLoai) {
        this.maLoai = maLoai;
    }

    public String getTenSanPham() {
        return tenSanPham;
    }

    public void setTenSanPham(String tenSanPham) {
        this.tenSanPham = tenSanPham;
    }

    public String getMoTa() {
        return moTa;
    }

    public void setMoTa(String moTa) {
        this.moTa = moTa;
    }

    public int getLuotMua() {
        return luotMua;
    }

    public void setLuotMua(int luotMua) {
        this.luotMua = luotMua;
    }

    public String getHinhAnh() {
        return hinhAnh;
    }

    public void setHinhAnh(String hinhAnh) {
        this.hinhAnh = hinhAnh;
    }

    public double getGiaBan() {
        return giaBan;
    }

    public void setGiaBan(double giaBan) {
        this.giaBan = giaBan;
    }

    public Product()
    {
        this.maSanPham="";
        this.maLoai="";
        this.tenSanPham="";
        this.moTa="";
        this.luotMua=0;
        this.hinhAnh="https://vo-nguyen-duy-tan.000webhostapp.com/WebsiteBanHang_VoNguyenDuyTan_2001200082/Images/imagesProducts/ALISAN_TraiCay.png";
        this.giaBan=0;
        this.trangThai=1;
    }

    public Product(String maSanPham, String maLoai, String tenSanPham, String moTa, int luotMua, String hinhAnh, double giaBan,int trangThai)
    {
        this.maSanPham = maSanPham;
        this.maLoai = maLoai;
        this.tenSanPham = tenSanPham;
        this.moTa = moTa;
        this.luotMua = luotMua;
        this.hinhAnh = hinhAnh;
        this.giaBan = giaBan;
        this.trangThai=trangThai;
    }

    public static ArrayList<Product> listProducts()
    {
        ArrayList<Product> listSp=new ArrayList<Product>();
        for(int i=0;i<15;i++)
        {
            Product sp=new Product("sp01","ts01","Tra Sua Tran Chau","Dam vi tra, thom huong sua,bung vi ngon",
                    10,
                    "https://vo-nguyen-duy-tan.000webhostapp.com/WebsiteBanHang_VoNguyenDuyTan_2001200082/Images/imagesProducts/ALISAN_TraiCay.png"
                    ,25000,1);
            listSp.add(sp);
        }
        return listSp;
    }



}
