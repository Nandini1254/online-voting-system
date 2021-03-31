<?php
session_start();
$msg='';
if($_SERVER['REQUEST_METHOD']=='POST')
{
     include '../partials/db_connection.php';  
     $name=$_POST['name'];
     $desc=$_POST['desc'];
     $sdate=$_POST['sdate'];
     $edate=$_POST['edate'];
     $lastdate=$_POST['lastdate'];
     $sql='INSERT INTO `election_vote` (`name`, `description`, `start_date`, `end_date`, `reg_last_date`) VALUES (?,?,?,?,?);';
     $result= $conn->prepare($sql);
      if(strtotime($sdate)>strtotime($edate))
      {
         $msg="Please enter valid date";
      }
      if(strtotime($sdate)<strtotime($lastdate))
      {
         $msg="Please enter valid date";
      }
      if(!$msg)
      {
          
           $result->bindParam(1,$name,PDO::PARAM_STR);
           $result->bindParam(2,$desc, PDO::PARAM_STR);
           $result->bindParam(3,$sdate,PDO::PARAM_STR); 
           $result->bindParam(4,$edate,PDO::PARAM_STR);
           $result->bindParam(5,$lastdate,PDO::PARAM_STR);
           $result->execute();

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
    <link type="text/css" rel="stylesheet" href="../cssfolder/A_file.css">
    <title>addELETION</title>
  </head>
  <body>
 
     <div class="container-fluid">
        <div class="row">
        <?php
          include_once('A_menu.php');
        ?>
         <div class="col-md-5">
            <div class="contanier-main">
            <div class="formclass">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
              <div class="login">
                  <h1>Election</h1>
                  <hr>
              </div>
              <div class="form-group">
                <label for="name">Election name</label>
                <input type="text" class="form-control" name="name" id="name" required>
              </div>
              <br>
              <div class="form-group">
                <label for="desc">Election desc</label>
                <textarea name="desc" id="desc" class="form-control"  rows="2"></textarea>
              </div>
              <br>  
              <div class="form-group">
                <label for="sdate">Start Vote date</label>
                <input type="date" class="form-control" name="sdate" id="sdate"  requried>
              </div> 
              <br> 
              <div class="form-group">
                <label for="edate">End Vote date</label>
                <input type="date" class="form-control" name="edate" id="sdate" requried>
              </div>
              <br>
              <div class="form-group">
                <label for="lastdate">End Register date</label>
                <input type="date" class="form-control" name="lastdate" id="sdate"  requried>
              </div>  
              <br>        
              <div class="form-group">
                <input type="submit" class="btn btn-warning" name="submite" id="submit"  requried>
              </div>
  
            </form>
      </div>
    
         </div>
       </div>
       <div class="col-md-5">
            <div class="contanier-main m-10">
               <center><h1 style="color:red"><?php echo $msg ?></h1></center>
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