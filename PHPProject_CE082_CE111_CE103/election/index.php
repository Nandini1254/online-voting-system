<?php
session_start();

include 'partials/db_connection.php';    


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
    <title>home_page</title>

    </style>
</head>

<body>


    <?php
        include('partials/_nav.php');    
    ?>


    <div class="container my-2">

        <div class="last_election">

            <div class="heading mb-4">
                <center>
                    <h3>Last election result</h3>
                </center>
            </div>
            <div class="row head-top">
                <div class="col-md-6">
                    <h5>Election</h5>
                </div>
                <div class="col-md-6">
                    <h5>Winner</h5>
                </div>
            </div>
            <?php
                $sql="SELECT * FROM `result`";
                $result=$conn->query($sql);

                while($row=$result->fetch(PDO::FETCH_ASSOC))
                {
                    
                
                    $eid=$row['election_id'];
                    $sql_election="SELECT * FROM `election_vote` WHERE `eid`='$eid'";
                    $r=$conn->query($sql_election);
                    $row_election=$r->fetch(PDO::FETCH_ASSOC);
                    if($row_election)
                    {
                        echo '<div class="result_final ">';
                        // echo $row_election['end_date'];
                        $date2=date_create($row_election['end_date']);
                        $current= date("Y-m-d");
                        $date=date_create($current);
                        $diff=date_diff($date,$date2);
                        $d=$diff->format('%d');
                        if($d<7)
                        {
                            $result_winner=$row['candidate_id'];
                            $sql_candidate="SELECT * FROM `elector` WHERE `id`=$result_winner";
                            $result_candidate=$conn->query($sql_candidate);
                            $row_candidate=$result_candidate->fetch(PDO::FETCH_ASSOC);
                            echo '<div class="row">
                            <div class="col-md-6">
                                '.$row_election['name'].'
                            </div>';
                            if($row_candidate['elector_name'])
                            {
                                echo '<div class="col-md-6">
                                '.$row_candidate['elector_name'].'
                                </div>';
                            }
                            else
                            {
                                echo '<div class="col-md-6">
                                Not winner
                                </div>';
                            }
                        
                        echo '</div>';
                        
                        
                        }
                        echo '</div>';
                }
                
                }
                ?>
        </div>
        <div class="upcoming_result">
            <div class="result text-center">
                <h5>Upcoming result/current voting line is open</h5>
            </div>
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
                        echo '<div class="col-md-4 ">
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