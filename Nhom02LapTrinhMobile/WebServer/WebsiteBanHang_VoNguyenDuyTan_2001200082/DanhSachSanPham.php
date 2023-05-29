<?php 
require("header.php");

    $listProductAll=SanPham::LayTatCa();
    $tongsanpham=0;
    foreach($listProductAll as $product)
    {
        $tongsanpham++;
    }
    $SoTrang=floor($tongsanpham/6);
    $SanPhamConLoai=$tongsanpham%6;
    $page=0;
    if(isset($_GET['page']))
    {
        $page=$_GET['page'];
        
    }
    if(!isset($_GET['page']))
    {
        $page=0;
        
    }
    if($page==0)
    {
        $listProduct = SanPham::getLimit(0,6);
    }
    else if($page!= null && $page<=$SoTrang)
    {
        $page=$page*6;
        $listProduct = SanPham::getLimit($page,6);
    }
    else if($page>$TrangDu)
    {
        $page=$page*6;
        $listProduct = SanPham::getLimit($page,$SanPhamConLoai);
    }
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
        <div class="row">
            <?php for($i=1;$i<=$SoTrang+1;$i++):?>
                <a href="DanhSachSanPham.php?page=<?=$i-1?>" style="font-size: 16px;color: #fff;font-weight: bold;
                background-color: #076e01;padding: 2%;text-decoration: none;float:left;display: inline;
                width: 8%;margin: 1%; border-radius: 10%; text-align: center;">Trang<?= $i?></a>
            <?php endfor;?>
        </div>

    </div>
    
    
</div>

<?php require("footer.php")?>