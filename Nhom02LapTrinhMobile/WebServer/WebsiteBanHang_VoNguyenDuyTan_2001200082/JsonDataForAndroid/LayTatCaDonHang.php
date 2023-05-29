<?php
require("..//HomeController.php");
$ds=DatHang::LayTatCa();
if($ds!=null)
{
    echo json_encode($ds);
}
else
{
    echo json_encode(null);
}
?>