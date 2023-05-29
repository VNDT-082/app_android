
<?php require("LayoutMenuAdminHeader.php");

$DanhSachSanPham=SanPham::LayTatCa();

$DanhSachLoaiSanPham=LoaiSanPham::LayTatCa();

$DanhSachKhuyenMai=KhuyenMai::LayTatCa();

 
?>
<div class="row" style="margin-top: 20px;"></div>
<div class="row">
    <div class="col-md-4">
        <a href="QuanLyLoaiSanPham.php" style="text-decoration: none;" ><h4 class="w-100 fw-bold" style="color:#6f6e6e;"><b>❬❬ Quản lý loại sản phẩm ❭❭</b></h4></a>
    </div>
    <div class="col-md-4">
        <a href="QuanLySanPham.php" style="text-decoration: none;"><h4 class="w-100 fw-bold" style="color:#6f6e6e;"><b>❬❬ Quản lý sản phẩm ❭❭</b></h4></a>
    </div>
    <div class="col-md-4">
        <a href="QuanLyKhuyenMai.php" style="text-decoration: none;" ><h4 class="w-100 fw-bold" style="color:#6f6e6e;"><b>❬❬ Quản lý khuyến mãi ❭❭</b></h4></a>
    </div>
   
    
    <hr/>
</div>
<div class="row">
    
    
<div class="row">
    <div class="col-md-12">
        <h4 class="w-100 fw-bold" style="color:#6f6e6e;"><b>Quản lý khuyến mãi ❭❭</b></h4><hr/>
        <table class="table table-success  table-striped" style="width: 100%;" >
            <tr>
                <td style="width: 7%;">Id</td>
                <td style="width: 15%;">Tên sản phẩm</td>
                <td style="width: 20%;">Nội dung</td>
                <td style="width: 10%;">Chi tiết</td>
                <td style="width: 15%;">Ngày bắt đầu</td>
                <td style="width: 15%;">Ngày kết thúc</td>
                <td style="width: 13%;">Poster</td>
                <td style="width: 5%;"></td>
            </tr>

            
            <tr>
                <form method="post" enctype="multipart/form-data" action="XULY_FORMQLSanPham.php">
                <td style="text-align: center; vertical-align: middle;">
                    <input type="text" name="IdKhuyenMai" value="" style="width: 100%;" disabled="false"/>
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    <select name="MaSanPhamKhuyenMai">
                        <?php if($DanhSachSanPham!=null):
                        foreach($DanhSachSanPham as $sanpham):?>
                        <option value="<?=$sanpham->maSanPham?>"><?=$sanpham->tenSanPham?></option>
                        <?php endforeach;endif;?>
                    </select>
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    <input type="text" name="NoiDungKhuyenMai" value="" style="width: 100%;"/>
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    <input type="number" name="ChiTiet" value="0" style="width: 100%;"/>
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    <input type="date" name="NgayBatDau" value="" style="width: 100%;"/>
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    <input type="date" name="NgayKetThuc" value="" style="width: 100%;"/>
                </td>
                <td style="text-align: left; vertical-align: middle;">
                    <img id="HinhAnhKhuyenMai" src="Images/imagesProducts/SizeM.png" width="80%" />
                    <input id="fileHinhAnhKhuyenMai" type="file" name="fileAnhKhuyenMai" value="" style="width: 100%;"/>
                    <script>
                        var imgInput_KhuyenMai = document.getElementById('fileHinhAnhKhuyenMai');
                        var img_KhuyenMai = document.getElementById('HinhAnhKhuyenMai');

                        imgInput_KhuyenMai.addEventListener('change', function() {
                        var file = this.files[0];
                        var reader = new FileReader();
                        reader.addEventListener("load", function () {
                            img_KhuyenMai.src = reader.result;
                        }, false);

                        if (file) {
                            reader.readAsDataURL(file);
                        }
                        });

                    </script>
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    <button class="btnIcon" type="submit" name="ThemKhuyenMai"><img src="Images/add.png" width="100%"/></button>
                </td>
                </form>
            </tr>
            
            <form method="post" enctype="multipart/form-data" action="XULY_FORMQLSanPham.php">
                <?php if($DanhSachKhuyenMai!=null):foreach($DanhSachKhuyenMai as $KhuyenMai):?>
                    <tr>
                        <td style="text-align: center; vertical-align: middle;">
                            <input type="text" name="IdKhuyenMai" value="<?=$KhuyenMai->id?>" style="width: 100%;" readonly/>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">

                            <select name="MaSanPhamKhuyenMai"style="width: 100%;">
                                <?php if($DanhSachSanPham!=null):
                                foreach($DanhSachSanPham as $sanpham):if($sanpham->maSanPham==$KhuyenMai->MaSanPham):?>
                                <option value="<?=$sanpham->maSanPham?>"><?=$sanpham->tenSanPham?></option>
                                <?php endif; endforeach;endif;?>
                            </select>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <input type="text" name="NoiDungKhuyenMai" value="<?=$KhuyenMai->NoiDung?>" style="width: 100%;"/>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <input type="number" name="ChiTiet" value="<?=$KhuyenMai->ChiTiet?>" style="width: 100%;"/>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <input type="date" name="NgayBatDau" value="<?=$KhuyenMai->NgayBatDau?>" style="width: 100%;"/>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <input type="date" name="NgayKetThuc" value="<?=$KhuyenMai->NgayKetThuc?>" style="width: 100%;"/>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <img src="..//Images/imagesProducts/<?=$KhuyenMai->HinhAnh?>" width="80%" />
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <button class="btnIcon" type="submit" name="updateKhuyenMai"><img src="Images/loop.png" width="100%"/></button>
                            <button class="btnIcon" type="submit" name="deleteKhuyenMai"><img src="Images/bin.png" width="100%"/></button>
                        </td>
                    </tr>
                <?php endforeach;endif;?>
            
            </form>
            
        </table>
    </div>
</div>

<?php require("LayoutMenuAdminFooter.php");?>

