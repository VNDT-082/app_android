<?php
require("header.php");
$id=$_GET["id"];
$sanpham= SanPham::LayMotSanPham($id);// $home->getOneProduct($id);
//lay list san pham noi bac
$ListProductOutStanding= SanPham::LayDanhSachSanPhamMuaNhieu();
//lay list topping
$ListTopping=Topping::getAll();
//lay list size
$ListSize=Size::getAll();
//lay list san pham cung loai
$listProductSameCategory=SanPham::getProductSameCategory($sanpham->getMaLoai());
//lay khuyen mai
$KhuyenMai=KhuyenMai::getOneByIdProduct($sanpham->getMaSanPham());
$GiaSauGiam=0;
if($KhuyenMai!=null)
{
    $GiaSauGiam=$sanpham->getGiaBan() - $sanpham->getGiaBan()*$KhuyenMai->ChiTiet/100;
} 
//lay danh gia san pham;
$ListCommnet=NhanXet::getAllWithProductID($sanpham->maSanPham);


// $KhachHang=$_SESSION['KhachHang'];
//var_dump($KhachHang);




?>


<br/>
<div class="row"><h3 class="w-100 fw-bold" style="color:#6f6e6e;">Danh sách sản phẩm ❭❭ Chi tiết sản phẩm ❭❭</h3><hr/></div>

<div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-5">
                <img src="Images/imagesProducts/<?=$sanpham->getHinhAnh()?>" width="100%"/>
            </div>
            <div class="col-md-7">
                <h2>Tên sản phẩm: <?=$sanpham->getTenSanPham();?></h2>
                <?php if($KhuyenMai!=null): ?>
                <label>Giá:<?= number_format($sanpham->getGiaBan(),0,',','.') ?> VND</label><h4>Giảm còn: <?= number_format($GiaSauGiam,0,',','.')?></h4>
                <?php else:?>
                    <h4>Giá:<?= number_format($sanpham->getGiaBan(),0,',','.') ?> VND</h4>
                <?php endif;?>
                <i>Lượt mua: <?=$sanpham->getLuotMua();?></i>
                
                
                <p>Mô tả sản phẩm: <?=$sanpham->getMoTa();?></p>
            </div>
        </div>
        <div class="row">
            <form method="post" enctype="multipart/form-data" action="XULY_FORMThemGioHang.php?id=<?=$sanpham->maSanPham?>">

            <script>
                
                function updateParagraph(selectElement) {
                    let selectedOption = selectElement.options[selectElement.selectedIndex];
                    let paragraphElement = document.getElementById("id_paragraph");
                    if (paragraphElement) {
                        paragraphElement.innerHTML = selectedOption.getAttribute("name");
                    }
                }
            </script>
            <table class="table table-light" style="width:90%; margin-left: 5%;">
                    <thead>
                        <td style="width: 40%;" class="boeder_table"></td>
                        <td style="width: 30%;" class="boeder_table">Chi tiết</td>
                        <td style="width: 30%;" class="boeder_table">Giá(VNĐ)</td>
                    </thead>
                    <tr>
                        
                        <td class="boeder_table">Size</td>
                        <td class="boeder_table">
                            <select name="selectElement" id="select_Size" style="width: 100%;" onchange="updateParagraph(this);">
                                <?php foreach($ListSize as $size):?>
                                    <option value="<?=$size->MaSize?>" name="<?=$size->Gia?>"><?= $size->TenSize ?></option>
                                <?php endforeach;?>
                            </select>
                        </td>
                        <td class="boeder_table" id="id_paragraph">7000</td>
                    </tr>
                    <tr>
                        <td class="boeder_table">Lượng đường</td>
                        <td class="boeder_table">
                            <select name="luongduong" style="width: 100%;">
                                <option value="ít đường"> ít đường (0 đ)</option>
                                <option value="vừa đủ"> vừa đủ (0 đ)</option>
                                <option value="nhiều đường"> nhiều đường (0 đ)</option>
                            </select>
                        </td>
                        <td class="boeder_table">0</td>
                    </tr>
                    <tr>
                        <td class="boeder_table">Lượng đá</td>
                        <td class="boeder_table">
                            <select name="luongda" style="width: 100%;">
                                <option value="ít đá"> ít đá (0 đ)</option>
                                <option value="vừa đủ"> vừa đủ (0 đ)</option>
                                <option value="nhiều đá"> nhiều đá (0 đ)</option>
                            </select>
                        </td>
                        <td class="boeder_table">0</td>
                    </tr>
                </table>
                


                <table class="table table-light" style="width:90%; margin-left: 5%;">
                <thead>
                    <td style="width: 30%;">Topping</td>
                    <td style="width:30%;">Giá</td>
                    <td></td>
                </thead>
                <?php foreach($ListTopping as $topping):?>
                    <tr>
                        <td>
                            <img src="Images/imagesProducts/<?=$topping->getHinhAnh()?>" width="20%"/><br/>
                            <?=$topping->getTenTopping()?>    
                        </td>
                        <td><?=$topping->getGia()?></td>
                        <td><input type="checkbox" name="<?=$topping->getMaTopping()?>" value="<?=$topping->getMaTopping()?>"/>Thêm</td>
                    </tr>
                <?php endforeach;?>
            </table>
            <table class="table table-light" style="width:90%; margin-left: 5%;">
                <tr >
                    <td  style="width: 40%;text-align: center; padding-top:17px;">
                        <label for="soluong">Số lượng: </label><input type="number" name="soluong" style="width: 40%;" value="1"/>
                    </td>
                    <td style="width: 60%; background-color: #ff0000;text-align: center;">
                        <input type="submit" name="themvaogiohang" style="border: none;" class="btnDatMua" value="Thêm vào giỏ hàng"/></td>
                </tr>
            </table>
            </form>
        </div>
        
    </div>
    <div class="col-md-3 " style="background-color: bisque; margin-top: 0; height:540px">
    <h2 class="w-100 fw-bold" style="color:#6f6e6e;"> Sản phẩm mua nhiều</h2><hr/>
        <?php foreach($ListProductOutStanding as $product):?>
            <a href="ChiTietSanPham.php?id=<?=$product->getMaSanPham()?>" class="a_">
                <div class="row">
                    <div class="col-md-4"><img src="Images/imagesProducts/<?=$product->getHinhAnh()?>" width="90%"/></div>
                    <div class="col-md-8">
                        <div class="row"><h5><?=$product->getTenSanPham()?></h5></div>
                        <div class="row"><p>lượt  mua:<?=$product->getLuotMua()?> - <span>giá:<?=$product->getGiaBan()?></span></p></div>
                        
                    </div>
                </div>
            </a>
            <hr/>
        <?php endforeach;?>
    </div>
    
