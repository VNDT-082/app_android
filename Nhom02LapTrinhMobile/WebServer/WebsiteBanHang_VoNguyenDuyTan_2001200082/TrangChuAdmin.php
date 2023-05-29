<?php require("LayoutMenuAdminHeader.php");

$DanhSachDonHang=DatHang::LayTatCa();
$DanhSachDonHangDaMuaTrongThang=DatHang::LayDonHangDaMuaTrongThangHT();
$DanhSachDonHangChoDuyet=DatHang::LayTatCaDonHangChoDuyet();
$DanhSachNhanXet=nhanXet::LayTatCa();
$SoLuongDonHangChoDuyet=0;
if($DanhSachDonHangChoDuyet!=null)
{
    foreach($DanhSachDonHangChoDuyet as $donhang)
    {
        $SoLuongDonHangChoDuyet++;
    }
}
$SoLuongNhanXet=0;
if($DanhSachNhanXet!=null)
{
    foreach($DanhSachNhanXet as $nhanxet)
    {
        $SoLuongNhanXet++;
    }
}
$DoanhThuCuaHang=0;
$DoanhThuThang=0;
if($DanhSachDonHang!=null)
{
    foreach($DanhSachDonHang as $donhang)
    {
        if($donhang->TrangThai==1)
        {
            $DoanhThuCuaHang+=$donhang->GiaGiamCon;
        }

    }
}
$DoanhThuThang=0;
if($DanhSachDonHangDaMuaTrongThang!=null)
{
    foreach($DanhSachDonHangDaMuaTrongThang as $donhang)
    {
        if($donhang->TrangThai==1)
        {
            $DoanhThuThang+=$donhang->GiaGiamCon;
        }
    }
}

?>

<div class="row">
    <div class="col-md-3" style="margin-right: 2%; height:1000px;">
        <div class="row theBoder">
            <div class="col-md-7">
                <h1><?=$SoLuongDonHangChoDuyet?></h1>
                <p>Đơn đặt</p><br/>
            </div>
             <div class="col-md-5">
                <img src="Images/cart.png" width="50%"/>
             </div>
        </div>
    </div>

    <div class="col-md-3" style="margin-right: 2%; margin-left:2%;">
        <div class="row theBoder">
            <div class="col-md-7">
                <h1><?= number_format($DoanhThuThang,0,",",".") ?></h1>
                <p>Doanh thu <label>(Tổng:<?= number_format($DoanhThuCuaHang,0,",",".") ?>VNĐ)</label></p>
            </div>
             <div class="col-md-5">
                <img src="Images/money.png" width="50%"/>
             </div>
        </div>
    </div>

    <div class="col-md-3" style="margin-left: 2%;">
        <div class="row theBoder">
            <div class="col-md-7">
                <h1><?= $SoLuongNhanXet ?></h1>
                <p>Nhận xét</p><br/>
            </div>
             <div class="col-md-5">
                <img src="Images/conversation.png" width="50%"/>
             </div>
        </div>
    </div>

</div>

<?php require("LayoutMenuAdminFooter.php")?>