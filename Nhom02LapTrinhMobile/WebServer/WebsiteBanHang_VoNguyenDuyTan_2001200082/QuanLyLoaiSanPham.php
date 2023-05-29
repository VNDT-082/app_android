
<?php require("LayoutMenuAdminHeader.php");

$DanhSachSanPham=SanPham::LayTatCa();

$DanhSachLoaiSanPham=LoaiSanPham::LayTatCa();

$DanhSachKhuyenMai=KhuyenMai::LayTatCa();

 
?>
<div class="row" style="margin-top: 20px;"></div>
<div class="row">
    <div class="col-md-4">
        <a href="QuanLyLoaiSanPham.php" style="text-decoration: none;"><h4 class="w-100 fw-bold" style="color:#6f6e6e;"><b>❬❬ Quản lý loại sản phẩm ❭❭</b></h4></a>
    </div>
    <div class="col-md-4">
        <a href="QuanLySanPham.php" style="text-decoration: none;"><h4 class="w-100 fw-bold" style="color:#6f6e6e;"><b>❬❬ Quản lý sản phẩm ❭❭</b></h4></a>
    </div>
    <div class="col-md-4">
        <a href="QuanLyKhuyenMai.php" style="text-decoration: none;"><h4 class="w-100 fw-bold" style="color:#6f6e6e;"><b>❬❬ Quản lý khuyến mãi ❭❭</b></h4></a>
    </div>
   
    
    <hr/>
</div>
<div class="row">
    
    <div class="col-md-11">
        
        
        
        <h4 class="w-100 fw-bold" style="color:#6f6e6e;"><b>Quản lý loại sản phẩm ❭❭</b></h4><hr/>
        <table class="table table-success  table-striped" style="width: 100%;" >
            <tr>
                <td style="width: 10%;">Mã loại</td>
                <td style="width: 40%;">Tên loại</td>
                <td style="width: 25%;">Hình ảnh</td>
                <td style="width: 15%;"></td>
            </tr>

            <form method="post" enctype="multipart/form-data" action="XULY_FORMQLSanPham.php">
                <tr>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="MaLoai" value="" style="width: 100%;" disabled="false"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="TenLoai" value="" style="width: 100%; "/>
                    </td>
                    <td style="text-align: left; vertical-align: middle;">
                        <img id="HinhAnhLoaiSanPham" src="Images/imagesProducts/SizeM.png" width="40%" />
                        <input id="fileHinhAnhLoaiSanPham" type="file" name="file_LoaiSanPham" value="" style="width: 100%;"/>
                        <script>
                            var imgInput = document.getElementById('fileHinhAnhLoaiSanPham');
                            var img = document.getElementById('HinhAnhLoaiSanPham');

                            imgInput.addEventListener('change', function() {
                            const file = this.files[0];
                            const reader = new FileReader();
                            reader.addEventListener("load", function () {
                                img.src = reader.result;
                            }, false);

                            if (file) {
                                reader.readAsDataURL(file);
                            }
                            });

                        </script>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <button class="btnIcon" type="submit" name="addLoaiSanPham"><img src="Images/add.png" width="30%"/></button>
                    </td>
                </tr>
            </form >
            <?php if($DanhSachLoaiSanPham!=null):
                    foreach($DanhSachLoaiSanPham as $LoaiSanPham):
                    if($LoaiSanPham->maLoai!= 5):?>
                   <form method="post" enctype="multipart/form-data" action="XULY_FORMQLSanPham.php">
                     <tr>
                        <td style="text-align: center; vertical-align: middle;">
                            <input type="text" name="MaLoai" value="<?=$LoaiSanPham->maLoai?>" style="width: 100%;" readonly/>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <input type="text" name="TenLoai" value="<?=$LoaiSanPham->tenLoai?>" style="width: 100%; "/>
                        </td>
                        <td style="text-align: left; vertical-align: middle;">
                            <img id="HinhAnhInsert<?=$LoaiSanPham->maLoai?>" src="Images/imagesProducts/<?=$LoaiSanPham->hinhAnh?>" width="35%" />
                            <input id="fileHinhAnhLoaiSanPhamInsert<?=$LoaiSanPham->maLoai?>" type="file" name="file_LoaiSanPham" value="<?=$LoaiSanPham->hinhAnh?>" style="width: 100%;"/>
                            <script>
                                var imgInput_insert = document.getElementById('fileHinhAnhLoaiSanPhamInsert<?=$LoaiSanPham->maLoai?>');
                                var img_insert = document.getElementById('HinhAnhInsert<?=$LoaiSanPham->maLoai?>');

                                imgInput_insert.addEventListener('change', function() {
                                const file = this.files[0];
                                const reader = new FileReader();
                                reader.addEventListener("load", function () {
                                    img_insert.src = reader.result;
                                }, false);

                                if (file) {
                                    reader.readAsDataURL(file);
                                }
                                });

                            </script>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <button class="btnIcon" type="submit" name="update_LoaiSanPham"><img src="Images/loop.png" width="30%"/></button><br/><br/>
                            <button class="btnIcon" type="submit" name="delete_LoaiSanPham"><img src="Images/bin.png" width="30%"/></button>
                        </td>
                    </tr>
                   </form>
                   <?php endif;endforeach;
                    foreach($DanhSachLoaiSanPham as $LoaiSanPham):
                    if($LoaiSanPham->maLoai== 5):?>
                    <form method="post" enctype="multipart/form-data" action="XULY_FORMQLSanPham.php">
                     <tr>
                        <td style="text-align: center; vertical-align: middle;">
                            <input type="text" name="MaLoai" value="<?=$LoaiSanPham->maLoai?>" style="width: 100%;" disabled/>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <input type="text" name="TenLoai" value="<?=$LoaiSanPham->tenLoai?>" style="width: 100%; " disabled/>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <img src="Images/imagesProducts/<?=$LoaiSanPham->hinhAnh?>" width="35%" />
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                        </td>
                    </tr>
                   </form>
            <?php endif;endforeach;endif;?>
        </table>
    </div>
    
</div>


<?php require("LayoutMenuAdminFooter.php");?>

