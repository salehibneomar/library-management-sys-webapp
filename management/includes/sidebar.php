  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">LIBMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="images/management/<?=$_SESSION['loggedInUser']['mgt_profile_image']; ?>" class="dashboard-pro-image" alt="User Image">
        </div>
        <div class="info">
          <a href=# class="d-block"><?=strtoupper(explode(" ", $_SESSION['loggedInUser']['mgt_name'])[0]); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-align-justify"></i>
              <p>
                Book Categories
                <i class="fas fa-angle-left right"></i>
                <!--<span class="badge badge-info right">6</span>-->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="category.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Category</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
              <p>
                Books
                <i class="fas fa-angle-left right"></i>
                <!--<span class="badge badge-info right">6</span>-->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="book.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Books</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="book.php?action=add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Book</p>
                </a>
              </li>

            </ul>
          </li>

          
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book-reader"></i>
              <p>
                Book Requests
                <i class="fas fa-angle-left right"></i>
                <!--<span class="badge badge-info right">6</span>-->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="book-request.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Requests</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
             <i class="nav-icon fas fa-user-shield"></i>

              <p>
                Management
                <i class="fas fa-angle-left right"></i>
                <!--<span class="badge badge-info right">6</span>-->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="management.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <?php if($_SESSION['loggedInUser']['mgt_role']=='admin'){ ?>
                  <p>Manage Users</p>
                  <?php }else{ ?>
                    <p>See Users</p>
                  <?php } ?>
                </a>
              </li>
              <?php if($_SESSION['loggedInUser']['mgt_role']=='admin'){ ?>
              <li class="nav-item">
                <a href="management.php?action=add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
              <?php } ?>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
              <p>
                Members
                <i class="fas fa-angle-left right"></i>
                <!--<span class="badge badge-info right">6</span>-->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="member.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Members</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="member.php?action=add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Memeber</p>
                </a>
              </li>

            </ul>
          </li>



        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>