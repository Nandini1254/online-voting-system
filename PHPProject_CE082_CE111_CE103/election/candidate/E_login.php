<?php
$error='';
if($_SERVER["REQUEST_METHOD"] == "POST")
{
      $login=false;
      require_once('../partials/db_connection.php');
            $email=$_POST["email"];
            $password=$_POST["password"];
            // echo $email;
            $sql="SELECT * FROM `elector` where `elector_email`=?";
            $q=$conn->prepare($sql);
            $q->execute(array($email));
            $row= $q->fetch(PDO::FETCH_ASSOC);
            // echo print_r($row);
        if($row)
        {
           $hash =$row['elector_password'];
            if(password_verify($password,$hash))
            {
                echo "hi";
                session_start();
                $_SESSION['login']=true;
                $_SESSION['elector_email']=$email;
                $_SESSION['elector_name']=$row['elector_name'];
                $_SESSION['e_id']=$row['id'];
                echo $_SESSION['elector_name'];
                header("location: ../index.php");
            }
            else{
                $error="enter again details";
            }
        }
        else{
            $error="enter again details";
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
    <title>home_page</title>
     <style>

     </style>
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
                  <h1>Login</h1>
                  <hr>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email " required>
              </div>
              <br>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" requried>
              </div>  
              <br>        
             Forget Password? <a href="E_forget.php" class="forgot">Click here</a> <button type="submit" class="btn btn-success ">Log in</button> 
              <center></center>
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