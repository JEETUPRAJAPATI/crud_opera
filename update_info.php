<?php

include("crud.php");
$database=new Database();
$id=$_POST['u_id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$birthdate = $_POST['bdate'];
$deptname = $_POST['dept'];
$hobi=$_POST['test'];


$checkbox=$_POST['checkbox'];
$checkbox=explode(",",$checkbox);
$result=array_diff($hobi,$checkbox);


$and=array_diff($checkbox,$hobi);
$img= trim($_FILES["image"]["name"]);
if($img)
{
    $filename = str_replace(' ', '_', $img);

    $tempname=$_FILES['image']['tmp_name'];

    $folder = "images/".$filename;

        move_uploaded_file($tempname, $folder);

    }
else
{
    $filename=$_POST['imageval'];

}
if($result)
{
    $hobi_val=implode(',',$result);
  
    $result = $database->insert($fname, $lname, $gender, $email, $birthdate, $deptname, $fileName,$hobi_val,$id);
}
else
{
    if($and)
    {   
        $result = $database->delete_hobi($and,$id);
    }
    else
    {
        $result = $database->update($fname, $lname, $gender, $email, $birthdate,$deptname,$filename, $id); 
    }
   
}

if($result)
    {
        echo json_encode($result);

}
    else{
        echo "not sucess";
}
