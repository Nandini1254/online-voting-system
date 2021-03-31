<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login']==false)
{
  header("location: index.php");
  exit;
}
else{
   session_unset();
   session_destroy();
   header("location: index.php");
}
?>