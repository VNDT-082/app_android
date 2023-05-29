<?php require("LayoutMenuAdminHeader.php");

$DanhSachNhanVien=NhanVien::LayTatCa();
$DanhSachChiNhanh=ChiNhanh::getAll(); 
?>
<div class="row">
    <div class="col-md-12">
        <h4 class="w-100 fw-bold" style="color:#6f6e6e;"><b>Quản lý nhân viên ❭❭</b></h4><hr/>
        <table class="table table-success  table-striped" style="width: 100%;" >
            <tr>
                <td style="width: 5%;">Mã nhân viên</td>
                <td style="width: 25%;">Thông tin nhân viên</td>
                <td style="width: 16%;">Chi nhánh</td>
                <td style="width: 12%;">SDT Đăng nhập</td>
                <td style="width: 12%;">SDT Liên hệ</td>
                <td style="width: 7%;">Ngày vào làm</td>
                <td style="width: 7%;">Trạng thái tài khoản</td>
                <td style="width: 10%;">Mật khẩu</td>
                <td style="width: 14%;"></td>
            </tr>

            <form method="post" enctype="multipart/form-data" action="XULY_FORMQLNhanVien.php">
                <tr>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="MaNhanVien" value="" style="width: 100%;" disabled="false"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <label for="TenNhanVien" style="width: 15%;">Tên:</label>
                        <input type="text" name="TenNhanVien" value="" style="width: 80%; margin-bottom: 1%   ;"/><br/>
                        <label for="GioiTinh" style="width: 15%;">Phái:</label>
                        <select name="GioiTinh" style="width: 80%; margin-bottom: 1% ">
                            <option value="0"></option>
                            <option value="0">Nữ</option>
                            <option value="1">Nam</option>
                        </select><br/>
                            <label for="NgaySinh" style="width: 15%;">NS:</label>
                        <input type="date" name="NgaySinh" value="" style="width: 80%; "/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                    
                    <select name="ChiNhanh" style="width: 100%;">
                        <?php if($DanhSachChiNhanh !=null):
                        foreach($DanhSachChiNhanh as $ChiNhanh):?>
                            <option value="<?=$ChiNhanh->MaChiNhanh?>" style="width: 100%;"><?=$ChiNhanh->TenChiNhanh?></option>
                        <?php endforeach;endif;?>
                    </select>
                        
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="number" name="SDTDangNhap" value="" style="width: 100%;"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="SDTLienHe" value="" style="width: 100%;"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="date" name="NgayVaoLam" value="" style="width: 100%;"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                    <select name="TrangThai"  style="width: 100%;">
                        <option value="1" style="width: 100%;"></option>
                        <option value="1" style="width: 100%;">Đang mở</option>
                        <option value="3" style="width: 100%;">Đã khóa</option>
                    </select>
                        
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="MatKhau" value="" style="width: 100%;"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <button class="btnIcon" type="submit" name="ThemNhanVien"><img src="Images/add.png" width="80%"/></button>
                    </td>
                </tr>
            </form>
            <?php if($DanhSachNhanVien!=null):
                    foreach($DanhSachNhanVien as $NhanVien):?>
                   <form method="post" enctype="multipart/form-data" action="XULY_FORMQLNhanVien.php">
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="text" name="MaNhanVien" value="<?=$NhanVien->MaNhanVien?>" style="width: 100%;" disabled="false"/>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <label for="TenNhanVien" style="width: 15%;">Tên:</label>
                                <input type="text" name="TenNhanVien" value="<?=$NhanVien->TenNhanVien?>" style="width: 80%; margin-bottom: 1%   ;"/><br/>
                                <label for="GioiTinh" style="width: 15%;">Phái:</label>
                                <select name="GioiTinh" style="width: 80%; margin-bottom: 1% ">
                                    <?php if($NhanVien->GioiTinh==0):?>
                                        <option value="<?=$NhanVien->GioiTinh?>">Nữ</option>
                                    <?php else:?>
                                        <option value="<?=$NhanVien->GioiTinh?>">Nam</option>
                                    <?php endif;?>
                                </select><br/>
                                    <label for="NgaySinh" style="width: 15%;">NS:</label>
                                <input type="date" name="NgaySinh" value="<?=$NhanVien->NgaySinh?>" style="width: 80%; "/>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                            
                            <select name="ChiNhanh" style="width: 100%;">
                                <?php if($DanhSachChiNhanh !=null):
                                foreach($DanhSachChiNhanh as $ChiNhanh):
                                if($ChiNhanh->MaChiNhanh!=$NhanVien->MaChiNhanh):?>
                                    <option value="<?=$ChiNhanh->MaChiNhanh?>" style="width: 100%;"><?=$ChiNhanh->TenChiNhanh?></option>
                                <?php endif; endforeach;endif;?>
                                <?php if($DanhSachChiNhanh !=null):
                                foreach($DanhSachChiNhanh as $ChiNhanh):
                                if($ChiNhanh->MaChiNhanh==$NhanVien->MaChiNhanh):?>
                                    <option value="<?=$ChiNhanh->MaChiNhanh?>" style="width: 100%;"><?=$ChiNhanh->TenChiNhanh?></option>
                                <?php endif; endforeach;endif;?>
                            </select>
                                
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="text" name="SDTDangNhap" value="<?=$NhanVien->SDTDangNhap?>" style="width: 100%;" readonly/>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="text" name="SDTLienHe" value="<?=$NhanVien->SDTLienHe?>" style="width: 100%;"/>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="date" name="NgayVaoLam" value="<?=$NhanVien->NgayVaoLam?>" style="width: 100%;"/>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                            <?php $TaiKhoan=TaiKhoan::getOneBySDTDangNhap($NhanVien->SDTDangNhap);?>
                            <select name="TrangThai"  style="width: 100%;">
                                <?php if($TaiKhoan->LoaiTaiKhoan==1):?>
                                <option value="0" style="width: 100%;">Đang mở</option>
                                <?php elseif($TaiKhoan->LoaiTaiKhoan==3):?>
                                    <option value="3" style="width: 100%;">Đã khóa</option>
                                <?php endif;?>
                            </select>
                                
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="text" name="MatKhau" value="<?=$TaiKhoan->MatKhau?>" style="width: 100%;"/>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <button class="btnIcon" type="submit" name="SuaNhanVien"><img src="Images/loop.png" width="80%"/></button>
                            </td>
                        </tr>
                    </form>
                        
                    <?php endforeach; endif;?>
            

            
        </table>
    </div>
    
</div>



<?php require("LayoutMenuAdminFooter.php");?>