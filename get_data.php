<?php
include("crud.php");
$database=new Database();
$result = $database->read();
echo json_encode($result);

?>