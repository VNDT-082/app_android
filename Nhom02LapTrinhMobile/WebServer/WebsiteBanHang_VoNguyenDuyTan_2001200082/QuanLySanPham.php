
<?php require("LayoutMenuAdminHeader.php");

$DanhSachSanPham=SanPham::LayTatCa();

$DanhSachLoaiSanPham=LoaiSanPham::LayTatCa();

$DanhSachKhuyenMai=KhuyenMai::LayTatCa();

 
?>
<div class="row" style="margin-top: 20px;"></div>
<div class="row">
    <div class="col-md-4">
        <a href="QuanLyLoaiSanPham.php" style="text-decoration: none;" ><h4 class="w-100 fw-bold" style="color:#6f6e6e;text-decoration: none;"><b>❬❬ Quản lý loại sản phẩm ❭❭</b></h4></a>
    </div>
    <div class="col-md-4">
        <a href="QuanLySanPham.php" style="text-decoration: none;" ><h4 class="w-100 fw-bold" style="color:#6f6e6e;"><b>❬❬ Quản lý sản phẩm ❭❭</b></h4></a>
    </div>
    <div class="col-md-4">
        <a href="QuanLyKhuyenMai.php" style="text-decoration: none;" ><h4 class="w-100 fw-bold" style="color:#6f6e6e;"><b>❬❬ Quản lý khuyến mãi ❭❭</b></h4></a>
    </div>
   
    
    <hr/>
