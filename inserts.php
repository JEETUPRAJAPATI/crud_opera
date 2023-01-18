
<?php

include("crud.php");
$database = new Database();

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$birthdate = $_POST['bdate'];
$deptname = $_POST['dept'];
$filename = $_POST['image'];
$hobi=$_POST['test'];

$hobi_val=implode(',',$hobi);
//for image
$img = trim($_FILES["image"]["name"]);

$fileName = str_replace(' ', '_', $img);

$tempname = $_FILES["image"]['tmp_name'];

//$folder = "images/" . $img;
$folder = "images/" . $fileName;
move_uploaded_file($tempname, $folder);

$result = $database->insert($fname, $lname, $gender, $email, $birthdate, $deptname, $fileName,$hobi_val,$id);


if ($result) {


  echo json_encode($result);
} else {
  echo "not sucess";
}

?>