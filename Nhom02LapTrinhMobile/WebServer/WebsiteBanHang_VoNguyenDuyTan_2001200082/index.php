<?php
require("header.php");
   
    $listProduct=SanPham::LayDanhSachSanPhamMuaNhieu();
    $listCategory=LoaiSanPham::LayTatCaTruDefault();
    $DanhSachBonLoaiSanPham=LoaiSanPham::LayBonLoaiTruDefault();
    $ListKhuyenMai=KhuyenMai::LayBaKhuyenMaiMoiNhat();
   
?>

<!--cut page-->
<div class="row">
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php $KhuyenMaiMoiNhat=KhuyenMai::LayKhuyenMaiMoiNhat(); if($KhuyenMaiMoiNhat!=null && $ListKhuyenMai!=null):?>
                <div class="carousel-item active">
                    <img src="Images/imagesProducts/<?= $KhuyenMaiMoiNhat->HinhAnh?>" height=300 class="d-block w-100" alt="...">
                </div>
                <?php foreach($ListKhuyenMai as $Khm):if($Khm->HinhAnh!=$KhuyenMaiMoiNhat->HinhAnh):?>
                <div class="carousel-item">
                <img src="Images/imagesProducts/<?= $Khm->HinhAnh?>" height=300 class="d-block w-100" alt="...">
                </div>
                <?php endif; endforeach;?>
            
            <?php else:?>
                <div class="carousel-item active">
                <img src="Images/qc_h1.png" height=300 class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                <img src="Images/imagesProducts/BannerTraNguyenChat.jpg" height=300 class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                <img src="Images/qc_h1.png" height=300 class="d-block w-100" alt="...">
                </div>
            <?php endif;?>
            
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div> 
<br/>
<div class="row align-items-center"><h2 class="w-100 text-center fw-bold" style="color:#6f6e6e;">DANH MỤC SẢN PHẨM</h2><hr/></div>
<div class="row">
    <?php if($DanhSachBonLoaiSanPham!=null): foreach($DanhSachBonLoaiSanPham as $value): ?>
        <div class="col-md-3 justify-content-center align-items-center">
            <div class="card">
                <img src="Images/imagesProducts/<?= $value->getHinhAnh()?>" class="img_card">
                <div class="card-body">
                    <h5 class="card-title"><?= $value->getTenLoai()?></h5>
                </div>
                <div class="showMore"><a href="DanhSachSanPhamCungLoai.php?id=<?=$value->maLoai?>">Xem chi tiết</a></div>
            </div> 
            
        </div>
    <?php endforeach; endif;?>
</div>

<br/>
<div class="row align-items-center"><h2 class="w-100 text-center fw-bold" style="color:#6f6e6e;">SẢN PHẨM NỔI BẬC</h2><hr/></div>
<div class="row">
    <?php foreach($listProduct as $product): ?>
        <div class="col-md-3 justify-content-center align-items-center">
            <div class="card">
                <img src="Images/imagesProducts/<?=$product->hinhAnh?>" class="img_card">
                <div class="card-body">
                    <h5 class="card-title"><?=$product->tenSanPham?></h5>
                </div>
                <div class="showMore"><a href="ChiTietSanPham.php?id=<?=$product->maSanPham?>">Xem chi tiết</a></div>
            </div> 
            
        </div>
    <?php endforeach; ?>
    <a href="DanhSachSanPham.php">Xem tất cả</a>
</div>

<br/>
<div class="row align-items-center"><h2 class="w-100 text-center fw-bold" style="color:#6f6e6e;"></h2><hr/></div>
<div class="row">
    <div class="gioiThieu">
        <div class="gt_detail">
            <h1>VNDT_082</h1>
            <h6>Về chúng tôi</h6>
            <p>Bên cạnh những ly trà sữa ngon - sạch - tươi,
            chúng tôi luôn tự tin mang đến qui khách những trãi nghiệm 
            tốt nhất về dịch vụ và không gian.</p>
            <a href="#">Xem thêm</a>
        </div>
    </div>
    </div>
<?php require("footer.php");?>