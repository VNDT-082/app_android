<?php
require("..//Model/Connection.php");

$id=0;
if(isset($_GET["id"]))
{
    $id=$_GET["id"];
}
$connection=new Connection();
$sql="SELECT chitiettoppinggiohang.ID,chitiettoppinggiohang.MaTopping, chitiettoppinggiohang.Gia, ".
"topping.TenTopping, topping.HinhAnh FROM chitiettoppinggiohang, topping WHERE ID=$id ".
"AND topping.MaTopping=chitiettoppinggiohang.MaTopping;";
$DanhSachTopping=$connection->SelectAll($sql);
echo json_encode($DanhSachTopping);
?>