<?php
session_start();
$check=true;
$pass='';
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include '../partials/db_connection.php';      
    $exists=false;
    $check=true;
    // echo true;
    $VOTER_NAME=$_POST["username"];
    if(!isset($_POST["username"]))
       $exists=true;                     
    if(!isset($_POST["password"]))
       $exists=true;
    $EMAIL=$_POST["email"];
    $PASS=$_POST["password"];
    $CPASS=$_POST["cpassword"];
    $mobileno=$_POST['mobileno'];
    $sqltest="SELECT * FROM `voter` WHERE `voter_email`='$EMAIL'";
    $testres=$conn->query($sqltest);
    $row=$testres->fetch();
    if($row)
    {
        $check=false;
    }
    else
    {  
        if(($PASS==$CPASS) && $exists==false)
        {
            $hash=password_hash($PASS, PASSWORD_BCRYPT);
          $sql="INSERT INTO `voter` (`voter_name`, `voter_email`, `voter_password`, `voter_mobile`) VALUES (?,?,?,?);";   
            $result= $conn->prepare($sql);
             $result->bindParam(1,$VOTER_NAME,PDO::PARAM_STR);
             $result->bindParam(2,$EMAIL, PDO::PARAM_STR);
             $result->bindParam(3,$hash,PDO::PARAM_STR); 
             $result->bindParam(4,$mobileno,PDO::PARAM_STR);
             $result->execute();
             header("location:V_login.php");
            
    
    }
    else{
       $pass="Must enter same password";
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
      if(!$check)
      {
          echo 
          '<div class="alert alert-warning alert-dismissible fade show" role="alert">
             <strong><h1>This email/Username is already registered for this election</h1></strong> 
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>';
      }
      if($pass)
      {
        echo 
        '<div class="alert alert-warning alert-dismissible fade show" role="alert">
           <strong><h1>'.$pass.'</h1></strong> 
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
  
      }
      ?>
      
     <div class="formclass">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="register">
                <h1>Registration</h1>
                <br>
            </div>
            <div class="form-row">
              <div class="form-group ">
                <label for="uname">User Name</label>
                <input type="text" class="form-control" name="username" id="uname"  pattern="(?=.[a-z])(?=.*[A-Z]).{4,256}"  required title="4 to 256 characters and ateast uppercase letter" placeholder="Enter username name">
              </div>
              <div class="form-group ">
                <label for="cemail">Email</label>
                <input type="email" class="form-control" name="email" id="cemail" placeholder="Enter email id">
              </div>
            </div>
                <div class="form-group">
                  <label for="mobileno">Mobileno</label>
                  <input type="text" class="form-control" id="mobileno" name="mobileno"  pattern="^\d{10}$" title="please enter number properly"  placeholder="Enter Mobile No">
                </div>
            <div class="form-row">
                <div class="form-group ">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password"  name="password" required  placeholder="Enter Password"  
                            pattern="(?=.*\d)(?=.*[@#$])(?=.*[a-z])(?=.*[A-Z]).{8,256}"
                            title="Password must have atleast 8 characters including 1 uppercase letter, 1 lowercase letter and numeric characters">
                  </div>
                <div class="form-group ">
                  <label for="cpassword">Confirm Password</label>
                  <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Enter confirm Password">
                </div>
              </div>
            <div class="buttons text-center">
                <button type="submit" class="btn btn-primary">sign UP</button>
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
