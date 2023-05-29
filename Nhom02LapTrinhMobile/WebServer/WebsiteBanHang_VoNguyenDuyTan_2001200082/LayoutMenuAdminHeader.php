<?php
    require("HomeController.php");
    session_start();
    $NHANVIENDANGNHAP=new NhanVien();
    if(isset($_SESSION["NhanVien"]))
    {
         $NHANVIENDANGNHAP= $_SESSION['NhanVien'];
    }
    else{
        unset($NHANVIENDANGNHAP);
    }
   
    $current_url = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Stylesheet/Style2.css">


    <title>Quản lý cửa hàng</title>
</head>
<body>
        <div class="row topNavigation">
        <div class="col-md-3">
            <img name="logo" src="Images/logo.png" width="35%"/>
            <label for="logo">VNDT</label>
        </div>
        <div class="col-md-6">
            <form class="form-group search" method="post">
                    <input type="search" class="input_search" placeholder="  Nhập từ khóa tìm kiếm" name="TimKiem_" />
                    <button class="search_button" type="submit">
                        <img class="icon_search" src="Images/searching.png" />
                    </button>
                </form>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-1">
            <a href="TrangCaNhaAdmin.php">
            <img src="Images/imagesProducts/PersonDefault.jpg" width="50%" class="img_user"/></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 menuRight" style="padding: 3%;">
            <ul class="list-group list-group-flush">
                <li>
                    <a class="a_Menu" href="TrangChuAdmin.php"><img src="Images/home.png" width="12%" name="home"/> <label for="home">TRANG CHỦ</label></a>
                    <hr/>
                </li>
                <li>
                    <a class="a_Menu" href="QuanLySanPham.php"><img src="Images/bubble-tea.png" width="12%" name="home"/> <label for="home">SẢN PHẨM</label></a>
                    <hr/>
                </li>
                <li>
                    <a class="a_Menu" href="QuanLyKhachHang.php"><img src="Images/customer.png" width="12%" name="home"/> <label for="home">KHÁCH HÀNG</label></a>
                    <hr/>
                </li>
                <li>
                    <a class="a_Menu" href="QuanLyDonHang.php"><img src="Images/bill.png" width="12%" name="home"/> <label for="home">HÓA ĐƠN</label></a>
                    <hr/>
                </li>
                <li>
                    <a class="a_Menu" href="QuanLyChiNhanh.php"><img src="Images/address.png" width="12%" name="home"/> <label for="home">CỬA HÀNG</label></a>
                    <hr/>
                </li>
                <li>
                    <a class="a_Menu" href="QuanLyNhanVien.php"><img src="Images/skills.png" width="12%" name="home"/> <label for="home">NHÂN VIÊN</label></a>
                    <hr/>
                </li>
                <li>
                    <a class="a_Menu" href="#"><img src="Images/conversation.png" width="12%" name="home"/> <label for="home">THÔNG BÁO</label></a>
                    <hr/>
                </li>
            </ul>
        </div>
        
        
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-9 ">
            
            <br/>
            <div class="row" style="margin-left: 0; margin-top: 70px;">



            


                
           