<?php
require("header.php");
//$kh=new NguoiDung();
//$kh=unserialize($_SESSION['KhachHang']);
if(!isset($_SESSION['KhachHang']))
{
    //header('location: index.php');
    exit();
}

$kh=$_SESSION['KhachHang'];
//var_dump($kh);

$ListSize=Size::getAll();

//lay danh sach  gio hang
$gioHang=GioHang::getAll($kh->MaNguoiDung);
//tao mang luong duong va luong da;
$ArrayLoaiDuong=["ít đường","vừa đủ","nhiều đường"];
$ArrayLoaiDa=["ít đá","vừa đủ","nhiều đá"];

//lay danh sua cua hang;
$danhSachCuaHang=ChiNhanh::getAll();
$TOTAL=0;


if(isset($_GET['action']))
{
    $action=$_GET['action'];
    if($action=="delete" && isset($_GET['matopping']) && isset($_GET['id']))
    {
        $maTopping_=$_GET['matopping'];
        $id_GioHang=$_GET['id'];
        $kq=ChiTietToppingGioHang::XoaToppingKhoiSanPham($id_GioHang,$maTopping_);
        if($kq<=0)
        {
            echo '<script type="text/javascript">
                                window.onload = function () { alert("Xóa topping thất bại."); }
                    </script>';
        }
    }
    else if($action=="remove" && isset($_GET['id']))
    {
        $id_GioHang=$_GET['id'];
        $kq=ChiTietToppingGioHang::XoaHetToppingKhoiSanPham($id_GioHang);
        $kq=GioHang::XoaMotSanPhamKhoiGioHang($id_GioHang);
        if($kq<=0)
        {
            echo '<script type="text/javascript">
                                window.onload = function () { alert("Xóa sản phẩm thất bại."); }
                    </script>';
        }
        else
        {
            $gioHang=GioHang::getAll($kh->MaNguoiDung);
        }
        
    }
    
}


?>

