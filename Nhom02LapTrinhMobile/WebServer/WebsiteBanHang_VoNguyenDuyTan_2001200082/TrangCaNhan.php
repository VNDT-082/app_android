<title>Trang cá nhân</title>
<?php require("header.php");

if(!isset($_SESSION['KhachHang']))
{
    header('location: index.php');
    exit();
}
$KhachHang=$_SESSION['KhachHang'];
$LoaiKhachHang=LoaiKhachHang::getOneByIdKhachHang($KhachHang->MaNguoiDung);
$TaiKhoan=TaiKhoan::getOneBySDTDangNhap($KhachHang->SDTDangNhap);
$DanhSachDatHang=DatHang::LaySanPhamDangChoDuyet($KhachHang->MaNguoiDung);
$DanhSachSanPhamDaMua=DatHang::LaySanPhamDaMua($KhachHang->MaNguoiDung);

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(isset($_POST["DoiMatKhau"]))
    {
        $Account=new TaiKhoan();
        $Account->SDTDangNhap=$KhachHang->SDTDangNhap;
        $Account->MatKhau=$_POST["password"];
        $Account->MatKhau=password_hash($Account->MatKhau, PASSWORD_DEFAULT);
        $kq=$Account->DoiMatKhauMotTaiKhoanKhachHang();
        if($kq<=0)
        {
            echo '<script type="text/javascript">
                            window.onload = function () { alert("Cập nhật mật khẩu không thành công!"); }
                </script>';
        }
        else{
             echo '<script type="text/javascript">
                            window.onload = function () { alert("Cập nhật mật khẩu thành công!Sẽ load trang sau 10s"); }
                </script>';
            //header("Refresh: 10; TrangCaNhan.php");exit();
        }
    }
}


