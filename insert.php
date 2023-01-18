<?php
	include 'crud.php';
    $database=new Database();

    if(isset($_GET['edit']))
    {
        $id = $_GET['id'];
        $result = $database->read($id);
        $a=$result[0]['hobi'];
        $b=explode(",",$a);
        $gender=$result[0]['Gender'];
        $male_status = 'unchecked';
        $female_status = 'unchecked';
        if ($gender == 'Male') {
            $male_status = 'checked';
        }
        else if ($gender == 'Female') {
            $female_status = 'checked';
        }
    
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <!-- JQUERY PLUGIN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

</head>
<style>
label.error {
    color: red;
}
</style>
<script>
$(document).ready(function() {


    $.validator.methods.email = function(value, element) {
        return this.optional(element) || /^[A-Za-z0-9_]+\@[A-Za-z0-9_]+\.[A-Za-z0-9_]+/.test(value);
    }

    $.validator.methods.fname = function(value, element) {
        return this.optional(element) || /^[a-zA-Z]+$/.test(value);
    }


    $.validator.methods.lname = function(value, element) {
        return this.optional(element) || /^[a-zA-Z]+$/.test(value);
    }


    $("#myform").validate({
        rules: {
            fname: {
                required: true,
                fname: true,
            },
            lname: {
                required: true,
                lname: true,
            },
            gender: {
                required: true,
            },
            email: {
                required: true,
                email: true,

            },
            bdate: {
                required: true,
            },
            dept: {
                required: true,
            },
            'test[]' :{
                required: true,
            },
            image:{
                required: true,
            },
         

        },
        messages: {
            email: {
                required: 'You must enter a email',
                email: 'Please enter a valid email without spacial chars, ie, Example@gmail.com'
            },

            fname: {
                required: 'You must enter a email',
                fname: 'Please enter a valid First Name'
            },
            lname: {
                required: 'You must enter a email',
                lname: 'Please enter a valid Last Name'
            },
            'test[]' :{

                required: 'You must Select the checkbox',
            },
            image: {
                required: 'please Select the Image',
        
            },
        },
        submitHandler: function(form) {
            var x = document.getElementById("saveButton").value;
            if (x == "Save") {


                var form_data = new FormData(document.getElementById("myform"));
                $.ajax({
                    data: form_data,
                    url: "inserts.php", //php page URL where we post this data to save in database
                    type: 'POST',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function(msg) {

                        if (msg == true) {
                            window.location.href = "index.php";
                        }

                    },
                    error: function(data, errorThrown) {
                        console.log(errorThrown);
                    }
                });
            } else {
                var form_data = new FormData(document.getElementById("myform"));
                $.ajax({
                    data: form_data,
                    url: "update_info.php", //php page URL where we post this data to save in database
                    type: 'POST',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function(result) {

                        if (result == true) {
                            window.location.href = "index.php";
                        }

                    },
                    error: function(data, errorThrown) {
                        console.log(errorThrown);
                    }
                });
            }
        }
    });


});
</script>
<style>
span {
    color: red;
}

.card-registration .select-input.form-control[readonly]:not([disabled]) {
    font-size: 1rem;
    line-height: 2.15;
    padding-left: .75em;
    padding-right: .75em;
}

.card-registration .select-arrow {
    top: 13px;
}

</style>
<script>


function remove() {

    document.getElementById("fname").value = "";
    document.getElementById("lname").value = "";
    document.getElementById("email").value = "";
    document.getElementById("bdate").value = "";
    document.getElementById("dept").value = "";
    document.getElementById("image").value = "";

}
</script>

<body>


    <section class="h-100 bg-dark">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-6 d-none d-xl-block">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img4.webp"
                                    alt="Sample photo" class="img-fluid"
                                    style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                            </div>
                            <div class="col-xl-6">

                                <form method="POST" name="myform" id="myform"
                                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                                    enctype="multipart/form-data">

                                    <div class="card-body p-md-5 text-black">
                                        <h3 class="mb-5 text-uppercase">Student registration form</h3>
                                        <input type="hidden" name="u_id" class="form-control"
                                            value="<?php echo isset($id)? $id:null; ?>">

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">

                                                    <input type="text" name="fname" class="form-control "
                                                        value="<?php echo isset($result[0]['FirstName'])? $result[0]['FirstName']:null; ?>"
                                                        id="fname" placeholder="Enter your FirstName"
                                                        oninput="this.value = this.value.toUpperCase()">


                                                </div>
                                                <span id="ferror"></span>

                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <input type="text" name="lname" class="form-control" id="lname"
                                                        value="<?php echo isset($result[0]['LastName'])?$result[0]['LastName']:null; ?>"
                                                        placeholder="Enter your LastName"
                                                        oninput="this.value = this.value.toUpperCase()">


                                                </div>
                                                <span id="lerror"></span>
                                            </div>
                                        </div>




                                        <div class="d-md-flex justify-content-start align-items-center mb-2 py-2">
                                            <h6 class="mb-0 me-4">Gender: </h6>

                                            <div class="form-check form-check-inline mb-0 me-4">
                                                <input class="form-check-input" type="radio" name="gender" id="gender1"
                                                    value="Male" <?php echo $male_status; ?> />
                                                <label class="form-check-label" for="gender1">Male</label>
                                            </div>

                                            <div class="form-check form-check-inline mb-0 me-4">
                                                <input class="form-check-input" type="radio" name="gender" id="gender2"
                                                    value="Female" <?php echo $female_status; ?> />
                                                <label class="form-check-label" for="gender2">Female</label>
                                            </div>

                                        </div>
                                        <label id="gender-error" class="error" for="gender"></label>


                                        <div class="form-outline mb-4">
                                            <input type="email" name="email" class="form-control"
                                                value="<?php echo isset($result[0]['Email'])?$result[0]['Email']:null; ?>"
                                                id="email" placeholder="Enter your Email-Address"
                                                oninput="this.value = this.value.toUpperCase()">



                                        </div>



                                        <div class="form-outline mb-4">
                                            <input type="Date" name="bdate"
                                                value="<?php echo isset($result[0]['Birthdate'])?$result[0]['Birthdate']:null; ?>"
                                                class="form-control" id="bdate" placeholder="Enter your Birthdate"
                                                oninput="this.value = this.value.toUpperCase()">

                                            <span id="berror"> </span>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">

                                                <select name="dept" class="browser-default custom-select" id="dept">
                                                    <option
                                                        value="<?php echo isset($result[0]['DeptName'])?$result[0]['DeptName']:null; ?>">
                                                        <?php echo isset($result[0]['DeptName'])?$result[0]['DeptName']:"Pleace Select the Department"; ?>
                                                    </option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="HR">HR</option>
                                                    <option value="admin">admin</option>
                                                    <option value="Marketing">Marketing</option>
                                                    <option value="Planning">Planning</option>
                                                    <option value="sales">sales</option>
                                                </select>

                                                <span id="derror"></span>
                                            </div>

                                        </div>
              
                                        <div class="form-outline mb-4">
                                        <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="dance" value="dance" name="test[]"
                                                <?php 
                                                    if (in_array("dance", $b)) {
                                                        echo "checked";
                                                    }
                                                    ?>
                                                    >
                                                <label class="form-check-label" for="inlineCheckbox1">Dance</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="cricket" value="cricket" name="test[]"
                                                <?php 
                                                    if (in_array("cricket", $b)) {
                                                        echo "checked";
                                                    }
                                                    ?>
                                                    >
                                                <label class="form-check-label" for="inlineCheckbox2">Cricket</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="football" value="football" name="test[]"
                                                <?php 
                                                    if (in_array("football", $b)) {
                                                        echo "checked";
                                                    }
                                                    ?>
                                                    >
                                                <label class="form-check-label" for="inlineCheckbox1">Football</label> 
                                                <input type="hidden" name="checkbox" value="<?php echo $a; ?>"> 
                                         </div>
                                         <label id="test[]-error" class="error" for="test[]"></label>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <input type="File" name="image" id="image"
                                                oninput="this.value = this.value.toUpperCase()"
                                                onChange={this.uploadFile}>
                                            <?php
                                           if(isset($result[0]['Image']))
                                            {
                                                echo $result[0]['Image'];
                                              }
                                               ?>

                                            <input type="hidden" name="imageval" value="<?php echo $result[0]['Image']; ?>
                                         
                                        </div>




                                        <div class="d-flex justify-content-end pt-3">
                                            <input type="button" class="btn btn-light btn-lg" onclick="remove();"
                                                value="Reset all">

                                            <input type="submit" name="submit" id="saveButton"
                                                class="btn btn-warning btn-lg ms-2"
                                                value="<?php if(isset($_GET['edit'])) echo 'Update'; else echo 'Save'; ?>">



                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</body>



</html>