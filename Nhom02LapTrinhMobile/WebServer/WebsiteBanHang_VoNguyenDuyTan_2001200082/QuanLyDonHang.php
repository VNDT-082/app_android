<?php require("LayoutMenuAdminHeader.php");

$DanhSachTatCaCacDonHangChoDuyet=DatHang::LayTatCaDonHangChoDuyet();

$DanhSachCacDonHangDaDuyet=DatHang::LayTatCaDonDangDaDuyet();
?>
<div class="row">
    <div class="col-md-12">
        <h4 class="w-100 fw-bold" style="color:#6f6e6e;"><b>Quản lý đơn đặt hàng ❭❭</b></h4><hr/>
        <table class="table table-success  table-striped" style="width: 100%;" >
            <tr>
                <td style="width: 5%;">Mã đơn hàng</td>
                <td style="width: 25%;">Khách hàng</td>
                <td style="width: 21%;">Đia chỉ nhận hàng</td>
                <td style="width: 10%;">Tổng tiền</td>
                <td style="width: 8%;">Ưu đãi</td>
                <td style="width: 10%;">Giá giảm còn</td>
                <td style="width: 10%;">Ngày mua</td> 
                <td style="width: 6%;">Trạng thái</td>
                <td style="width: 15%;"></td>
            </tr>
            <?php if($DanhSachTatCaCacDonHangChoDuyet!=null):
                    foreach($DanhSachTatCaCacDonHangChoDuyet as $DatHang):?>
                   <form method="post" enctype="multipart/form-data" action="XULY_FORMQLDonHang.php">
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="MaDonHang" value="<?=$DatHang->MaDonHang?>" style="width: 100%;" readonly/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <label for="MaKhach" style="width: 50%;">Mã khách:</label>
                        <input type="number" name="MaKhach" value="<?=$DatHang->MaNguoiDung?>" style="width: 45%; " readonly/>
                        <label for="TenKhach" style="width: 15%;">Tên:</label>
                        <?php $KhachHang=NguoiDung::LayMotNguoiDung($DatHang->MaNguoiDung);if($KhachHang!=null):?>
                        <input type="text" name="TenKhach" value="<?=$KhachHang->TenNguoiDung?>" style="width: 80%; margin-bottom: 1%   ;" readonly/><br/>
                        <?php endif;?>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="DiaChiNhanHang" value="<?=$DatHang->MaChiNhanh?>" style="width: 100%;" readonly />
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="number" name="TongTien" value="<?=$DatHang->TongTien?>" style="width: 100%;" readonly/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="number" name="UuDai" value="<?=$DatHang->UuDai?>" style="width: 100%;" readonly/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="number" name="GiaGiamCon" value="<?=$DatHang->GiaGiamCon?>" style="width: 100%;" readonly/>
                    </td>
                    
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="datetime" name="NgayMua" value="<?=$DatHang->NgayMua?>" style="width: 100%;" readonly/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <select name="TrangThai">
                            <?php if($DatHang->TrangThai==0):?>
                                <option value="<?=$DatHang->TrangThai?>" style="width: 100%;">Chờ duyệt</option>
                                <option value="1" style="width: 100%;">Nhận đơn</option>
                            <?php else:?>
                                <option value="<?=$DatHang->TrangThai?>" style="width: 100%;">Nhận đơn</option>
                                <option value="0" style="width: 100%;">Chờ duyệt</option>
                            <?php endif;?>
                        </select>
                        
                    </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <button class="btnIcon" type="submit" name="NhanDonHang"><img src="Images/loop.png" width="90%"/></button>
                                <button class="btnIcon" type="submit" name="HuyDonHang"><img src="Images/bin.png" width="90%"/></button>
                            </td>
                        </tr>
                    </form>
                        
                    <?php endforeach; endif;?>
        </table>
    </div>

    <div class="col-md-12">
        <h4 class="w-100 fw-bold" style="color:#6f6e6e;"><b>Đơn đặt hàng đã duyệt ❭❭</b></h4><hr/>
        <table class="table table-success  table-striped" style="width: 100%;" >
            <tr>
                <td style="width: 5%;">Mã đơn hàng</td>
                <td style="width: 25%;">Khách hàng</td>
                <td style="width: 21%;">Đia chỉ nhận hàng</td>
                <td style="width: 10%;">Tổng tiền</td>
                <td style="width: 8%;">Ưu đãi</td>
                <td style="width: 10%;">Giá giảm còn</td>
                <td style="width: 10%;">Ngày mua</td> 
                <td style="width: 6%;">Trạng thái</td>
            </tr>
            <?php if($DanhSachCacDonHangDaDuyet!=null):
                    foreach($DanhSachCacDonHangDaDuyet as $DatHang):?>
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="MaDonHang" value="<?=$DatHang->MaDonHang?>" style="width: 100%;" disabled="false"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <label for="MaKhach" style="width: 50%;">Mã khách:</label>
                        <input type="number" name="MaKhach" value="<?=$DatHang->MaNguoiDung?>" style="width: 45%; " readonly/>
                        <label for="TenKhach" style="width: 15%;">Tên:</label>
                        <?php $KhachHang=NguoiDung::LayMotNguoiDung($DatHang->MaNguoiDung);if($KhachHang!=null):?>
                        <input type="text" name="TenKhach" value="<?=$KhachHang->TenNguoiDung?>" style="width: 80%; margin-bottom: 1%   ;" readonly/><br/>
                        <?php endif;?>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="DiaChiNhanHang" value="<?=$DatHang->MaChiNhanh?>" style="width: 100%;" readonly />
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="number" name="TongTien" value="<?=$DatHang->TongTien?>" style="width: 100%;" readonly/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="number" name="UuDai" value="<?=$DatHang->UuDai?>" style="width: 100%;" readonly/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="number" name="GiaGiamCon" value="<?=$DatHang->GiaGiamCon?>" style="width: 100%;" readonly/>
                    </td>
                    
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="datetime" name="NgayMua" value="<?=$DatHang->NgayMua?>" style="width: 100%;" readonly/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <select name="TrangThai">
                            <?php if($DatHang->TrangThai==0):?>
                                <option value="<?=$DatHang->TrangThai?>" style="width: 100%;">Chờ duyệt</option>
                                <option value="1" style="width: 100%;">Nhận đơn</option>
                            <?php else:?>
                                <option value="<?=$DatHang->TrangThai?>" style="width: 100%;">Nhận đơn</option>
                                <option value="0" style="width: 100%;">Chờ duyệt</option>
                            <?php endif;?>
                        </select>
                        
                    </td>
                          
                    <?php endforeach; endif;?>
        </table>
    </div>
    
</div>



<?php require("LayoutMenuAdminFooter.php");?>