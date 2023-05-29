<?php
require("Model/Connection.php");
require("Model/SanPham.php");
require("Model/LoaiSanPham.php");
require("Model/Topping.php");
require("Model/NguoiDung.php");
require("Model/Size.php");
require("Model/ChiTietToppingGioHang.php");
require("Model/ChiTietDatHang.php");
require("Model/KhuyenMai.php");
require("Model/GioHang.php");
require("Model/NhanXet.php");
require("Model/ChiNhanh.php");
require("Model/LoaiKhachHang.php");
require("Model/DatHang.php");
require("Model/ChiTietToppingDatHang.php");
require("Model/TaiKhoan.php");
require("Model/NhanVien.php");
class HomeController
{
    public $connection;
    public function __construct()
    {
        $this->connection=new Connection();
    }
    public function getListProduct($stringSelect)
    {
        $connection=new Connection();
        $result_data=$connection->SelectAll($stringSelect);
        $result_ArrayList=SanPham::getAll($result_data);
        return $result_ArrayList;
        
    }

    public function getListCategory($stringSelect)
    {
        $connection=new Connection();
        $result_data=$connection->SelectAll($stringSelect);
        $l=new LoaiSanPham();
        $result_ArrayList=$l->getAll($result_data);
        return $result_ArrayList;
    }

    public function getOneProduct($id)
    {
        $connection=new Connection();
        $result_data=$connection->getOneProcduct($id);
        $result_Product=SanPham::getOne($result_data);
        return $result_Product;
    }

    public function getListProductOutStanding($StringSelect)
    {
        $connection=new Connection();
        $result_data=$connection->SelectAll($StringSelect);
        $result_Product=SanPham::getAll($result_data);
        return $result_Product;
    }

    // public function getAllTopping($StringSelect)
    // {
    //     $connection=new Connection();
    //     $result_DATA=$connection->SelectAll($StringSelect);
    //     $result_Topping=Topping::getAll($result_DATA);
    //     return $result_Topping;
    // }
    public function getAllCartByCustomer($MaNguoiDung)
    {
        $connection=new Connection();
        $result_data=$connection->getAllCartByCustomer($MaNguoiDung);
        return $result_data;
    }
    public function addOneCart($cart)
    {
        $connection=new Connection();
        
    }
}


?>