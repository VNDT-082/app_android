<?php
require("..//Model/Connection.php");
$sql="SELECT * FROM size ;";
$connection=new Connection();
$result_data=$connection->SelectAll($sql);
echo json_encode($result_data);
?>
