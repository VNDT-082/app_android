
<?php require("LayoutMenuAdminHeader.php");
// $MaNhanVien=$_SESSION['MaNhanVien'];
$NhanVien=new NhanVien();
$NhanVien= $_SESSION['NhanVien'];
if($_SERVER['REQUEST_METHOD'] == 'POST' )
{
    if(isset($_POST['dangxuat']))
    {
        unset($_SESSION['NhanVien']);
        header('location: Login.php');
        exit();
    }
}
?>
<div class="row">
    <div class="col-md-12">
        <h4 class="w-100 fw-bold" style="color:#6f6e6e;"><b>Thông tin nhân viên ❭❭</b></h4><hr/>
        <table class="table table-success  table-striped" style="width: 100%;" >
            <tr>
                <td style="width: 5%;">Mã nhân viên</td>
                <td style="width: 25%;">Chi nhánh</td>
                <td style="width: 21%;">Tên nhân viên</td>
                <td style="width: 12%;">SDT đăng nhập</td>
                <td style="width: 12%;">SDT liên hệ</td>
                <td style="width: 5%;">Giới tính</td>
                <td style="width: 8%;">Ngày sinh</td> 
                <td style="width: 8%;">Ngày vào làm</td>
            </tr>
            <form method="post" enctype="multipart/form-data" action="XULY_FORMQLDonHang.php">
                <?php if($NHANVIENDANGNHAP!=null):?>
                <tr>
                    <td style="text-align: center; vertical-align: middle;">
                <input type="text" name="MaDonHang" value="<?= $NhanVien->MaNhanVien?>" style="width: 100%;" readonly/>
            </td>
            <td style="text-align: center; vertical-align: middle;">
                <?php $ChiNhanh=ChiNhanh::LayMotChiNhanh($NhanVien->MaChiNhanh);if($ChiNhanh!=null):?>
                <input type="text" name="TenKhach" value="<?=$ChiNhanh->TenChiNhanh?>" style="width: 100%; margin-bottom: 1%   ;" readonly/><br/>
                <?php endif;?>
            </td>
            <td style="text-align: center; vertical-align: middle;">
                <input type="text" name="DiaChiNhanHang" value="<?=$NhanVien->TenNhanVien?>" style="width: 100%;" readonly />
            </td>
            <td style="text-align: center; vertical-align: middle;">
                <input type="number" name="TongTien" value="<?=$NhanVien->SDTDangNhap?>" style="width: 100%;" readonly/>
            </td>
            <td style="text-align: center; vertical-align: middle;">
                <input type="number" name="UuDai" value="<?=$NhanVien->SDTLienHe?>" style="width: 100%;" readonly/>
            </td>
            <td style="text-align: center; vertical-align: middle;">
                <?php if($NhanVien->GioiTinh==1):?>
                    <input style="width: 90%;"  type="text" name="GioiTinh" value="Nam" disabled="false"/></td>
                <?php else:?>
                    <input style="width: 90%;"  type="text" name="GioiTinh" value="Nữ" disabled="false"/></td>
                <?php endif;?>
            </td>
            
            <td style="text-align: center; vertical-align: middle;">
                <input type="date" name="NgayMua" value="<?=$NhanVien->NgaySinh?>" style="width: 100%;" readonly/>
            </td>
            <td style="text-align: center; vertical-align: middle;">
                <input type="date" name="NgayMua" value="<?=$NhanVien->NgayVaoLam?>" style="width: 100%;" readonly/>
                
            </td>
                    <!-- <td style="text-align: center; vertical-align: middle;">
                        <button class="btnIcon" type="submit" name="NhanDonHang"><img src="..//Images/loop.png" width="90%"/></button>
                        <button class="btnIcon" type="submit" name="HuyDonHang"><img src="..//Images/bin.png" width="90%"/></button>
                    </td> -->
                </tr><?php endif;?>
            </form>
        </table>
        
        
    </div>

</div> 
 <div class="row">
    <div class="col-md-9"></div><div class="col-md-3"><form method="post" enctype="multipart/form-data">
            <button type="submit" name="dangxuat" class="btn btn-primary form-control">Đăng xuất</button>
        </form></div>
 </div>
<?php require("LayoutMenuAdminFooter.php");?>