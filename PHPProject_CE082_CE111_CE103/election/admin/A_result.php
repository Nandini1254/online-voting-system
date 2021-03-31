<?php
session_start();
include '../partials/db_connection.php';  
$status='';
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
            <div class="col-md-9">
                <div class="contanier result">
                    <center>
                        <h1>Result</h1>
                    </center>
                    <?php
            $sql="SELECT * FROM `election_vote`";
              $resultelection=$conn->query($sql); 
              echo '<div class="row">';
              echo '<div class="col-md-4 head">
                          <h3>Election</h3>
                    </div>
                    <div class="col-md-4 head">
                          <h3>Candidate</h3>
                    </div>
                    <div class="col-md-4 head">
                          <h3>Status</h3>
                    </div>';
              while($row=$resultelection->fetch(PDO::FETCH_ASSOC))
              {
                $result_voting=array();
                $election_id=$row['eid'];
                // echo var_dump($row).'<br>';
                    $name=$row["name"];
                    echo '<div class="col-md-4">
                          <h5>'.$row['name'].'</h5>
                    </div>';
                   
                    echo '<div class="col-md-4">';
                    
                    if(time()<strtotime($row['start_date']))
                    {
                       echo "voting will be start soon<br>";
                    }
                    else if((time()>strtotime($row['end_date'])))
                    {
                        $sql_candidates="SELECT * FROM `elector` WHERE `election`='$name'";
                        $result_query=$conn->query($sql_candidates);
                        while($row_candiate=$result_query->fetch(PDO::FETCH_ASSOC))
                        {
                          $id=$row_candiate['id'];
                          $sqltest="SELECT COUNT(*) As count,`c_id` FROM `voting` WHERE c_id=$id";
                          $result=$conn->query($sqltest);
                          $rowtest=$result->fetch(PDO::FETCH_ASSOC);
                          $c_id=$rowtest['c_id'];
                          $result_voting[$c_id]=$rowtest['count'];
                        }
                        arsort($result_voting);
                        $winner_id=array_keys($result_voting)[0];
                        $sql_candidates="SELECT * FROM `elector` WHERE `id`='$winner_id'";
                        $fetch=$conn->query($sql_candidates);
                        $data=$fetch->fetch(PDO::FETCH_ASSOC);
                       
                        $check_result="SELECT * FROM `result` WHERE `election_id`='$election_id'";
                        $r=$conn->query($check_result);
                        $row_check=$r->rowCount();
                        if(!$row_check)
                        {
                          $result_save="INSERT INTO `result` (`election_id`, `candidate_id`) VALUES ('$election_id', '$winner_id')";
                          $result_done=$conn->query($result_save);
                        }
                        if($data['elector_name'])
                        {
                          echo $data['elector_name'];
                        }
                       else
                        {
                           echo "no vote";
                       }
                       $status="closed";
                    }
                    else
                    {
                       $sql_candidates="SELECT * FROM `elector` WHERE `election`='$name'";
                       $result_query=$conn->query($sql_candidates);
                       while($row_candiate=$result_query->fetch(PDO::FETCH_ASSOC))
                       {
                          $id=$row_candiate['id'];
                          $sqltest="SELECT COUNT(*) As count,`c_id` FROM `voting` WHERE c_id=$id";
                          $result=$conn->query($sqltest);
                          $rowtest=$result->fetch(PDO::FETCH_ASSOC);
                          $c_id=$rowtest['c_id'];
                          $result_voting[$c_id]=$rowtest['count'];
                       }
                       arsort($result_voting);
                      $winner_id=array_keys($result_voting)[0];
                      $sql_candidates="SELECT * FROM `elector` WHERE `id`='$winner_id'";
                      $fetch=$conn->query($sql_candidates);
                      $data=$fetch->fetch(PDO::FETCH_ASSOC);
                      if($data['elector_name'])
                      {
                        echo $data['elector_name'];
                      }
                      else
                      {
                        echo "no vote";
                      }
                     $status="Open";
                    }
          
                    echo '</div>
                    <div class="col-md-4">'.$status.'</div>';
                  
              }
              echo '</div>';
?>

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