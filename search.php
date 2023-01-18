<?php

include('crud.php');
$database = new Database();
$data=NULL;
if(isset($_POST['data']))
{
  
    $data=$_POST['data'];
    $database->search($data);
}
else
{
    
    $database->search();
}


?>