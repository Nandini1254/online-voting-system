<?php 
require_once("db_connection.php");
$email=$username="";
$check1=isset($_SESSION['v_id']);
$check2=isset($_SESSION['e_id']);
// echo $_SESSION['voter_name'];
if($check1)
{
    $id=$_SESSION['v_id'];
    $sql_check="SELECT * FROM `voter` WHERE `id` = '$id'";
    $r=$conn->query($sql_check);
    $row=$r->fetch(PDO::FETCH_ASSOC);
    $username=$row['voter_name'];
    $page="/php_project_sem4/PHPProject_CE082_CE111_CE103/election/voter/V_profile.php";
}
if($check2)
{
    $id=$_SESSION['e_id'];
    $sql_check="SELECT * FROM `elector` WHERE `id` = '$id'";
    $r=$conn->query($sql_check);
    $row=$r->fetch(PDO::FETCH_ASSOC);
    $username=$row['elector_name'];
    $page="/php_project_sem4/PHPProject_CE082_CE111_CE103/election/candidate/E_profile.php";
}
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="#">Ielection</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse " id="navbarSupportedContent">
    <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
      <li class="nav-item">
        <a class="nav-link" aria-current="page" href="/php_project_sem4/PHPProject_CE082_CE111_CE103/election/index.php">Home</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" aria-current="page" href="/php_project_sem4/PHPProject_CE082_CE111_CE103/election/about us.php">About US </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" aria-current="page" href="/php_project_sem4/PHPProject_CE082_CE111_CE103/election/contact.php">contact US </a>
    </li>
   ';
    
      
      if(!$username)
      {
        echo ' <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
         login
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="/php_project_sem4/PHPProject_CE082_CE111_CE103/election/voter/V_login.php">Voter</a></li>
          <li><a class="dropdown-item" href="/php_project_sem4/PHPProject_CE082_CE111_CE103/election/candidate/E_login.php">Candidate</a></li>
          <li><a class="dropdown-item" href="/php_project_sem4/PHPProject_CE082_CE111_CE103/election/admin/A_login.php">Admin</a></li>
        </ul>
        </li>';
        echo ' <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
         signup
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="/php_project_sem4/PHPProject_CE082_CE111_CE103/election/voter/V_signup.php">Voter</a></li>
          <li><a class="dropdown-item" href="/php_project_sem4/PHPProject_CE082_CE111_CE103/election/candidate/E_signup.php">Candidate</a></li>
        </ul>
        </li>';
      }
      else
      {
        echo '<li class="nav-item">
        <a class="nav-link"  href="/php_project_sem4/PHPProject_CE082_CE111_CE103/election/vote.php">Vote</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="/php_project_sem4/PHPProject_CE082_CE111_CE103/election/logout.php">Logout</a>
          </li>
         <li class="nav-item">
        <a class="nav-link" href="'.$page.'"><i class="fa fa-user-circle" ></i> '.$username.'  </a>
        </li>';
      }
      echo '</ul></div>
</div>
</nav>';

?> 