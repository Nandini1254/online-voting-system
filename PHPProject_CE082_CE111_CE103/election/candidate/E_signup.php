<?php
session_start();
$check=true;
$allow='';
$exists=false;

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include '../partials/db_connection.php';  
    if(isset($_POST['profilelogo']))
      $exists=true;
    $elector_NAME=$_POST["username"];
    $EMAIL=$_POST['email'];
    $PASS=$_POST["password"];
    $CPASS=$_POST["cpassword"];
    $mobileno=$_POST['mobileno'];
    $election=$_POST['election'];
    // echo $election;
    $sqltest="SELECT * FROM `elector` WHERE (`elector_email`='$EMAIL' OR `elector_name`='$elector_NAME' ) AND `election`='$election'";
    $result=$conn->query($sqltest);
    $row=$result->rowCount();
    // echo $row;
    if($row)
    {
        //  echo True;
        $check=false;
    }
    else
    {  
        if(($PASS==$CPASS) && $exists==false)
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
            echo $path;
            if(!in_array($ext,$allowed) ) 
            {
                $allow="Sorry, only JPG, JPEG, PNG & GIF  files are allowed.";
            }
            else{ 
                move_uploaded_file( $_FILES['profilelogo'] ['tmp_name'], $path);  
            $hash=password_hash($PASS, PASSWORD_BCRYPT);
             $sql="INSERT INTO `elector` (`elector_name`,`election`, `elector_email`, `elector_mobile`, `elector_password`, `elector_logo`) VALUES (?,?,?,?,?,?);";   
            $result= $conn->prepare($sql);
             $result->bindParam(1,$elector_NAME,PDO::PARAM_STR);
             $result->bindParam(2,$election, PDO::PARAM_STR);
             $result->bindParam(3,$EMAIL, PDO::PARAM_STR);      
             $result->bindParam(4,$mobileno,PDO::PARAM_STR); 
             $result->bindParam(5,$hash,PDO::PARAM_STR);
             $result->bindParam(6,$target_file,PDO::PARAM_STR);
             $result->execute();
             header("location:E_login.php");
            }
    
    }
    else{
        $allow="please enter same password";
    }
}
}  
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
    <title>register</title>

</head>

<body>
    <?php
        include('../partials/_nav.php');
  ?>
    <div class="container">
        <?php
      if(!$check)
      {
          echo 
          '<div class="alert alert-warning alert-dismissible fade show" role="alert">
             <strong><h1>This email/Username is already registered for this election</h1></strong> 
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
      ?>
        <div class="formclass">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"
                enctype="multipart/form-data">
                <div class="register">
                    <h1>Registration</h1>
                    <br>
                </div>

                <div class="form-group ">
                    <label for="uname">User Name</label>
                    <input type="text" class="form-control" name="username" pattern="(?=.[a-z])(?=.*[A-Z]).{4,256}"
                        title="4 to 256 characters and also contain atleast 1 uppecase letter" id="uname" placeholder="Enter Candidate name" required>
                </div>

                <div class="form-group ">
                    <label for="cemail">Email</label>
                    <input type="email" class="form-control" name="email" id="cemail" required
                        placeholder="Enter email id">
                </div>

                <div class="form-group">
                    <label for="mobileno">Mobileno</label>
                    <input type="text" class="form-control" id="mobileno" name="mobileno" required type="tel"
                        pattern="^\d{10}$"  title="please enter number properly" placeholder="Enter Mobile No">
                </div>
                <div class="form-group">
                    <label for="mobileno">Logo</label>
                    <input type="file" class="form-control" id="profilelogo" name="profilelogo">
                </div>
                <div class="form-group">
                    <label for="election">Election</label>
                    <select name="election" class="form-control" id="election" required>
                        <?php
                      $sql="SELECT * FROM `election_vote`";
                      $result=$conn->query($sql);
                      if($result)
                      {
                         $current=time();
                         while($row=$result->fetch(PDO::FETCH_ASSOC))
                         {
                           if($current<strtotime($row['reg_last_date']))
                               echo '<option>'.$row['name'].'</option>';
                         }
                      }
                  ?>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group ">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            pattern="(?=.*\d)(?=.*[@#$])(?=.*[a-z])(?=.*[A-Z]).{8,256}"
                            title="Password must have atleast 8 characters including 1 uppercase letter, 1 lowercase letter and numeric characters"
                            placeholder="Enter Password" required>
                    </div>
                    <div class="form-group ">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword"
                            placeholder="Enter confirm Password" required>
                    </div>
                </div>
                <div class="buttons text-center" >
                    <button type="submit" class="btn btn-primary">sign UP</button>
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