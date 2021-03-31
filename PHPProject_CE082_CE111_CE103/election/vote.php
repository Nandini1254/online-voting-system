<?php
session_start();
// connection database
include 'partials/db_connection.php'; 

//check authentication

//for showing election 
$msg='';





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
    <title>vote</title>
    <style>
        .vote{
            color:black;
        }
    </style>
</head>

<body>

    <div class="conatainer vote">
        <?php
        include('partials/_nav.php');
       ?>
    </div>
    <form action="">
    <div class="row election_list">
        <?php
    $sql="SELECT * FROM `election_vote` ORDER BY `start_date`";
    $result=$conn->query($sql);    
    $i=0;
      while($row=$result->fetch(PDO::FETCH_ASSOC))
      {
          $bg_color='';
          $sdate=strtotime($row['start_date']);
          $edate=strtotime($row['end_date']);
          $current=time();
            if($current>$sdate && $current<$edate)
            {
                $bg_color="bg_color";
            }
            if($current<$edate)
            {

                    echo '<div class="col-md-4 mt-2">
                    <div class="card '.$bg_color.'" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Name: '.$row['name'].'</h5 <p class="card-text">Description:
                            '.$row['description'].'</p>
                            <p>start: '.$row['start_date'].'
                            <p>End: '.$row['end_date'].'
                            <br>
                            <div class="d-grid gap-2">
                                <a href="voting.php?id='.$row['eid'].'&vote=False" class="card-link btn btn-success btn-block">Vote</a>
                            </div>
                            
                        </div>
                    </div>
                    </div>';
            }

      }
      ?>
        
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