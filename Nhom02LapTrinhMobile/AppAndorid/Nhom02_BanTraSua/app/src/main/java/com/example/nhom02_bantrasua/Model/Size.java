package com.example.nhom02_bantrasua.Model;

import java.util.ArrayList;

public class Size {
    private String MaSize;
    private String Gia;
    private String HinhAnh;
    private String TenSize;

    public String getMaSize() {
        return MaSize;
    }

    public void setMaSize(String maSize) {
        MaSize = maSize;
    }

    public String getGia() {
        return Gia;
    }

    public void setGia(String gia) {
        Gia = gia;
    }

    public String getHinhAnh() {
        return HinhAnh;
    }

    public void setHinhAnh(String hinhAnh) {
        HinhAnh = hinhAnh;
    }

    public String getTenSize() {
        return TenSize;
    }

    public void setTenSize(String tenSize) {
        TenSize = tenSize;
    }

    public Size() {
        MaSize = "SM";
        Gia = "0";
        HinhAnh = "https://vndt2001200082.000webhostapp.com/Images/imagesProducts/SizeM.png";
        TenSize = "Size M";
    }
    public Size(String maSize, String gia, String hinhAnh, String tenSize) {
        MaSize = maSize;
        Gia = gia;
        HinhAnh = hinhAnh;
        TenSize = tenSize;
    }
    @Override
    public String toString()
    {
        return this.TenSize;
    }
    public static ArrayList<Size> DanhSachSize()
    {
        ArrayList<Size> ds=new ArrayList<Size>();
        Size SM=new Size("SM","0",
                "https://vndt2001200082.000webhostapp.com/Images/imagesProducts/SizeM.png","Size M");
        Size SL=new Size("SL","7000",
                "https://vndt2001200082.000webhostapp.com/Images/imagesProducts/SizeL.png","Size L");
        ds.add(SM);
        ds.add(SL);
        return ds;
    }
}
