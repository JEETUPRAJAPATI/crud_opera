<?php

include("crud.php");

$database = new Database(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	 <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./bootstrap-4.0.0-dist/js/bootstrap.min.js">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    
</head>
<style>
	img.avatar-sm.rounded-circle.me-2 {
    width: 56px;
    height: 56px;
}
</style>
<script type="text/javascript">

    $(document).ready(function(){

    $('#myTable').DataTable({
        ajax: {
            url: 'get_data.php',
            dataSrc: '',
        },
        columns: [
            { data : 'id'},
           { data: 'FirstName' },
           { data: 'LastName' },
           { data: 'Gender' },
           { data: 'Email' },
           { data: 'Birthdate' },
           { data: 'DeptName' },
          { data: 'hobi' }, 
           { data: 'Image' }, 
     
          {  data: 'edit'},
          {  data: 'delete'},
          
       
        ],

        
    });
 

    });
  
          
</script>
<body>

 
<div class="container" style="margin-top:30px;">
    <div class="row align-items-center">

    <div class="input-group mb-4">
        
  </button>
</div>
<div id="datatable"></div>
        <div class="col-md-6">
            <div class="mb-3">
                <h5 class="card-title">Contact List <span class="text-muted fw-normal ms-2">(<?php echo $res; ?>)</span></h5>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                
                <div>
                    <a href="insert.php" data-bs-toggle="modal" data-bs-target=".add-new" class="btn btn-primary"><i class="bx bx-plus me-1"></i> Add New</a>
                </div>
               
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="">
                <div class="table-responsive">
                    <table class="table project-list-table table-nowrap align-middle table-borderless" id="myTable">
                        <thead>
                            <tr>
                              
                            <th scope="col">id</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
								<th scope="col">Gender</th>
								<th scope="col">Email</th>
								<th scope="col">Birthdate</th>
                                <th scope="col">Department</th>
                                <th scope="col">hobi</th>
                                <th scope="col">Image</th>
                             
                                <th scope="col" style="width: 200px;">Action</th>
                                <th scope="col" style="width: 200px;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="result">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
   

</html>