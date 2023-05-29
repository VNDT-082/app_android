package com.example.nhom02_bantrasua.Model;

public class ChiTietToppingGioHang {
    private String ID;
    private Topping topping;

    public String getID() {
        return ID;
    }

    public void setID(String ID) {
        this.ID = ID;
    }

    public Topping getTopping() {
        return topping;
    }

    public void setTopping(Topping topping) {
        this.topping = topping;
    }

    public ChiTietToppingGioHang() {
        this.ID = "";
        this.topping = new Topping();
    }
    public ChiTietToppingGioHang(String ID, Topping topping) {
        this.ID = ID;
        this.topping = topping;
    }
}
