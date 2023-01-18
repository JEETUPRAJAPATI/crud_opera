
<?php
	include 'crud.php';
	 $id = $_GET['id'];
    $database=new Database();
	$result = $database->delete($id);
	
	if($result)
        {
		echo "delete success";
		header('location:index.php');
	}
        else
        {
		echo "not delete";
	}
?>