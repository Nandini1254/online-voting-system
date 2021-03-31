<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Our Team Section</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="cssfolder/homestyle.css">
    <link rel="stylesheet" href="cssfolder/style.css">

</head>

<body>
    <?php include_once('partials/_nav.php'); ?>
    <div class="wrapper">
        <h1>About Us Page</h1>
        <div class="container">
            <p> Everyone knows that India is the largest democracy in the world hence voting is the most common way for
                the people here to arrive at any decision which is best for everyone.
            <p>Here, we have tried to give our best platform for conducting any type of elections so that we could help
                countless people to make certain decision. We have tried to accomodate all the possible features
                required for hassle free conduction of election.</p>
            <p> Here, we are hosting the election as per user or any corperation requriments and we conduct election and
                for that they have to contact us and fill the requirements and in that election any candidate who is
                interested in their election they can participate in that election.
                and lastly According to your credentials we calculate the total votes for a particular election. </p>
            <h1 class="pb-3">Our Team</h1>
            <div class="team">
                <div class="team_member">
                    <div class="team_img">
                        <img src="uploads/images/luv.png" alt="Team_image">
                    </div>
                    <h3>Luv Patel</h3>
                    <p></p>
                    <p>luv@example.com</p>
                    <p><button class="button  btn btn-secondary">Contact</button></p>
                </div>
                <div class="team_member">
                    <div class="team_img">
                        <img src="uploads/images/nan.png" alt="Team_image">
                    </div>
                    <h3>Nandani Panchani</h3>

                    <p></p>
                    <p>nandani@example.com</p>
                    <p><button class="button  btn btn-secondary">Contact</button></p>
                </div>
                <div class="team_member">
                    <div class="team_img">
                        <img src="uploads/images/aman2.jpg" alt="Team_image">
                    </div>
                    <h3>Aman Ramoliya</h3>
                    <p></p>
                    <p>aman@example.com</p>
                    <p><button class="button btn btn-secondary">Contact</button></p>
                </div>

            </div>
        </div>
    </div>
</body>
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

</html>