<?php
session_start();
$msg='';
include '../partials/db_connection.php'; 
if(!isset($_SESSION['admin_email']))
{
    header("location:A_login.php?logdden=not");
}
$id=$_REQUEST['id'];
$sql="SELECT * FROM `admin` WHERE `id`=$id";
$result=$conn->query($sql);
$row=$result=$result->fetch(PDO::FETCH_ASSOC);
if($row)
{
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        if($_POST['name'])
        {       
            $name=$_POST['name'];
            $id=$_POST['id'];
            $sql="SELECT * FROM `admin` WHERE `name`='$name' AND  `id`!=$id";
            $result=$conn->query($sql);
            $row=$result=$result->fetch(PDO::FETCH_ASSOC);
            if($row)
            {
                $msg="Already username exist";
                $color="warning";
              
                
            }
            else{
               
               
                $sql="UPDATE `admin` SET `name` = '$name' WHERE `admin`.`id` = $id;";
                $result=$conn->query($sql);
                if($result)
                {
                    $color="success";
                    $msg="successfully changed";
                    
                }
            }
        }
        if($_POST['email'])
        {
            $email=$_POST['email'];
            $id=$_POST['id'];
            $sql="SELECT * FROM `admin` WHERE `email`='$email' AND  `id`!=$id";
            $result=$conn->query($sql);
            $row=$result=$result->fetch(PDO::FETCH_ASSOC);
            if($row)
            {
                $msg="Already email id exist";
                $color="warning";
              
            }
            else{
                
                $sql="UPDATE `admin` SET `email` = '$email' WHERE `admin`.`id` = $id;";
                $result=$conn->query($sql);
                if($result)
                {
                    $color="success";
                    $msg="successfully changed";
                   
                }
            }
        }
        if($_POST['mobileno'])
        {
                $mobile=$_POST['mobileno'];
                $sql="UPDATE `admin` SET `mobile` = '$mobile' WHERE `admin`.`id` = $id;";
                $result=$conn->query($sql);
                if($result)
                {
                    $color="success";
                    $msg="successfully changed";
                 
                }
            
        }
    
        $sql="SELECT * FROM `admin` WHERE `id`=$id";
        $result=$conn->query($sql);
        $row=$result=$result->fetch(PDO::FETCH_ASSOC);
    }   


}
else
{
    $color="warning";
    $msg="record is not exist";
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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link type="text/css" rel="stylesheet" href="../cssfolder/A_file.css">
    <title>home_page</title>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <?php
          include_once('A_menu.php');
        ?>

            <div class="col-md-10">
                <div class="heading_home">
                    <h1>Profile</h1>
                    <?php if($msg)  

                        echo '<div class="alert alert-'.$color.' alert-dismissible fade show" role="alert">
                        <center>
                            '.$msg.'
                        </center>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';

                    ?>
                </div>
                <div>


                </div>
                <div class="contanier-main-admin  ">
                <?php
                    
                ?>

                    <div class="formclass">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"
                            enctype="multipart/form-data">
                            <input type="hidden" name="id" value='<?php echo $row['id']; ?>'>
                            <div class="form-group ">
                                <label for="uname">User Name</label>
                                <input type="text" class="form-control" name="name" id="uname"
                                    placeholder="<?php echo $row['name']; ?>" value="<?php echo $row['name'];?>">
                            </div>
                            <br>
                            <div class="form-group ">
                                <label for="cemail">Email</label>
                                <input type="email" class="form-control" name="email" id="cemail"
                                    placeholder="<?php echo $row['email']; ?>" value="<?php echo $row['email'];?>">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="mobileno">Mobileno</label>
                                <input type="text" class="form-control" id="mobileno" name="mobileno" pattern="^\d{10}$"
                                    title="please enter number" placeholder="<?php echo $row['mobile'];?>"
                                    value="<?php echo $row['mobile'];?>">
                            </div>
                            <br>

                            <br>
                            <div class="buttons">
                                <br>
                                <center> <button type="submit" class="btn btn-success">Update</button></center>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
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
    -->
</body>

</html>