?>
<div class="row d-flex justify-content-center ">
    <div class="col-md-9 bg_table_white" >
        <h3 class="w-100 fw-bold" style="color:#6f6e6e;"> <b>Trang cá nhân ❭❭</b> </h3><hr/>
        <br/>
        <div class="row">
            <div class="col-md-4">
                <img src="Images/imagesProducts/<?=$KhachHang->AnhDaiDien?>" width="90%" />
            </div>
            <div class="col-md-8">
                <b>Thông tin khách hàng:</b>
                <form method="post" enctype="multipart/form-data">
                    <table style="width:99%; margin-left: 5%;">
                    <tr>
                        <td style="padding-left: 3%; width: 30%;">Tên khách hàng</td>
                        <td style="padding-left: 3%; width:40%">
                            <input style="width: 90%;" type="text" name="TenKhachHang" value="<?=$KhachHang->TenNguoiDung?>" disabled="false"/></td>
                        <td style="padding-left: 3%; width:20%"></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 3%;">Số điện thoại đăng nhập</td>
                        <td style="padding-left: 3%;">
                        <input style="width: 90%;"  type="text" name="SDT_DangNhap" value="<?=$KhachHang->SDTDangNhap?>" disabled="false"/></td>
                        <td style="padding-left: 3%;"></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 3%;">Giới tính</td>
                        <td style="padding-left: 3%;">
                        <?php if($KhachHang->GioiTinh==1):?>
                            <input style="width: 90%;"  type="text" name="GioiTinh" value="Nam" disabled="false"/></td>
                        <?php else:?>
                            <input style="width: 90%;"  type="text" name="GioiTinh" value="Nữ" disabled="false"/></td>
                        <?php endif;?>
                        
                        <td style="padding-left: 3%;"></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 3%;">Ngày sinh</td>
                        <td style="padding-left: 3%;">
                        <input style="width: 90%;"  type="date" name="NgaySinh" value="<?=$KhachHang->NgaySinh?>" disabled="false"/></td>
                        <td style="padding-left: 3%;"></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 3%;">Loại khách hàng</td>
                        <td style="padding-left: 3%;">
                        <input style="width: 90%;"  type="text" name="LoaiKhachHang" value="<?=$LoaiKhachHang->TenLoaiKhach?>" disabled="false"/></td>
                        <td style="padding-left: 3%;"></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 3%;">Email</td>
                        <td style="padding-left: 3%;">
                        <input style="width: 90%;"  type="email" name="Email" value="<?=$KhachHang->Email?>" disabled="false"/></td>
                        <td style="padding-left: 3%;"></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 3%;">Số điện thoại liên hệ</td>
                        <td style="padding-left: 3%;">
                        <input style="width: 90%;"  type="text" name="SDT_LienHe" value="<?=$KhachHang->SDTLienHe?>" /></td>
                        <td style="padding-left: 3%;"></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 3%;">Mật khẩu</td>
                        <td style="padding-left: 3%;">
                        <input id="password" style="width: 90%;"  type="password" name="password" value="<?=$TaiKhoan->MatKhau?>"/></td>
                        <td><button id="btnHideShow" type="button" class="btnHideShow" name="none" onclick="myFunction()">
                                <img id="hide_show" src="Images/hide.png" width="250%" class="imgHideShow"/>
                            </button>
                        
                    </td>
                    <td>
                        <button class="btnHideShow"  name="DoiMatKhau" type="submit"><img class="btnUpdate" src="Images/loop.png" width="200%" /></button>
                    </td>

                        <script>
                            function myFunction() {
                                var x = document.getElementById("password");
                                var img=document.getElementById("hide_show");
                                if (x.type === "password") {
                                    x.type = "text";
                                    img.src="Images/show.png"
                                } else {
                                    x.type = "password";
                                img.src="Images/hide.png";
                                }
                                }
                        </script>
                    </tr>
                </table>
                </form>
                
            </div>
        </div>
        <br/>
        <div class="row">
            <h4 class="w-100 fw-bold" style="color:#6f6e6e;"><b>Đơn hàng chờ duyệt ❭❭</b></h4><hr/>
            <table class="table table-striped table-hover">
                <tr>
                    <td>Mã đơn hàng</td>
                    <td>Địa chỉ giao hàng</td>
                    <td>Tổng tiền(VNĐ)</td>
                    <td>Ưu đãi</td>
                    <td>Giá giảm còn(VNĐ)</td>
                    <td>Chi tiết đặt hàng</td>
                </tr>
                <?php if($DanhSachDatHang!=null):
                        foreach($DanhSachDatHang as $DatHangItem):?>
                <tr>
                    <td><?= $DatHangItem->MaDonHang?></td>
                    <td><?= $DatHangItem->MaChiNhanh?></td>
                    <td><?= number_format($DatHangItem->TongTien,0,",",".") ?></td>
                    <td><?= $DatHangItem->UuDai." %"?></td>
                    <td><?=  number_format($DatHangItem->GiaGiamCon,0,",",".") ?></td>
                    <td>
                        <table class="table table-primary">
                            <tr>
                                <td>Tên sản phẩm</td>
                                <td>Chi tiết</td>
                                <td>Topping</td>
                            </tr>
                            <?php $DSChiTietDatHang=ChiTietDatHang::LayDanhSachDonHangMaDonHangVaMaNguoiDung($DatHangItem->MaDonHang);
                         if($DSChiTietDatHang!=null): foreach($DSChiTietDatHang as $ct): 
                         $sp=SanPham::LayMotSanPham($ct->MaSanPham);
                         $s=Size::getOne($ct->MaSize);
                         $LisTopping=chitiettoppingdathang::LayDanhSachToppingTheoMaCTDH($ct->MaSanPham,$ct->MaDonHang);
                         $StringTopping="";
                         if($LisTopping!=null)
                         {
                            foreach($LisTopping as $tItem)
                            {
                                $topping=Topping::getOneByID($tItem->MaTopping);
                                $StringTopping .= $topping->TenTopping."(". $tItem->Gia.")\n";
                            }
                         }
                         ?>
                         <tr>
                            <td>
                                <img class="imgSanPhamMini" src="Images/imagesProducts/<?=$sp->hinhAnh?>" width="8%"/>
                                <?= $sp->tenSanPham."(SL:".$ct->SoLuong."Giá:".number_format($ct->GiaBan,0,",",".").")" ?>
                            </td>
                            <td><?= $s->TenSize.";".$ct->LuongDuong.";".$ct->LuongDa ?></td>
                            <td><?= $StringTopping ?></td>
                         </tr>
                         <?php endforeach; endif; ?>
                        </table>
                        
                        
                    </td>
                </tr>

                    <?php endforeach; endif;?>
                
            </table>
            
        </div>
        <div class="row">
            <h4 class="w-100 fw-bold" style="color:#6f6e6e;"><b>Lịch sử mua hàng ❭❭</b></h4><hr/>
            <table class="table table-striped table-hover">
                <tr>
                    <td>Mã đơn hàng</td>
                    <td>Địa chỉ giao hàng</td>
                    <td>Tổng tiền(VNĐ)</td>
                    <td>Ưu đãi</td>
                    <td>Giá giảm còn(VNĐ)</td>
                    <td>Chi tiết đặt hàng</td>
                </tr>
                <?php if($DanhSachSanPhamDaMua!=null):
                        foreach($DanhSachSanPhamDaMua as $DatHangItem):?>
                <tr>
                    <td><?= $DatHangItem->MaDonHang?></td>
                    <td><?= $DatHangItem->MaChiNhanh?></td>
                    <td><?= number_format($DatHangItem->TongTien,0,",",".") ?></td>
                    <td><?= $DatHangItem->UuDai." %"?></td>
                    <td><?=  number_format($DatHangItem->GiaGiamCon,0,",",".") ?></td>
                    <td>
                        <table class="table table-primary">
                            <tr>
                                <td>Tên sản phẩm</td>
                                <td>Chi tiết</td>
                                <td>Topping</td>
                            </tr>
                            <?php $DSChiTietDatHang=ChiTietDatHang::LayDanhSachDonHangMaDonHangVaMaNguoiDung($DatHangItem->MaDonHang);
                         if($DSChiTietDatHang!=null): foreach($DSChiTietDatHang as $ct): 
                         $sp=SanPham::LayMotSanPham($ct->MaSanPham);
                         $s=Size::getOne($ct->MaSize);
                         $LisTopping=chitiettoppingdathang::LayDanhSachToppingTheoMaCTDH($ct->MaSanPham,$ct->MaDonHang);
                         $StringTopping="";
                         if($LisTopping!=null)
                         {
                            foreach($LisTopping as $tItem)
                            {
                                $topping=Topping::getOneByID($tItem->MaTopping);
                                $StringTopping .= $topping->TenTopping."(". $tItem->Gia.")\n";
                            }
                         }
                         ?>
                         <tr>
                            <td>
                                <img class="imgSanPhamMini" src="Images/imagesProducts/<?=$sp->hinhAnh?>" width="8%"/>
                                <?= $sp->tenSanPham."(SL:".$ct->SoLuong."Giá:".number_format($ct->GiaBan,0,",",".").")" ?>
                            </td>
                            <td><?= $s->TenSize.";".$ct->LuongDuong.";".$ct->LuongDa ?></td>
                            <td><?= $StringTopping ?></td>
                         </tr>
                         <?php endforeach; endif; ?>
                        </table>
                        
                        
                    </td>
                </tr>

                    <?php endforeach; endif;?>
                
            </table>
        </div>
    </div>
</div>
<?php require("footer.php");?>