<div class="row d-flex justify-content-center ">
     
    <div class="col-md-9 bg_table_white" >
        <h3 class="w-100 fw-bold" style="color:#6f6e6e;"> <b>Giỏ hàng ❭❭</b> </h3>
        <?php
        if($gioHang!=null):
        foreach($gioHang as $g):?>
            <hr/>
            <form method="post" enctype="multipart/form-data" action="XULY_FORM.php">
                <div class="row">
                    <div class="col-md-4">
                    <img src="Images/imagesProducts/<?=$g->HinhAnh ?>" width="90%" />
                    <b style="margin-left: 4%;"><?= $g->TenSanPham?> - <label><b style="color: #ff0000;">
                    <?=number_format($g->GiaBan,0,',','.')?> VNĐ</b></label></b>

                    <input type="hidden" name="ID_SP1" value="<?=$g->Id?>"/>
                    <br/>
                    <div class="row">
                        <table class="table table-light" style="width:90%; margin-left: 5%;">
                            <tr >
                                 <td class="boeder_table" style="width: 30%; background-color: #f6ff00;text-align: center;  padding-top: 5%;">
                                    <input class="btnThemGioHang" style="border: none;" type="submit" name="sua" value="Sửa"/>
                                </td>
                                <td class="boeder_table"  style="width: 40%;text-align: center; padding-top:17px;">
                                    <label for="soluong">Số lượng: </label>
                                    <input type="number" name="soluong" style="width: 40%;" value="<?= $g->SoLuong?>"/>
                                </td>
                                <td class="boeder_table" style="width: 30%; background-color: #ff0000;text-align: center; padding-top: 8%;">
                                    <a href="ViewGioHang.php?action=remove&id=<?=$g->Id?>" class="btnDatMua" >Xóa</a>
                                </td>
                            </tr>
                        </table>
                        <div class="col-md-3">

                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <table style="width: 100%;">
                        <thead>
                            <td style="width: 40%; padding-left: 3%;" class="boeder_table"></td>
                            <td style="width: 70%; padding-left: 3%;" class="boeder_table" colspan="2">Chi tiết</td>
                        </thead>
                        <tr>
                            
                            <td class="boeder_table" style="padding-left: 3%;">Size</td>
                            <td class="boeder_table" style="padding-left: 3%;">
                                <select name="size" style="width: 100%;">
                                <?php foreach($ListSize as $size):?>
                                    <?php if($size->MaSize==$g->MaSize):?>
                                        <option value="<?=$size->MaSize?>" name="<?=$size->Gia?>">
                                        <?= $size->TenSize."- Giá: ".number_format($size->Gia,0,",",".")?></option>
                                    <?php endif;?> 
                                <?php endforeach;?>
                                <?php foreach($ListSize as $size):?>
                                    <?php if($size->MaSize!=$g->MaSize):?>
                                        <option value="<?=$size->MaSize?>" name="<?=$size->Gia?>">
                                        <?= $size->TenSize." - Giá: ".$size->Gia?></option>
                                    <?php endif;?> 
                                <?php endforeach;?>
                                </select>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="boeder_table" style="padding-left: 3%;">Lượng đường</td>
                            <td class="boeder_table" style="padding-left: 3%;">
                                <select name="luongduong" style="width: 100%;">
                                    <?php foreach($ArrayLoaiDuong as $duong):?>
                                        <?php if($duong==$g->LuongDuong):?>
                                            <option value="<?= $g->LuongDuong?>"> <?= $g->LuongDuong."- Giá: 0"?> </option>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                    <?php foreach($ArrayLoaiDuong as $duong):?>
                                        <?php if($duong!=$g->LuongDuong):?>
                                            <option value="<?= $duong?>"> <?= $duong."- Giá: 0"?> </option>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="boeder_table" style="padding-left: 3%;">Lượng đá</td>
                            <td class="boeder_table" style="padding-left: 3%;">
                                <select name="luongda" style="width: 100%;">
                                            <?php foreach($ArrayLoaiDa as $da):?>
                                        <?php if($da==$g->LuongDa):?>
                                            <option value="<?= $g->LuongDa?>"> <?= $g->LuongDa."- Giá: 0"?> </option>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                    <?php foreach($ArrayLoaiDa as $da):?>
                                        <?php if($da!=$g->LuongDa):?>
                                            <option value="<?= $da?>"> <?= $da?> </option>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </select>
                            </td>
                        </tr>

                    </table>
                    <table style="width: 100%;">
                        <thead>
                            <td style="width: 40%; padding-left: 3%;" class="boeder_table"></td>
                            <td style="width: 30%; padding-left: 3%;" class="boeder_table">Chi tiết</td>
                            <td style="width: 30%; padding-left: 3%;" class="boeder_table">Giá (VNĐ)</td>
                        </thead>
                    
                        <?php $listTopping=ChiTietToppingGioHang::getAll($g->Id);$TongTienTopping=0;
                        if($listTopping!=null):
                            foreach($listTopping as $toppingItem):$TongTienTopping+=$toppingItem->Topping->Gia;?>
                            <tr>
                                <td class="boeder_table" style="padding-left: 3%;"><img src="Images/imagesProducts/<?=$toppingItem->Topping->getHinhAnh()?>" width="40%"/></td>  
                                <td class="boeder_table" style="padding-left: 3%;"><?=$toppingItem->Topping->getTenTopping()?></td>
                                <td class="boeder_table" style="padding-left: 3%;">
                                    <?= number_format($toppingItem->Topping->getGia(),0,',','.')?>
                                    <a href="ViewGioHang.php?action=delete&matopping=<?=$toppingItem->Topping->MaTopping?>&id=<?= $toppingItem->id?>"  
                                    style="margin-left: 40%;">
                                    <img src="Images/delete.png" width="25%" /></a>
                                </td>  
                            </tr>
                            <?php endforeach;endif;?>
                            <tr>
                                <td class="boeder_table" style="padding-left: 3%;">Tổng giá sản phẩm:</td>
                                <td class="boeder_table" style="padding-left: 3%;" colspan="2" >
                                <?php
                                    $GiaSize=0;
                                    $KhuyenMaiSanPham=0;
                                    $KhuyenMai=KhuyenMai::getOneByIdProduct($g->MaSanPham);
                                    foreach($ListSize as $s)
                                    {
                                        if($s->MaSize==$g->MaSize)
                                        {
                                            $GiaSize=$s->Gia;
                                        }
                                    }
                                    if($KhuyenMai!=null)
                                    {
                                        $KhuyenMaiSanPham=$KhuyenMai->ChiTiet;
                                        $TongTienSanPham=($TongTienTopping+($g->GiaBan-($g->GiaBan*$KhuyenMaiSanPham/100))+$GiaSize)*$g->SoLuong;
                                        $TOTAL+=$TongTienSanPham;
                                        echo number_format($TongTienSanPham,0,',','.')."VNĐ      -Khuyến mãi: ".$KhuyenMai->NoiDung;
                                    }
                                    else
                                    {
                                        $TongTienSanPham=($TongTienTopping+$g->GiaBan+$GiaSize)*$g->SoLuong;$TOTAL+=$TongTienSanPham;
                                        echo number_format($TongTienSanPham,0,',','.')."VNĐ";
                                    }
                                    
                                ?>
                                
                                </td>
                            </tr>
                    </table>
                </div>
                </div>
            </form>
            
        <?php endforeach;endif; ?>
        <div class="row bg_layout_gradient_red" style="padding: 1%;">
            <form method="post" enctype="multipart/form-data" action="XULY_FORM.php">
                <div class="row">
                    <div class="col-md-2    ">
                        <h5><b>Chọn nơi nhận: </b></h5>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="chinhanh_" name="chinhanh_" /><br/>
                    </div>
            </div>
                <div class="row">
                    <div class="col-md-3"><h1 style="color: aliceblue;"><b>Tổng tiền:</b></h1></div>
                    <div class="col-md-4"><h1 style="color: aliceblue;"><b><?= number_format($TOTAL,0,',','.')  ?> VNĐ</b></h1></div>
                    <div class="col-md-5">
                        <input name="MaNguoiDung" type="hidden" value="<?= $kh->MaNguoiDung?>" />
                        <input name="TOTAL" type="hidden" value="<?= $TOTAL?>" />
                        <?php if($gioHang!=null): ?>
                            <input class="btnThanhToan" name="dathang" type="submit" value="Đặt hàng"/>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
       
    </div>
</div>

<?php






require"footer.php";
?>