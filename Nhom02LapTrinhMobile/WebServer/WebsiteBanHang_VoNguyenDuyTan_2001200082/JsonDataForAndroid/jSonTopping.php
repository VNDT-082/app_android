<?php
require("..//Model/Connection.php");
$sql="select*from topping";
$connection=new Connection();
$resultData=$connection->SelectAll($sql);
echo json_encode($resultData);
?>