</div>
<div class="row"> 
    <h4 class="w-100 fw-bold" style="color:#6f6e6e;"><b>Quản lý sản phẩm ❭❭</b></h4><hr/>
    <table class="table table-success  table-striped" style="width: 100%;" >
            <tr>
                <td style="width: 10%;">Hình ảnh</td>
                <td style="width: 20%;">Tên sản phẩm</td>
                <td style="width: 3%;">Mã sản phẩm</td>
                <td style="width: 15%;">Loại sản phẩm</td>
                <td style="width: 25%;">Mô tả</td>
                <td style="width: 5%;">Lượt mua</td>
                <td style="width: 10%;">Giá</td>
                <td style="width: 7%;">Trạng thái</td>
                <td style="width: 5%;"></td>
            </tr>

            <form method="post" enctype="multipart/form-data" action="XULY_FORMQLSanPham.php">
                <tr>
                    <td style="text-align: left; vertical-align: middle;">
                        <img id="HinhAnhSanPham" src="Images/imagesProducts/SizeM.png" width="80%" />
                        <input id="fileHinhAnhSanPham" type="file" name="fileHinhAnhSanPham" value="" style="width: 100%;"/>
                        <script>
                            var imgInput_SanPham = document.getElementById('fileHinhAnhSanPham');
                            var img_SanPham = document.getElementById('HinhAnhSanPham');

                            imgInput_SanPham.addEventListener('change', function() {
                            var file = this.files[0];
                            var reader = new FileReader();
                            reader.addEventListener("load", function () {
                                img_SanPham.src = reader.result;
                            }, false);

                            if (file) {
                                reader.readAsDataURL(file);
                            }
                            });

                        </script>
                    </td>

                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="TenSanPham" value="" style="width: 100%;; "/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="MaSanPham" value="" style="width: 100%;" disabled/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <?php if($DanhSachLoaiSanPham!=null):?>
                            <select name="MaLoaiSanPham" style="width: 100%;">
                                <option name="<?=$DanhSachLoaiSanPham[0]->maLoai?>" value="5">
                                </option>
                                <?php foreach($DanhSachLoaiSanPham as $LoaiSanPham):?>
                                <option name="<?=$LoaiSanPham->maLoai?>" value="<?=$LoaiSanPham->maLoai?>">
                                    <?=$LoaiSanPham->tenLoai?>
                                </option>
                                <?php endforeach;?>
                            </select>
                        <?php endif;?>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="Mota" value="" style="width: 100%;"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="LuotMua" value="" style="width: 100%;" disabled/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="number" name="Gia" value="" style="width: 100%;"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <select name="TrangThai" style="width: 100%;">
                                <option value="0"></option>
                                <option value="0">Mở</option>
                                <option value="1">Khóa</option>
                        </select>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <button class="btnIcon" type="submit" name="ThemSanPham"><img src="Images/add.png" width="100%"/></button>
                    </td>
                    
                </tr>
             </form>

            <?php if($DanhSachSanPham!=null):
             foreach($DanhSachSanPham as $sanpham): ?>
             <form method="post" enctype="multipart/form-data" action="XULY_FORMQLSanPham.php">
                <tr>
                    <td style="text-align: left; vertical-align: middle;">
                        <img id="HinhAnhSanPhamInsert" src="Images/imagesProducts/<?=$sanpham->hinhAnh?>" width="80%" />
                        <input id="fileHinhAnhSanPhamInsert" type="file" name="fileHinhAnhSanPham" value="<?=$sanpham->hinhAnh?>" style="width: 100%;"/>
                        <script>
                            var imgInput_SanPham_insert = document.getElementById('fileHinhAnhSanPhamInsert');
                            var img_SanPham_insert = document.getElementById('HinhAnhSanPhamInsert');

                            imgInput_SanPham_insert.addEventListener('change', function() {
                            var file = this.files[0];
                            var reader = new FileReader();
                            reader.addEventListener("load", function () {
                                img_SanPham_insert.src = reader.result;
                            }, false);

                            if (file) {
                                reader.readAsDataURL(file);
                            }
                            });

                        </script>
                        
                    </td>

                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="TenSanPham" value="<?=$sanpham->tenSanPham?>" style="width: 100%;; "/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="MaSanPham" value="<?=$sanpham->maSanPham?>" style="width: 100%;" readonly/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <?php if($DanhSachLoaiSanPham!=null):?>
                            <select name="MaLoaiSanPham" style="width: 100%;">
                                <?php foreach($DanhSachLoaiSanPham as $LoaiSanPham):
                                    if($LoaiSanPham->maLoai==$sanpham->maLoai):?>
                                <option name="<?=$LoaiSanPham->maLoai?>" value="<?=$LoaiSanPham->maLoai?>">
                                    <?=$LoaiSanPham->tenLoai?>
                                </option>
                                <?php endif;endforeach;?>
                                <?php foreach($DanhSachLoaiSanPham as $LoaiSanPham):
                                    if($LoaiSanPham->maLoai!=$sanpham->maLoai):?>
                                <option name="<?=$LoaiSanPham->maLoai?>" value="<?=$LoaiSanPham->maLoai?>">
                                    <?=$LoaiSanPham->tenLoai?>
                                </option>
                                <?php endif;endforeach;?>
                            </select>
                        <?php endif;?>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="Mota" value="<?=$sanpham->moTa?>" style="width: 100%;"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="LuotMua" value="<?=$sanpham->luotMua?>" disabled="false" style="width: 100%;"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="number" name="Gia" value="<?=$sanpham->giaBan?>" style="width: 100%;"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <select name="TrangThai" style="width: 100%;">
                            <?php if($sanpham->trangThai==1):?>
                                <option value="1">Mở</option>
                                <option value="0">Khóa</option>
                            <?php else:?>
                                <option value="0">Khóa</option>
                                <option value="1">Mở</option>
                            <?php endif;?>
                        </select>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <button class="btnIcon" type="submit" name="updateSanPham"><img src="Images/loop.png" width="100%"/></button><br/><br/>
                        <button class="btnIcon" type="submit" name="deleteSanPham"><img src="Images/bin.png" width="100%"/></button>
                    </td>
                    
                </tr>
             </form>
             <?php endforeach;endif;?>
            
        </table>
</div>

<?php require("LayoutMenuAdminFooter.php");?>


