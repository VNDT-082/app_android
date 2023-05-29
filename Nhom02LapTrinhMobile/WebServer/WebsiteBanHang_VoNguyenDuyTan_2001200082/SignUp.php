<?php
    $sdtErr="";
    $passErr="";
    $sdt;
    $pass;
    if(isset($_POST["submit"]))
    { 
        
        if(empty($_POST['sdt']))
        {
            $sdtErr="Bạn chưa nhập số điện thoại.";
        }
        else
        {
            $sdt=$_POST['sdt'];
            if(preg_match("/^[0-9-+]+$/",$sdt))
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
                <div class="formSignUp">
                    <h6 class="h6_">Đăng ký</h6>
                    <form method="POST" enctype="multipart/form-data" action="XULY_FORMDangKy.php">
                        <div class="row mb-3">
                            <label for="sdt" class="col-sm-3 col-form-label text_form">Số điện thoại:</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="sdt" name="sdt">
                            <span class="text-danger"><?= $sdtErr ?></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="pass" class="col-sm-3 col-form-label text_form">Mật khẩu:</label>
                            <div class="col-sm-9">
                            <input type="password" class="form-control" id="pass" name="pass">
                            <span class="text-danger"><?= $passErr ?></span>
                            </div>
                            <br/>
                        </div>
                        <div class="row mb-3">
                            <label for="TenNguoiDung" class="col-sm-3 col-form-label text_form">Họ và tên:</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control"name="TenNguoiDung">
                            <span class="text-danger"><?= $sdtErr ?></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="NgaySinh" class="col-sm-3 col-form-label text_form">Ngày sinh:</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" name="NgaySinh">
                            <span class="text-danger"><?= $passErr ?></span>
                            </div>
                            <br/>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-3 col-form-label text_form">Email:</label>
                            <div class="col-sm-9">
                            <input type="email" class="form-control" name="Email">
                            <span class="text-danger"><?= $passErr ?></span>
                            </div>
                            <br/>
                        </div>
                        <div class="row mb-3">
                            <label for="GioiTinh" class="col-sm-3 col-form-label text_form">Giới tính:</label>
                            <div class="col-sm-9">
                                <select name="GioiTinh" class="form-control">
                                    <option value="0"></option>
                                    <option value="0">Nữ</option>
                                    <option value="1">Nam</option>
                                </select>
                            <span class="text-danger"><?= $sdtErr ?></span>
                            </div>
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
                            <button type="submit" name="DangKy" class="btn btn-primary form-control">Đăng ký</button>
                        </div>
                    </form><br/>
                    <div><a href="Login.php" style="text-decoration:none;"><h5 class="text-primary" >Đăng nhập</h5></a></div>
                </div>
            </div>
                
            </div>
        </div>
    </div>
</body>
</html>