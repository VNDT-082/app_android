<?php
require("..//Model/Connection.php");
require("..//Model/LoaiSanPham.php");
$connection=new Connection();
$stringSelect="SELECT * FROM loaisanpham";
$result_data=$connection->SelectAll($stringSelect);
$loaiSP=new LoaiSanPham();
$result_ArrayList=$loaiSP->getAll($result_data);
$json=json_encode($result_data);
echo $json;

?>