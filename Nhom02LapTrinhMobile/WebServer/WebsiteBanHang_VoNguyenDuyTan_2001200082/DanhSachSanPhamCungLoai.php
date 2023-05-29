<?php 
require("header.php");
    $id=0;
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
    }
    $listProduct=SanPham::getAllProductSameCategory($id);
?>

<br/>
<div class="row"><h2 class="w-100 fw-bold" style="color:#6f6e6e;">DANH SÁCH SẢN PHẨM</h2><hr/></div>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-9">

    <div class="row">
        <?php foreach($listProduct as $value): ?>
            <div class="col-md-4 justify-content-center align-items-center mt-2 mb-3">
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
                        <div class="showMore"><a href="ChiTietSanPham.php?id=<?=$value->getMaSanPham()?>">Xem chi tiết</a></div>
                    <?php endif;?>
                   
                </div> 
            </div>
        <?php endforeach; ?>
    </div>

    </div>
    <div class="col-md-2 "></div>
    
</div>

<?php require("footer.php")?>