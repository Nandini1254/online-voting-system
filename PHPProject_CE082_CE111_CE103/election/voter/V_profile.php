<?php
include '../partials/db_connection.php'; 
session_start();
$check='';
$success='';
if(!isset($_SESSION['v_id']))
{
    header("location:voter/V_login.php?logdden=not");
}

$id=$_SESSION['v_id'];


if($_SERVER["REQUEST_METHOD"] == "POST")
{
        
    if($_POST['username'])
    {
        $name=$_POST['username'];
        $sql_check="SELECT * FROM `voter` WHERE  `voter_name` = '$name' AND `id` != '$id'";
        $r=$conn->query($sql_check);
        $row_r=$r->rowCount();
        if($row_r)
        {
            $check='Username is already registered please try something different name';
        }
        else
        {
            $sql_update="UPDATE `voter` SET `voter_name` = ? WHERE `voter`.`id` = $id ";
            $r= $conn->prepare($sql_update);
            $r->bindParam(1,$name,PDO::PARAM_STR);
            $r->execute();
            $success="Successfully changed data";
        }
    }
    if($_POST['email'])
    {
        $name=$_POST['email'];
        $sql_check="SELECT * FROM `voter` WHERE `voter_email`='$name' AND `id`!='$id'";
        $r=$conn->query($sql_check);
        $row_r=$r->rowCount();
        if($row_r)
        {
            $check=$check.' Email is already registered please try something different name';
        }
        else
        {
            $sql_update="UPDATE `voter` SET `voter_email` = ? WHERE `voter`.`id` = $id";
            $r= $conn->prepare($sql_update);
            $r->bindParam(1,$name,PDO::PARAM_STR);
            $r->execute();
            $success="Successfully changed data";
        }
    }
    if($_POST['mobileno'])
    {
            $name=$_POST['mobileno'];
            $sql_update="UPDATE `voter` SET `voter_mobile` = ? WHERE `voter`.`id` = $id";
            $r= $conn->prepare($sql_update);
            $r->bindParam(1,$name,PDO::PARAM_STR);
            $r->execute();
            $success="Successfully changed data";
      
    }       


}

$sql="SELECT * FROM `voter` WHERE `id`='$id'";
$result=$conn->query($sql);
$row=$result->fetch(PDO::FETCH_ASSOC);
    
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../cssfolder/homestyle.css">
    <title>register</title>
   
  </head>
  <body>
  <?php
        include('../partials/_nav.php');
  ?>
  <div class="container">
  <?php
      if($check)
      {
          echo 
          '<div class="alert alert-warning alert-dismissible fade show" role="alert">
             <strong>'.$check.'</strong> 
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>';
      }
      else if($success)
      {
        echo 
        '<div class="alert alert-success alert-dismissible fade show" role="alert">
           <strong>'.$success.'</strong> 
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
  
      }
      ?>
      
     <div class="formclass">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="register">
                <center><h4>Update</h4></center>
                <br>
            </div>
            <div class="form-row">
              <div class="form-group ">
                <label for="uname">User Name</label>
                <input type="text" class="form-control" name="username" id="uname" value="<?php echo $row['voter_name'] ?>"  pattern="(?=.[a-z])(?=.*[A-Z]).{4,256}"  title="4 to 256 characters and ateast uppercase letter" placeholder="Enter username name">
              </div>
              <div class="form-group ">
                <label for="cemail">Email</label>
                <input type="email" class="form-control" name="email" id="cemail" value="<?php echo $row['voter_email'] ?>"  placeholder="Enter email id">
              </div>
            </div>
                <div class="form-group">
                  <label for="mobileno">Mobileno</label>
                  <input type="text" class="form-control" id="mobileno" name="mobileno"  value="<?php echo $row['voter_mobile'] ?>" pattern="^\d{10}$" title="please enter number properly"  placeholder="Enter Mobile No">
                </div>
            <div class="buttons text-center">
                <button type="submit" class="btn btn-primary">update</button>
            </div>
          </form>       
    </div>  
</div> 
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>
