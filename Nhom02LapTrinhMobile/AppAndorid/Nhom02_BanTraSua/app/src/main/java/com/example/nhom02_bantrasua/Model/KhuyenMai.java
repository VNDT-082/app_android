package com.example.nhom02_bantrasua.Model;

public class KhuyenMai {
    private String id;
    private String MaSanPham;
    private String NoiDung;
    private String ChiTiet;
    private String NgayBatDau;
    private String NgayKetThuc;
    private String HinhAnh;

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getMaSanPham() {
        return MaSanPham;
    }

    public void setMaSanPham(String maSanPham) {
        MaSanPham = maSanPham;
    }

    public String getNoiDung() {
        return NoiDung;
    }

    public void setNoiDung(String noiDung) {
        NoiDung = noiDung;
    }

    public String getChiTiet() {
        return ChiTiet;
    }

    public void setChiTiet(String chiTiet) {
        ChiTiet = chiTiet;
    }

    public String getNgayBatDau() {
        return NgayBatDau;
    }

    public void setNgayBatDau(String ngayBatDau) {
        NgayBatDau = ngayBatDau;
    }

    public String getNgayKetThuc() {
        return NgayKetThuc;
    }

    public void setNgayKetThuc(String ngayKetThuc) {
        NgayKetThuc = ngayKetThuc;
    }

    public String getHinhAnh() {
        return HinhAnh;
    }

    public void setHinhAnh(String hinhAnh) {
        HinhAnh = hinhAnh;
    }

    public KhuyenMai() {
        this.id = "";
        MaSanPham = "";
        NoiDung = "";
        ChiTiet = "";
        NgayBatDau = "";
        NgayKetThuc = "";
        HinhAnh = "";
    }
    public KhuyenMai(String id, String maSanPham, String noiDung, String chiTiet, String ngayBatDau, String ngayKetThuc, String hinhAnh) {
        this.id = id;
        MaSanPham = maSanPham;
        NoiDung = noiDung;
        ChiTiet = chiTiet;
        NgayBatDau = ngayBatDau;
        NgayKetThuc = ngayKetThuc;
        HinhAnh = hinhAnh;
    }
}
