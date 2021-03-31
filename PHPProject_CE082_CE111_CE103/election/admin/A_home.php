<?php
session_start();
include '../partials/db_connection.php'; 
if(!isset($_SESSION['admin_email']))
{
    header("location:A_login.php?logdden=not");
}
if($_SERVER['REQUEST_METHOD']=='GET')
{
    if(isset($_GET['delete']))
    {
        $id=$_GET['id'];
        $sql="DELETE FROM `admin` WHERE `admin`.`id` = '$id'";
        $result=$conn->query($sql);
        if($result)
        {
            $msg="Successfully deleted data";
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
                    <h1>Admin List</h1>
                </div>

                <div class="contanier-main-admin ">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">Update</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                     $sql="SELECT * FROM `admin`";
                                     $result=$conn->query($sql);   
                                //   echo var_dump($result);               
                                     if($result)
                                     {
                                        $id=0;
                                        while($row=$result->fetch(PDO::FETCH_ASSOC))
                                        {
                                            $id+=1;
                                            echo '<tr>
                                            <th scope="row">'.$id.'</th>
                                            <td>'.$row['name'].'</td>
                                            <td><a href="A_profile.php?id='.$row['id'].'" class="btn btn-warning">Update</a></td>
                                            <td><form action="" method="get">
                                            <input type="hidden" name="id"  value="'.$row['id'].'">
                                                 <input type="submit"  class="btn btn-danger" name="delete" value="Delete" >
                                            </form></td>
                                        </tr>';
                                         }
                                     }
                            ?>
                        </tbody>
                    </table>
                  
                    <a href="A_signup.php" class="btn btn-secondary">Add New Admin</a>

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