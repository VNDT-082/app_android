<?php
    require("HomeController.php");
    session_start();
    $connection=new Connection();
    $pdo=$connection->pdo;
    $SoSanPhamGioHang=0;
    $KHACHHANGDANGNHAP;
    if(isset($_SESSION['KhachHang']))
    {
        $KHACHHANGDANGNHAP=$_SESSION['KhachHang'];
        $GioHang=GioHang::getAll($KHACHHANGDANGNHAP->MaNguoiDung);
        if($GioHang!=null)
        {
            foreach($GioHang as $GioHangItem)
            {
                $SoSanPhamGioHang++;
            }
        }

    }
    else{
        unset($KHACHHANGDANGNHAP);
    }
    


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
    <link rel="stylesheet" href="Stylesheet/Style1.css">
    <title>Trang chủ</title>
</head>
<body style="font-family: 'Times New Roman', Times, serif;">
    <div class="container_">
        <div class="row_" id="row_">
            <div class="col3">
               <a href="index.php">
                <img  src="Images/logo.png"  style="width: 100px; height: 100px; display: inline; float: left;
                        margin-top: 10px; margin-left:50px; border: solid 5px #31fdef; box-shadow: 0 0 15px #adeee9de; background-color:#d8edc8;"/>
                </a>
                <div style="margin-left:20px">
                    <ul class="ul_">
                        <li class="li_">
                            <div class="">
                                <nav class="navbar navbar-light">       
                                    <div class="container-fluid" style="margin-top: auto;">
                                        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" 
                                        aria-label="Toggle navigation" style="margin-top: auto; border:none">
                                        <li class="nav-item dropdown"> 
                                            <a class="nav-link  text-light" href="#" id="navbarScrollingDropdown" 
                                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span >
                                                <img class="iconBar"  src="Images/iconBars.png"/>
                                            </span></a> 
                                            <ul class="dropdown-menu bg-dark" style="margin-top: 20px;" aria-labelledby="navbarScrollingDropdown"> 
                                                <?php $listCategory=LoaiSanPham::LayTatCaTruDefault();
                                                 foreach($listCategory as $value):?>
                                                    <li><a class="dropdown-item" href="DanhSachSanPhamCungLoai.php?id=<?=$value->maLoai?>">
                                                    <span  class="a_"><?= $value->getTenLoai()?></span></a></li> 
                                                <?php endforeach;?>
                                            </ul>
                                        </li>
                                        </button> 
                                    </div>
                                </nav>
                            </div>    
                        </li>
                        <li class="li_">
                            <a class="a1_" href="index.php">Trang chủ</a>
                        </li>
                    </ul>
                </div>

            </div>
            
            <div class="col4">
                <form class="form-group search" method="post" action="XULY_FORMTimKiem.php">
                    <input type="search" class="input_search" placeholder="  Nhập từ khóa tìm kiếm" name="TimKiem_" />
                    <button class="search_button" type="submit" name="search">
                        <img class="icon_search" src="Images/searching.png" />
                    </button>
                </form>
            </div>
            <div class="col3" style="float: left;">
                    <div class="shopping">
                        <a class="shopping_button" href="ViewGioHang.php">
                            <span class="textMenu" style="margin-top: 5px;">[<?=$SoSanPhamGioHang?>]</span>
                            <img class="icon_shopping_" style="height: 41px; width: 41px;" src="Images/shopping-cart.png" />
                        </a>
                    </div>
                    
                    <div class="info">
                        <?php if(isset($_SESSION['KhachHang'])): ?>

                            <div class="">
                                <nav class="navbar navbar-expand-lg navbar-light">       
                                    <div class="container-fluid" style="margin-top: auto;"> 
                                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                        aria-label="Toggle navigation" style="margin-top: auto;">
                                            <span class="navbar-toggler-icon"></span>
                                        </button> 
                                        <div class="collapse navbar-collapse" id="navbarScroll"> 
                                            <ul class="navbar-nav me-auto my-2 my-lg-0" > 
                                                <li class="nav-item dropdown"> 
                                                    <a class="nav-link dropdown-toggle  text-light" href="#" 
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                    <span class="textMin" ><?= $KHACHHANGDANGNHAP->TenNguoiDung?></span></a>
                                                    <ul class="dropdown-menu bg-warning" > 
                                                        <li><a class="dropdown-item" href="TrangCaNhan.php">
                                                            <span class="textMin">Trang cá nhân</span></a>
                                                        </li> 
                                                        <li><a class="dropdown-item" href="DangXuat.php">
                                                            <span class="textMin">Đăng xuất</span></a>
                                                        </li> 
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                            </div>    
                           
                        <?php else:?>
                            <a class="textMin" href="Login.php">Đăng nhập <span><a class="textMin" href="SignUp.php">/Đăng ký</a></span></a>
                        <?php endif;?>
                    </div>
            </div>
        </div>
        <!--tao su kien co dinh header khi scroll-->
        <script>
            /*var row_=document.getElementById("row_");
            function linearScroll()
            {
                 row_.style.position = "fixed";
                 row_.style.height="100px";
                 row_.style.zIndex="100";
            }
           window.addEventListener('scroll',linearScroll);*/

        </script>

        <!-- Quang cao-->
        <div class="container" style="margin-top:125px">