</div>
<div class="row">
    <h2 class="w-100 fw-bold" style="color:#6f6e6e;"> Sản phẩm tương tự</h2><hr/>
    <?php
    if($listProductSameCategory!=null):
        foreach($listProductSameCategory as $value):?>
        <div class="col-md-3 justify-content-center align-items-center mt-2 mb-3">
            <div class="card card_">
                <img src="Images/imagesProducts/<?=$value->getHinhAnh()?>" class="img_card">
                <div class="card-body">
                    <h5 class="card-title"><?= $value->getTenSanPham()?></h5>
                    <h6><?= number_format($value->getGiaBan(),0,',','.') ?> VND 
                        <?php if($value->getTrangThai()==0): ?>
                            <span>Hết hàng</span>
                        <?php endif;?>
                    </h6>
                </div>
                <?php if($value->getTrangThai()!=0): ?>
                    <div class="showMore"><a href="ChiTietSanPham.php?id=<?=$value->getMaSanPham()?>">Mua ngay</a></div>
                <?php endif;?>
                
            </div> 
        </div>

    <?php
    endforeach;
else:?>
<p>vonguyenduytan</p>
<?php
    endif;
    ?>
</div>
<div class="row">
    <h2 class="w-100 fw-bold" style="color:#6f6e6e;">Nhận xét</h2><hr/>
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-3">
                <?php if(isset($_SESSION['KhachHang'])):$KhachHang=$_SESSION['KhachHang'];?>
                <img src="Images/imagesProducts/<?=$KhachHang->AnhDaiDien?>" width=65%/>
                <h5><?=$KhachHang->TenNguoiDung?></h5>
                <?php else:?>
                    <p>Đăng nhập để thêm nhận xét về sản phẩm</p>
                <?php endif;?>
            </div>
            <div class="col-md-9">
                
            <form method="post" enctype="multipart/form-data" action="XULY_FORMThemGioHang.php?id=<?=$sanpham->maSanPham?>">
                <h3>Nhận xét của bạn?</h3>
                <div class="row">
                    <div class="col-md-3">
                        <h5 style="font-weight: bold;padding-top: 13%;">Đánh giá sản phẩm:</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="stars">
                            <input type="radio" class="star star-5" id="star-5" name="star" value="5"/>
                            <label class="star star-5 fas" for="star-5"></label>
                            <input type="radio" class="star star-4" id="star-4"name="star" value="4"/>
                            <label class="star star-4" for="star-4"></label>
                            <input type="radio" class="star star-3" id="star-3" name="star" value="3"/>
                            <label class="star star-3" for="star-3"></label>
                            <input type="radio" class="star star-2" id="star-2" name="star" value="2"/>
                            <label class="star star-2" for="star-2"></label>
                            <input type="radio" class="star star-1" id="star-1" name="star" value="1"/>
                            <label class="star star-1" for="star-1"></label>
                        </div>
                    </div>
                </div>
                
                
                <textarea style="width: 100%;" name="NhanXet"></textarea>
                <input type="submit" name="ThemNhanXet" class="btn btn-primary" style="float:right " value="Thêm nhận xét" />
            </form>
            </div>
        </div>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-3">
                
            </div>
            <div class="col-md-9" style="background-color: #ff0000;">
                <div class="row">
                    <div class="col-md-6">
                    <h4 style="padding-top: 5%; color: #fff700;">Đánh giá <?= $sanpham->tenSanPham ?></h4></div>
                    <div class="col-md-6">
                        <div class="star_">
                        <label class="star_"></label>
                        <label class="star_ "></label>
                        <label class="star_ "></label>
                        <label class="star_"></label>
                        <label class="star_ "></label>
                    </div>
                    </div>
                </div>
            </div> 
        </div>
        <br/>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9">
                <div class="row">
                    <?php if($ListCommnet!=null):?>
                <?php foreach($ListCommnet as $cmItem):?>
                    <div class="row">
                        <div class="col-md-4"><h4><?=$cmItem->TenNguoiDung?></h4></div>
                        <div class="col-md-8">
                            <p><?=$cmItem->NoiDung?></p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="star_">
                                        <?php for($i=0;$i<$cmItem->DanhGia;$i++): ?>
                                            <label class="star_"></label>
                                        <?php endfor;?>
                                    </div>
                                    <p><?= $cmItem->NgayDang?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><?= $cmItem->NgayDang?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
                <?php else:?>
                <h4>Sản phẩm chưa có đánh giá.</h4>
            <?php endif; ?>
                </div>
            </div> 
        </div>
        
    </div>
</div>


<?php require("footer.php");?>