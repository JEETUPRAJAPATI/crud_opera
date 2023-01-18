
<?php
class Database
{
    public $connection;
 

    public function connection_db()
    {
        $this->connection = mysqli_connect("localhost", "sbi", "sbi", "crud");
        if (mysqli_connect_error()) {
            echo "Error:", mysqli_connect_error();
        }
    }

    public function read($id = null)
    {
        $this->connection_db();

        $sql = "SELECT register.id,register.FirstName,register.LastName,register.Gender,register.Email,register.Birthdate,register.DeptName,register.Image,GROUP_CONCAT(hobi.hobi) AS 'hobi' FROM register  inner join `hobi` on id=r_id GROUP BY (hobi.r_id)";
    
        if ($id) {
            $sql = "SELECT register.FirstName,register.LastName,register.Gender,register.Email,register.Birthdate,register.DeptName,register.Image,GROUP_CONCAT(hobi.hobi) AS 'hobi' FROM register  inner join `hobi` on register.id=hobi.r_id GROUP BY (hobi.r_id) HAVING hobi.r_id=$id";
        }
    
        $result = mysqli_query($this->connection, $sql);
      
        $array_data=array();
        while($res=mysqli_fetch_array($result))
        {

            
             $extra = array(
                    'id' => $res['id'],
                   'FirstName' => $res['FirstName'],
                   'LastName' => $res['LastName'],
                   'Gender' => $res['Gender'],
                   'Email' => $res['Email'],
                   'Birthdate'=> $res['Birthdate'],
                    'DeptName'=> $res['DeptName'],
                    'Image'=> '<img src="images/'. $res["Image"].'" width="100" height="100">',
                    'hobi' => $res['hobi'], 
                    'edit'=>'<a href="insert.php?edit=edit&id='.$res["id"].'" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="px-2 text-primary"><i class="bx bx-pencil font-size-18"></i></a>',
                    'delete'=>'<a href="delete.php?edit=edit&id='.$res["id"].'" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="px-2 text-danger"><i class="bx bx-trash-alt font-size-18"></i></a>',
            );
            $array_data[] = $extra;
          
           
        }
 
    
        return $array_data;

    }
    public function insert($fname, $lname, $gender, $email, $birthdate, $deptname, $filename,$hobi_val,$id=null)
    {

        $this->connection_db();
     
        if(isset($id))
        {
            $hobi=explode(',',$hobi_val);
            foreach ($hobi as $hob)
            {
            
                $sql="INSERT INTO `hobi`(`r_id`, `hobi`) VALUES ($id,'$hob')";
                $result = mysqli_query($this->connection, $sql);
            }
      
        } 
        else
        {
         
            $sql = "INSERT INTO register(FirstName, LastName, Gender, Email, Birthdate, DeptName, `Image`)
            VALUES('$fname', '$lname', '$gender', '$email', '$birthdate', '$deptname', '$filename')";
            $result = mysqli_query($this->connection, $sql);
            $last_id = $this->connection->insert_id;
                $hobi=explode(',',$hobi_val);
                foreach ($hobi as $hob)
                {
                
                    $sql="INSERT INTO `hobi`(`r_id`, `hobi`) VALUES ($last_id,'$hob')";
                    $res = mysqli_query($this->connection, $sql);
                }

        }
        
        if ($result)
         {
            return true;
        } else {
            return false;
        }
    }

    public function update($fname, $lname, $gender, $email, $birthdate, $deptname, $image, $id)
    {
      
        $this->connection_db();

        $sql = "UPDATE register set FirstName = '$fname', LastName='$lname', Gender='$gender', Email='$email', Birthdate='$birthdate', DeptName= '$deptname' ,`image`='$image' where id = $id";
      
        $result = mysqli_query($this->connection, $sql);

        if ($result) {
        
     
            return true;
        } else {
            return false;
        }
    }
    public function delete($id)
    {
        $this->connection_db();
       
        $sql = "DELETE from `hobi` where r_id=$id";
        $result = mysqli_query($this->connection, $sql);
        $sql = "DELETE from `register` where id=$id";
        $result = mysqli_query($this->connection, $sql);


        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function delete_hobi($info,$id)
    {
        $this->connection_db();
         foreach ($info as $hob)
            {
              
                $sql = "DELETE FROM `hobi` WHERE hobi.r_id=$id AND hobi.hobi='$hob';";
                $result = mysqli_query($this->connection, $sql);
            }
     
     
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function search($data =null)
    {
            $this->connection_db();
            if(isset($data))
            {
                        
                $sql="select * from `register` where(FirstName like '%$data%'  or 	LastName like '%$data%'  or Gender like '%$data%') limit 5 ";
                    
                $result=mysqli_query($this->connection,$sql);
          
            }
            else
            {
                $sql="select * from `register`";
        
                $result=mysqli_query($this->connection,$sql);
          
           
            }

            if(mysqli_num_rows($result) > 0)
          {
        $output = "";
        $no = 1;
        while ($res = mysqli_fetch_array($result)) {
        
            $image = $res['Image'];

    
        $output .= '

        <tr>
            <th scope="row" class="ps-4">
                <div class="form-check font-size-16"><input type="checkbox" class="form-check-input" id="contacusercheck1" /><label class="form-check-label" for="contacusercheck1"></label></div>
            </th>

                <td scope="row"><?php echo $no; ?></th>
                <td><img src="images/'.$image.'" class="avatar-sm rounded-circle me-2" ><a href="#" class="badge badge-soft-success mb-0" style="font-size:15px;">
                '.$res["FirstName"] ." " . $res["LastName"].'</a></td>

                
                <td>'.$res["Gender"].'</td>
                <td>'.$res["Email"].'</td>
                <td>'.$res["Birthdate"].'</td>
                <td>'.$res["DeptName"].'</td>
                
                
            </tr>
        ';
        }
        echo $output;
        }
        else
        {
        echo 'Data Not Found';
        }
?>
  
<?php
    }
 




}

?>

