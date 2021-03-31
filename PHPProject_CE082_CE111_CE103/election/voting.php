<?php
session_start();
// connection database
include 'partials/db_connection.php'; 
$msg='';
//check authentication'
if(!isset($_SESSION['v_id']))
{
    header("location:voter/V_login.php?logdden=not");
}


$check='';
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $id=$_POST['eid'];
    // echo $id;
    $sql="SELECT * FROM `election_vote` WHERE `eid`='$id'";
    $result=$conn->query($sql); 
    $row=$result->fetch(PDO::FETCH_ASSOC);
    
    if(time()>strtotime($row['start_date']) && time()<strtotime($row['end_date']))
    {
        $id=$_POST['eid'];
        $sql="SELECT * FROM `election_vote` WHERE `eid`=$id";
        // for fatching elecion name
        $result=$conn->query($sql); 
        $row_eletion=$result->fetch(PDO::FETCH_ASSOC);
        $election=$row_eletion['name'];
        // echo $election;
        // for fetching elector_name 
        $elector_NAME=$_POST['candidate'];
        $sqltest="SELECT * FROM `elector` WHERE  `elector_name`='$elector_NAME'  AND `election`='$election'";
        // echo var_dump($sqltest);
        $result=$conn->query($sqltest);
        $row=$result->fetch(PDO::FETCH_ASSOC);
        $candidate_id=$row['id'];
        // echo $candidate_id;
    

        //voter
        $voter_id=$_SESSION['v_id'];

        //for saving vote 
        $find_check="SELECT * FROM `voting` WHERE v_id='$voter_id' AND E_id='$id'";
        $result_check=$conn->query($find_check);
        $row_check=$result_check->rowCount();
        // echo $row;
        if($row_check)
        {
            $msg="Already voted";
        }
        else{

            
            // echo $candidate_id;
            $vote=$row['vote']+1;

                $sql_vote="UPDATE `elector` SET `vote` = '$vote' WHERE `elector`.`id` = '$candidate_id'";
                $voted=$conn->query($sql_vote);

                $sql_insert="INSERT INTO `voting` (`v_id`, `E_id`, `c_id`) VALUES ('$voter_id','$id','$candidate_id')";
                $sql_voted_final=$conn->query($sql_insert);

                if($sql_voted_final)
                {
                    $msg="Your voted counted";
                }

        }

      
    }
    else{
        // echo "yes";
        // echo $row['end_date'];
        $d=date_format(new DateTime($row['start_date']),"d/m");
        // echo $d;
        $msg="Wait, voting line is closed, voting will start at ".$d;
      
        
    }
    $sql="SELECT * FROM `election_vote` WHERE `eid`= '$id'";
    $result=$conn->query($sql);
}
else{

    $id=$_REQUEST['id'];
    $sql="SELECT * FROM `election_vote` WHERE `eid`= '$id'";
    $result=$conn->query($sql);

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
    <link rel="stylesheet" href="cssfolder/homestyle.css">
    <title>voteelection</title>
    <style>
        .vote{
            color:black;
        }
    

    </style>
</head>

<body>
<?php
        include('partials/_nav.php');
        if($msg)
        {
            echo 
                '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><h4>'.$msg.'</h4></strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
         ?>
    <div class="container vote mb-10">
        
    
    <div class="row">
        <?php

        //    if voting is not start
       
         
           
      while($row=$result->fetch(PDO::FETCH_ASSOC))
      {     
          $id=$row['eid'];
          echo '
          <div class="card mt-5" style="width: 36rem; margin:auto">
              <div class="card-body">
                  <h5 class="card-title">Name: '.$row['name'].'</h5 <p class="card-text">Description:
                  '.$row['description'].'</p>
                  <p>start: '.$row['start_date'].'
                  <p>End: '.$row['end_date'].'                    
          </div>';
         $election=$row['name'];
         //  this for candiate showing
         $sql_candidate="SELECT * FROM `elector` WHERE `election`='$election'";
         $result_candidate=$conn->query($sql_candidate);
         $check=$result_candidate->rowCount();
         if(!$check)
         {
                 echo "<h6><center>As now you can't vote</center></h6>";
         }
         echo '<div class="row">';
         $sql_candidate="SELECT * FROM `elector` WHERE `election`='$election'";
         $result_candidate=$conn->query($sql_candidate);
         while($row1=$result_candidate->fetch(PDO::FETCH_ASSOC))
         {
             $logo=substr($row1['elector_logo'],3);
            //  echo $logo;
             echo '<div class="row logo m-2">
                    <div class="col-md-6">
                         <img src="'.$logo.'" alt="..." width="50px">
                    </div>
                    <div class="col-md-6">
                    '.$row1['elector_name'].'
                    </div>
                 
             </div>';
            
           
         }
        echo "<br>
        </div>";
         ?>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <select name="candidate" id="candidate" class="form-control">
                <?php
                         $result_candidate=$conn->query($sql_candidate);
                         if($check)
                         {
                            while($row1=$result_candidate->fetch(PDO::FETCH_ASSOC))
                            {
                                echo '<option  class="form-control">'.$row1['elector_name'].'</option>';
                            }
                         }
                       
                } 
                ?>
            </select>
            <br>
           
            <input type="hidden" name="id" value='<?php echo $id; ?>'>
            <input type="hidden" name="eid" value='<?php echo $id; ?>'>
            <?php
             if($check)
             {
                echo '<input type="submit" class="btn btn-success" id="submit" value="vote">';
             }
            ?>
            <a href="vote.php" class="btn btn-secondary">Back</a>
        </form>

<div class="col-md-6">

</div>
<div class="col-md-6">

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