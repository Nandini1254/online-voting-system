  <?php
$name='';
$email='';
if(isset($_SESSION['admin_email']))
{
    $name=$_SESSION['admin_name'];
    $email=$_SESSION['admin_email'];
}
  
  echo '<div class="col-md-2 navbar_css"> <div class="vertical-nav " id="sidebar">
  <div >
    <div style="text-align: center;">
      <div class="heading">
      <i class="fas fa-user fa-th-large   fa-fw"></i>
        '.$name.'<br>
      </div>
    </div>
  </div>';
  ?>

  <ul class="nav flex-column">
      <li class="nav-item">
          <a href="A_home.php"
              class="nav-link <?php if(basename($_SERVER['PHP_SELF'])=="A_home.php"){echo "active"; } ?>  font-italic">
              <i class="fas fa-home-circle fa-th-large   fa-fw"></i>
              Home
          </a>
      </li>

    

      <li class="nav-item">
          <a href="A_Addition.php?add=True" class="nav-link  font-italic">
              <i class="fas fa-plus-square  fa-fw"></i>
              Add Election
          </a>

      <li class="nav-item">
          <a href="A_election_manage.php?manage=True" class="nav-link  font-italic">
              <i class="fa fa-tasks fa-fw" aria-hidden="true"></i>
              Manage Election
          </a>
      </li>

      <li class="nav-item">
          <a href="A_result.php?result=True" class="nav-link  font-italic">
              <i class="fa fa-list-alt fa-fw" aria-hidden="true"></i>
              Result
          </a>
      </li>

      <li class="nav-item">
          <a href="../logout.php" class="nav-link  font-italic">
              <i class="fas fa-sign-out-alt   fa-fw"></i>
              Log Out
          </a>
      </li>

  </ul>
  </div>
  </div>