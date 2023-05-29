<?php
    require("HomeController.php");
    session_start();
    $sdtErr="";
    $passErr="";
    $KetQuaDangNhap="";
    $sdt;
    $pass;

    if(isset($_POST["submit"]))
    { 
        // $string = password_hash('123', PASSWORD_DEFAULT);
        // echo $string;
        // if (password_verify('123', $string)) {
        //     echo 'Mật khẩu hợp lệ!';
        // } else {
        //     echo 'Mật khẩu không hợp lệ.';
        // }
        if(empty($_POST['sdt']))
        {
            $sdtErr="Bạn chưa nhập số điện thoại.";
        }
        else
        {
            $sdt=$_POST['sdt'];
            if(!preg_match('/^[0-9]{10}$/',$sdt))
            {
                $sdtErr="Chỉ nhập vào số.";
            }
        }

        if(empty($_POST['pass']))
        {
            $passErr="Bạn chưa nhập mật khẩu.";
        }
        else
        {
            $pass=$_POST['pass'];
        }
        
        if($sdtErr=="" && $passErr=="")
        {
            $TaiKhoan=TaiKhoan::getOneBySDTDangNhap($sdt);
            if($TaiKhoan!=null)
            {
                //$MaHoaMatKhau = password_hash($pass, PASSWORD_DEFAULT);
                if($TaiKhoan->LoaiTaiKhoan==0)
                {
                    if (password_verify($pass, $TaiKhoan->MatKhau)) {
                        $NguoiDung=NguoiDung::getOneBySDT($TaiKhoan->SDTDangNhap);
                        if($NguoiDung!=null)
                        {
                            if(!isset($_SESSION['KhachHang']))
                            {
                                $_SESSION['KhachHang']=$NguoiDung;
                            }
                            header('location: index.php');
                            exit();
                        }
                        
                    } else {
                        $KetQuaDangNhap= 'Mật khẩu không hợp lệ';
                    }
                    
                }
                if($TaiKhoan->LoaiTaiKhoan==1)
                {
                    
                    if (password_verify($pass, $TaiKhoan->MatKhau)) {
                        $NhanVien=NhanVien::LayMotNhanVienBangSDTDangNhap($TaiKhoan->SDTDangNhap); 
                        if($NhanVien!=null)
                        {
                            if(!isset($_SESSION['NhanVien']))
                            {
                                $_SESSION['NhanVien']=$NhanVien;
                            }
                            header('location: TrangChuAdmin.php');
                            exit();
                        }
                        
                    } else {
                        $KetQuaDangNhap= 'Mật khẩu không hợp lệ';
                    }
                   
                }
            }
        }
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
    <link href="Stylesheet/Style1.css" rel="stylesheet">
    <title>Đăng nhập</title>
</head>
<body style="font-family: 'Times New Roman', Times, serif;">
    <div class="container_Login">
        <div class="row_">
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
                                            <ul class="dropdown-menu bg-warning" style="margin-top: 20px;" aria-labelledby="navbarScrollingDropdown"> 
                                                <li><a class="dropdown-item" href="#"><span  class="a_">action</span></a></li> 
                                                <li><a class="dropdown-item" href="#"><span  class="a_">action</span></a></a></li> 
                                                <li><a class="dropdown-item " href="#"><span class="a_">action</span></a></a></li> 
                                            </ul>
                                        </li>
                                        </button> 
                                    </div>
                                </nav>
                            </div>    
                        </li>
                        <li class="li_">
                            <a class="a_" href="index.php">Trang chủ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top: 120px;">
            <div class="row" style="height:680px">
                <div class="col-md-6 justify-content-center algin-items-center">
                <div class="logoAni">
                    <img src="Images/logo.png" style=" width:400px; height:400px; " class="imgAni"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="formLogin">
                    <h6 class="h6_">Đăng nhập</h6>
                    <form method="POST" enctype="multipart/form-data">

                        <div class="row mb-3">
                            <label for="sdt" class="col-sm-3 col-form-label text_form">Số điện thoại:</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="sdt" name="sdt">
                            <span class="text-danger"><?= $sdtErr ?></span>
                            </div>
                        </div>
                        <br/>
                        <div class="row mb-3">
                            <label for="pass" class="col-sm-3 col-form-label text_form">Mật khẩu:</label>
                            <div class="col-sm-9">
                            <input type="password" class="form-control" id="pass" name="pass">
                            <span class="text-danger"><?= $passErr ?></span>
                            </div>
                            <br/>
                        </div>
                        <div>
                            <input type="checkbox" name="show_pass" onclick="myFunction()">
                            <label for="show_pass">Hiện mật khẩu.</label>
                            <script>
                                function myFunction() {
                                    var x = document.getElementById("pass");
                                    if (x.type === "password") {
                                        x.type = "text";
                                    } else {
                                        x.type = "password";
                                    }
                                    }
                            </script>
                        </div>
                        <br/>
                        <div>
                            <button type="submit" name="submit" class="btn btn-primary form-control">Đăng nhập</button>
                        </div>
                    </form>
                    <br/>
                    <div class="row">
                        <div class="col-md-4">
                            <a href="LoginQuenMatKhau.php" style="text-decoration:none;"><h5 class="text-primary" >Quên mật khẩu?</h5></a>
                        </div>
                         <div class="col-md-4">
                <a href="SignUp.php" style="text-decoration:none;"><h5 class="text-primary" >Đăng ký</h5></a>
                        </div>
                </div>
                    <div><h5 class="text-primary" ><b><?= $KetQuaDangNhap?></b></h5></div>
                </div>
            </div>
                
            </div>
        </div>
    </div>
</body>
</html>