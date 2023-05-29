<?php
require("..//Model/Connection.php");
require("..//Model/KhuyenMai.php");
$DanhSachKhuyenMai=KhuyenMai::LayBaKhuyenMaiMoiNhat();
echo json_encode($DanhSachKhuyenMai);

?>