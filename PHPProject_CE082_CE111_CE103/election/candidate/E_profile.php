<?php
session_start();
$success='';
$error='';
$allow='';
include '../partials/db_connection.php';  
if(!isset($_SESSION['e_id']))
{
    header("location:E_login.php?logdden=not");
}
$check='';
$id=$_SESSION['e_id'];

$sql="SELECT * FROM `elector` WHERE  `id` = '$id'";
$r=$conn->query($sql);
$row=$r->fetch(PDO::FETCH_ASSOC);

if($_SERVER["REQUEST_METHOD"] == "POST")
{

   $image = $_FILES['profilelogo']['name'];
   if(isset($_POST["username"]))
   {
     
       $name=$_POST['username'];
       $sql_check="SELECT * FROM `elector` WHERE  `elector_name` = '$name' AND `id` != '$id'";
       $r=$conn->query($sql_check);
       $row_r=$r->rowCount();
       if($row_r)
       {
           $error='Username is already registered please try something different name';
       }
       else
       {
           $sql_update="UPDATE `elector` SET `elector_name` = ? WHERE `elector`.`id` = $id ";
           $r= $conn->prepare($sql_update);
           $r->bindParam(1,$name,PDO::PARAM_STR);
           $r->execute();
           $success="Successfully changed data";
       }
   }
   if(isset($_POST["email"]))
   {
       $name=$_POST['email'];
       $sql_check="SELECT * FROM `elector` WHERE `elector_email`='$name' AND `id`!='$id'";
       $r=$conn->query($sql_check);
       $row_r=$r->rowCount();
       if($row_r)
       {
           $check=$check.' Email is already registered please try something different name';
       }
       else
       {
           $sql_update="UPDATE `elector` SET `elector_email` = ? WHERE `elector`.`id` = $id";
           $r= $conn->prepare($sql_update);
           $r->bindParam(1,$name,PDO::PARAM_STR);
           $r->execute();
           $success="Successfully changed data";
       }
   }
   if(isset($_POST["mobileno"]))
   {
           $name=$_POST['mobileno'];
           $sql_update="UPDATE `elector` SET `elector_mobile` = ? WHERE `elector`.`id` = $id";
           $r= $conn->prepare($sql_update);
           $r->bindParam(1,$name,PDO::PARAM_STR);
           $r->execute();
           $success="Successfully changed data";
     
   } 
    if($image)
    {
        $image = $_FILES['profilelogo']['name']; 
        $folder ="../uploads/";  
       
        $target_file=$folder.basename($_FILES["profilelogo"]["name"]);
        $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
        $allowed=array('jpeg','png' ,'jpg'); 
        $filename=$_FILES['profilelogo']['name']; 
        $ext=pathinfo($filename, PATHINFO_EXTENSION); 
        $file=pathinfo($target_file,PATHINFO_FILENAME);
        // echo $file;
        $path = $folder . $file.date('s').date('i').'.'.$imageFileType ; 
        $target_file=$path;
        // echo $path;
        if(!in_array($ext,$allowed) ) 
        {
            $allow="Sorry, only JPG, JPEG, PNG & GIF  files are allowed.";
        }
        else{ 
            move_uploaded_file( $_FILES['profilelogo'] ['tmp_name'], $path); 
            $sql_update="UPDATE `elector` SET `elector_logo` = ? WHERE `elector`.`id` = $id;";
            $result= $conn->prepare($sql_update);
            $result->bindParam(1,$target_file,PDO::PARAM_STR);
            $result->execute();
            $success="Successfully changed.";
    }
        
            //  header("location:E_login.php");
 }
    
   
}

$sql="SELECT * FROM `elector` WHERE  `id` = '$id'";
$r=$conn->query($sql);
$row=$r->fetch(PDO::FETCH_ASSOC);

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../cssfolder/homestyle.css">
    <title>Profile</title>

</head>

<body>
    <?php
        include('../partials/_nav.php');
  ?>
    <div class="container">
        <?php
      if($error)
      {
          echo 
          '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            This email/Username is already registered for this election
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>';
      }
      if($allow)
      {
        echo 
        '<div class="alert alert-warning alert-dismissible fade show" role="alert">
           <strong><h1>Please Enter image file</h1></strong> 
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
          $allow=false;
      }
      if($success)
      {
          echo 
          '<div class="alert alert-success alert-dismissible fade show" role="alert">
             '.$success.'
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>';
      }
      ?>
        <div class="formclass">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"
                enctype="multipart/form-data">
                <div class="img text-center">
                  <img src="<?php echo $row['elector_logo'];  ?>" width="100" height="100"  style="border-radius:50%;" alt="...">
                </div>
                <div class="register text-center">
                    <h1><?php echo $row['elector_name']  ?></h1>
                </div>
                <div class="form-group ">
                
                    <label for="uname">User Name</label>
                    <input type="text" class="form-control" name="username" pattern="(?=.[a-z])(?=.*[A-Z]).{4,256}"
                        title="4 to 256 characters and also contain atleast 1 uppecase letter" id="uname"
                        value="<?php echo $row['elector_name']; ?>">
                </div>

                <div class="form-group ">
                    <label for="cemail">Email</label>
                    <input type="email" class="form-control" name="email" id="cemail" 
                        value="<?php echo $row['elector_email'];  ?>">
                </div>

                <div class="form-group">
                    <label for="mobileno">Mobileno</label>
                    <input type="text" class="form-control" id="mobileno" name="mobileno" pattern="^\d{10}$"
                        title="please enter number properly" value="<?php echo $row['elector_mobile'] ; ?>">
                </div>

                <div class="form-group">
                    <label for="mobileno">Logo</label>
                    <input type="file" class="form-control" id="profilelogo"   name="profilelogo">
                </div>


                <div class="buttons text-center">
                    <button type="submit" class="btn btn-primary" name="submit">update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
</body>

</html>