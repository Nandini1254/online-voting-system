<?php
session_start();
include '../partials/db_connection.php';  
$msg='';
$ID=$_REQUEST['id'];
$sql="SELECT * FROM `election_vote` WHERE `eid`='$ID'";
$result=$conn->query($sql);
$row=$result->fetch(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD']=='POST')
{
    if($_POST['desc'])
    {
        $sqlupdate="UPDATE `election_vote` SET `description` = ? WHERE `election_vote`.`eid` = '$ID'";
        $result= $conn->prepare($sqlupdate);
        $result->bindParam(1,$_POST['desc'],PDO::PARAM_STR);
        $result->execute();
    }
    if($_POST['sdate'] && !$_POST['edate'] && !$_POST['lastdate'])
    {
        $date=$_POST['sdate'];
        if($date>$row['end_date'] || $date<$row['reg_last_date'])
        {
            $msg="Enter valid date";
        }
        else{
            $sqlupdate="UPDATE `election_vote` SET `start_date` = ? WHERE `election_vote`.`eid` = '$ID'";
        $result= $conn->prepare($sqlupdate);
        $result->bindParam(1,$_POST['sdate'],PDO::PARAM_STR);
        $result->execute();
        }
    }
    if($_POST['edate'] && !$_POST['sdate'] && !$_POST['lastdate'])
    {
        $date=$_POST['edate'];
        if($date<$row['start_date'])
        {
            $msg="Enter valid date";
        }
        else{
            $sqlupdate="UPDATE `election_vote` SET `end_date` = ? WHERE `election_vote`.`eid` = '$ID'";
        $result= $conn->prepare($sqlupdate);
        $result->bindParam(1,$_POST['edate'],PDO::PARAM_STR);
        $result->execute();
        }
    }
    if($_POST['lastdate'] && !$_POST['edate'] && !$_POST['sdate'])
    {
        $date=$_POST['lastdate'];
        if($date>$row['start_date'])
        {
            $msg="Enter valid date";
        }
        else{
            $sqlupdate="UPDATE `election_vote` SET `reg_last_date` = ? WHERE `election_vote`.`eid` = '$ID'";
        $result= $conn->prepare($sqlupdate);
        $result->bindParam(1,$_POST['lastdate'],PDO::PARAM_STR);
        $result->execute();
        }
    }
    else if($_POST['sdate'] && $_POST['edate'])
    {
                $sdate=$_POST['sdate'];
                $edate=$_POST['edate'];
                    if(strtotime($sdate)>strtotime($edate) || strtotime($sdate)<strtotime($row['reg_last_date']) )
                    {
                      $msg="Please enter valid date";
                    }
                    else{
                        $sqlupdate="UPDATE `election_vote` SET `start_date` = ?, `end_date`=? WHERE `election_vote`.`eid` = '$ID'";
                        $result= $conn->prepare($sqlupdate);
                        $result->bindParam(1,$_POST['sdate'],PDO::PARAM_STR);
                        $result->bindParam(2,$_POST['edate'],PDO::PARAM_STR);
                        $result->execute();
                    }
    }
    else if($_POST['lastdate'] && $_POST['edate'] )
    {
                $lastdate=$_POST['lastdate'];
                $edate=$_POST['edate'];
                    if(strtotime($lastdate)>strtotime($row['start_date']) || strtotime($edate)<strtotime($row['start_date']))
                    {
                      $msg="Please enter valid date";
                    }
                    else{
                        $sqlupdate="UPDATE `election_vote` SET `reg_last_date` = ?, `end_date`=? WHERE `election_vote`.`eid` = '$ID'";
                        $result= $conn->prepare($sqlupdate);
                        $result->bindParam(1,$_POST['lastdate'],PDO::PARAM_STR);
                        $result->bindParam(2,$_POST['edate'],PDO::PARAM_STR);
                        $result->execute();
                    }
    }
    else if($_POST['lastdate'] && $_POST['sdate'] )
    {
                $lastdate=$_POST['lastdate'];
                $sdate=$_POST['sdate'];
                    if(strtotime($lastdate)>strtotime($sdate) || strtotime($sdate)>strtotime($row['end_date']))
                    {
                      $msg="Please enter valid date";
                    }
                    else{
                        $sqlupdate="UPDATE `election_vote` SET `start_date` = ?, `reg_last_date` = ? WHERE `election_vote`.`eid` = '$ID'";
                        $result= $conn->prepare($sqlupdate);
                        $result->bindParam(1,$_POST['sdate'],PDO::PARAM_STR);
                        $result->bindParam(2,$_POST['lastdate'],PDO::PARAM_STR);
                        $result->execute();
                    }
    }
    else if($_POST['lastdate'] && $_POST['sdate'] && $_POST['edate'])
    {
        $sdate=$_POST['sdate'];
        $edate=$_POST['edate'];
        $lastdate=$_POST['lastdate'];
        if(strtotime($sdate)>strtotime($edate))
        {
           $msg="Please enter valid date";
        }
        if(strtotime($sdate)<strtotime($lastdate))
        {
           $msg="Please enter valid date";
        }
        else{
                        $sqlupdate="UPDATE `election_vote` SET `start_date` = ?, `end_date`=?,`reg_last_date`=?  WHERE `election_vote`.`eid` = '$ID'";
                        $result= $conn->prepare($sqlupdate);
                        $result->bindParam(1,$_POST['sdate'],PDO::PARAM_STR);
                        $result->bindParam(2,$_POST['edate'],PDO::PARAM_STR);
                        $result->bindParam(3,$_POST['lastdate'],PDO::PARAM_STR);
                        $result->execute();
            }
    }
   
    $sql="SELECT * FROM `election_vote` WHERE `eid`='$ID'";
    $result=$conn->query($sql);
    $row=$result->fetch(PDO::FETCH_ASSOC);
    
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
                    <div class="">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <div class="login">
                                <h1>Election: <?php echo $row['name'] ?></h1>
                                <hr>
                            </div>
                            <br>
                            <input type=hidden name="id" value="<?php echo $row['eid'] ?>">
                            <div class="form-group">
                                <label for="desc">Election desc</label>
                                <textarea name="desc" id="desc" class="form-control" rows="2"><?php echo $row['description'];?></textarea>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="sdate">Start Vote date</label>
                                <input type="date" class="form-control" name="sdate" id="sdate"
                                    placeholder="<?php echo $row['start_date'] ?>" requried>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="edate">End Vote date</label>
                                <input type="date" class="form-control" name="edate" id="sdate"
                                    placeholder="" requried>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="lastdate">End Register date</label>
                                <input type="date" class="form-control" name="lastdate" id="sdate"
                                    value=<?php $row['reg_last_date'] ?> requried>
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="submit" class="btn btn-warning" name="submit" id="submit" value="update"
                                    requried>
                                
                            </div>
                            <?php $row['reg_last_date'] ?>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-md-5">
                <div class="contanier-main m-10">
                    <center>
                        <h1 style="color:red">
                       <?php 
                        if($msg)
                        {
                            echo $msg;
                            $msg='';
                        }
                        ?>
                        </h1>
                    </center>
                    <div class="date">
                        Description: <?php echo $row['description']; ?></br>
                        Election Start date: <?php echo  $row['start_date'] ?><br>
                        Election End date: <?php echo $row['end_date'] ?><br>
                        Election registration last date: <?php echo $row['reg_last_date'] ?><br>
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