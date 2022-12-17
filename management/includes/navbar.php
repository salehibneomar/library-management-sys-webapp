  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-light border-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->
      <?php
        $notificationQuery = "SELECT
        (SELECT COUNT(*) FROM library_management_notification WHERE mgt_ntype = 1 AND mgt_nstatus=0) AS 'editor_req_count',
        (SELECT COUNT(*) FROM library_management_notification WHERE mgt_ntype = 2 AND mgt_nstatus=0) AS 'book_req_count',
        (SELECT COUNT(*) FROM library_management_notification WHERE mgt_ntype = 3 AND mgt_nstatus=0) AS 'member_req_count'";
        $notificationQueryExecution = mysqli_query($conn, $notificationQuery);
        $notificationResult = mysqli_fetch_assoc($notificationQueryExecution);
        extract($notificationResult);

        $totalNotifications = $book_req_count+$member_req_count;

        if($_SESSION['loggedInUser']['mgt_role']=='admin'){
          $totalNotifications = $editor_req_count+$book_req_count+$member_req_count;
        }

      ?>
      <li class="nav-item dropdown mr-3">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <?php if($totalNotifications>0){ ?>
          <span class="badge badge-warning navbar-badge"><?=$totalNotifications; ?></span>
          <?php } ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">
            <?php

              if($totalNotifications>0){
                if($totalNotifications==1){
                  echo $totalNotifications." Notification";
                }
                else{
                  echo $totalNotifications." Notifications";
                }
                
              }
              else{
                echo "No notifications";
              }
            ?>
          </span>

          <div class="dropdown-divider"></div>
          <?php if($editor_req_count>0 && $_SESSION['loggedInUser']['mgt_role']=='admin'){ ?>
          <a href="notification.php?type=1" class=" dropdown-item">
          <i class="fas fa-user-shield mr-2"></i>
            <?=$editor_req_count." "."new registered editors needs approval!"?>
          </a>
          <?php }?>

          <?php if($book_req_count>0){ ?>
          <div class="dropdown-divider"></div>
          <a href="notification.php?type=2" class=" dropdown-item">
            <i class="fas fa-book mr-2"></i>
            <?=$book_req_count." "."new book request needs your approval!"?>
          </a>
          <?php }?>

          <?php if($member_req_count>0){ ?>
          <div class="dropdown-divider"></div>
          <a href="notification.php?type=3" class=" dropdown-item">
            <i class="fas fa-users mr-2"></i>
            <?=$member_req_count." "."new members request needs your approval!"?>
          </a>
          <?php }?>

        </div>
      </li>

      <li class="nav-item dropdown mr-3">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#1" class="dropdown-item nav-dropdown-item"><i class="fa fa-user" aria-hidden="true"></i>&ensp;Profile</a>
          <div class="dropdown-divider"></div>
          <a href="#2" class="dropdown-item nav-dropdown-item"><i class="fas fa-sliders-h"></i>&ensp;Settings</a>
          <div class="dropdown-divider"></div>
          <a href="logout.php" class="dropdown-item "><i class="fas fa-sign-out-alt"></i>&ensp;Logout</a>
        </div>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->