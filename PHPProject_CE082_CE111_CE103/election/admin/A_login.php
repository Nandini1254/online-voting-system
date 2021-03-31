<?php
$error='';
if($_SERVER["REQUEST_METHOD"] == "POST")
{
      $login=false;
      require_once('../partials/db_connection.php');
            $email=$_POST["email"];
            $password=$_POST["password"];
            $sql="SELECT * FROM `admin` WHERE `name`='$email' OR `email`='$email'";
            $q=$conn->prepare($sql);
            $q->execute(array($email));
            $row= $q->fetch(PDO::FETCH_ASSOC);
            // echo print_r($row);
        if($row)
        {
           $hash =$row['pass'];
            if(password_verify($password,$hash))
            {
                // echo "hi";
                session_start();
                $_SESSION['login']=true;
                $_SESSION['admin_email']=$email;
                $_SESSION['admin_name']=$row['name'];
                $_SESSION['admin_id']=$row['id'];
                // echo $_SESSION['login'];
                header("location: A_home.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../cssfolder/homestyle.css">
    <title>home_page</title>

</head>

<body>
    <?php
        include('../partials/_nav.php');
        if($error)
         {
             echo '<center><h1>'.$error.'</h1></center>';
        }
  ?>
    <div class="container login_page">
        <div class="formclass">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="login">
                  <center><h1>Login</h1></center>
                  
                    <hr>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                        placeholder="Email/Username" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                        requried>
                </div>
                <hr>
                <div class="link">
                    <a href="forget_password.php">Forget Your Password? </a>
                </div>
                <div class="d-grid gap-2">
                   <input type="submit" value="Login" class="btn btn-primary">
                </div>
            </form>
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
    -->
</body>

</html>