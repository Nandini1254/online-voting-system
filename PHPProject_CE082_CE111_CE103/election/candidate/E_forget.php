<?php
$error='';
if($_SERVER["REQUEST_METHOD"] == "POST")
{
      $login=false;
      require_once('../partials/db_connection.php');
            $email=$_POST["email"];
            $password=$_POST["password"];
            $cpassword=$_POST["cpassword"];
            if($password==$cpassword)
            {
                $sql="SELECT * FROM `elector` where `elector_email`=?";
                $q=$conn->prepare($sql);
                $q->execute(array($email));
                $row= $q->fetch(PDO::FETCH_ASSOC);
                if($row)
                {
                    $hash=password_hash($password, PASSWORD_BCRYPT);
                    $id=$row['id'];
                    $sql="UPDATE `elector` SET `elector_password` = '$hash' WHERE `elector`.`id` =  $id ";
                    $result=$conn->query($sql);
                    echo $password;
                    if($result)
                    {
                        header("location:E_login.php");
                    }
                }
                else
                {
                    $error="Email address mignt be wrong";
                }
            }
            // echo $email;
            else{
                     $error="password is not same";
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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="../cssfolder/homestyle.css">
    <title>Login</title>
  </head>
  <body>
  <?php
        include('../partials/_nav.php');
        if($error)
         {
             echo '<center><h1>'.$error.'</h1></center>';
        }
  ?>
     <div class="formclass">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
          <div class="login">
                  <center><h1>Reset Password</h1></center>
                  
                    <hr>
                </div>
                <div class="form-group m-2">
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                        placeholder="Email" required>
                </div>
                <div class="form-group m-2">
                    <input type="password" class="form-control" name="password" 
                    pattern="(?=.*\d)(?=.*[@#$])(?=.*[a-z])(?=.*[A-Z]).{8,256}"
                        title="Password must have atleast 8 characters including 1 uppercase letter, 1 lowercase letter and numeric characters"
                        id="password" placeholder="New Password"
                        requried>
                </div>
                <div class="form-group m-2">
                    <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="confirm Password"
                        requried>
                </div>
                <!-- <input type="submit" value="submit"> -->
                <div class="d-grid gap-2">
                    <input type="submit" value="Reset " class="btn btn-primary">
                </div>
                
            </form>
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