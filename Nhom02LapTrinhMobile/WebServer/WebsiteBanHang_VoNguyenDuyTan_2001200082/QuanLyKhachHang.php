<?php require("LayoutMenuAdminHeader.php");

$DanhSachKhachHang=NguoiDung::LayTatCa();
 
?>
<div class="row">
    <div class="col-md-12">
        
        <h4 class="w-100 fw-bold" style="color:#6f6e6e;">
        <b>Quản lý khách hàng ❭❭</b></h4><hr/>
        <table class="table table-success  table-striped" style="width: 100%;" >
            <tr>
                <td style="width: 5%;">Mã khách hàng</td>
                <td style="width: 25%;">Thông tin khách</td>
                <td style="width: 5%;">Loại khách</td>
                <td style="width: 12%;">SDT Đăng nhập</td>
                <td style="width: 12%;">SDT Liên hệ</td>
                <td style="width: 20%;">Email</td>
                <td style="width: 6%;">Trạng thái tài khoản</td>
                <td style="width: 10%;">Mật khẩu</td>
                <td style="width: 15%;"></td>
            </tr>

            <form>
                <tr>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="MaKhach" value="" style="width: 100%;" disabled="false"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <label for="TenKhach" style="width: 15%;">Tên:</label>
                        <input type="text" name="TenKhach" value="" style="width: 80%; margin-bottom: 1%   ;"/><br/>
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
                        <input type="number" name="LoaiKhach" value="" style="width: 100%;" disabled="false"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="SDTDanghap" value="" style="width: 100%;"disabled="false"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="SDTLienHe" value="" style="width: 100%;"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="email" name="Email" value="" style="width: 100%;"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                    <select name="TrangThai">
                        <option value="0" style="width: 100%;"></option>
                        <option value="0" style="width: 100%;">Tài khoản đang mở</option>
                        <option value="3" style="width: 100%;">Tài khoản đã khóa</option>
                    </select>
                        
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="MatKhau" value="" style="width: 100%;"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <button class="btnIcon" type="submit" name="SuaKhachHang"><img src="Images/add.png" width="80%"/></button>
                    </td>
                </tr>
            </form>
            <?php if($DanhSachKhachHang!=null):
                    foreach($DanhSachKhachHang as $KhachHang):?>
                   <form>
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="text" name="MaKhach" value="<?=$KhachHang->MaNguoiDung?>" style="width: 100%;" disabled="false"/>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <label for="TenKhach" style="width: 15%;">Tên:</label>
                                <input type="text" name="TenKhach" value="<?=$KhachHang->TenNguoiDung?>" style="width: 80%; margin-bottom: 1%   ;"/><br/>
                                <label for="GioiTinh" style="width: 15%;">Phái:</label>
                                <select name="GioiTinh" style="width: 80%; margin-bottom: 1% ">
                                    <?php if($KhachHang->GioiTinh==0):?>
                                        <option value="<?=$KhachHang->GioiTinh?>">Nữ</option>
                                    <?php else:?>
                                        <option value="<?=$KhachHang->GioiTinh?>">Nam</option>
                                    <?php endif;?>
                                </select><br/>
                                 <label for="NgaySinh" style="width: 15%;">NS:</label>
                                <input type="date" name="NgaySinh" value="<?=$KhachHang->NgaySinh?>" style="width: 80%; "/>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="number" name="LoaiKhach" value="<?=$KhachHang->MaLoaiKH?>" style="width: 100%;" disabled="false"/>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="text" name="SDTDanghap" value="<?=$KhachHang->SDTDangNhap?>" style="width: 100%;"disabled="false"/>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="text" name="SDTLienHe" value="<?=$KhachHang->SDTLienHe?>" style="width: 100%;"/>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="email" name="Email" value="<?=$KhachHang->Email?>" style="width: 100%;"/>
                            </td>
                            <?php $TaiKhoan=TaiKhoan::getOneBySDTDangNhap($KhachHang->SDTDangNhap);?>
                            <td style="text-align: center; vertical-align: middle;">
                            <select name="TrangThai">
                                <?php if($TaiKhoan->LoaiTaiKhoan==0):?>
                                <option value="0" style="width: 100%;">Tài khoản đang mở</option>
                                <?php elseif($TaiKhoan->LoaiTaiKhoan==3):?>
                                    <option value="3" style="width: 100%;">Tài khoản đã khóa</option>
                                <?php endif;?>
                            </select>
                                
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="text" name="MatKhau" value="<?= $TaiKhoan->MatKhau?>" style="width: 100%;"/>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <button class="btnIcon" type="submit" name="SuaKhachHang"><img src="Images/loop.png" width="80%"/></button>
                            </td>
                        </tr>
                    </form>
                        
                    <?php endforeach; endif;?>
            

            
        </table>
    </div>
    
</div>



<?php require("LayoutMenuAdminFooter.php");?>