<?php
      date_default_timezone_set('Asia/Dhaka');
      require_once 'config/db.php';
      ob_start();
      session_start();

      if(isset($_SESSION['loggedInUser'])
        && !empty($_SESSION['loggedInUser'])
        && !empty(trim($_SESSION['loggedInUser']['mgt_email']))
        && !empty(trim($_SESSION['loggedInUser']['mgt_pass']))){

        header("Location: dashboard.php");
        exit();
      }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Library Management | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="icon" href="images/icon/title_icon.png" type="image/x-icon">
  <style>
    .login-box{
      margin-top: 100px !important;
    }
  </style>
</head>
<body class="bg-secondary">

<div class="login-box mx-auto">
  <div class="login-logo ">
    <a href="" class="text-white"><b>Login </b>Panel</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="pass" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-12 mt-3">
            <button type="submit" name="loginBtn" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <?php
          if(isset($_POST['loginBtn'])){

            extract($_POST);
            $email = mysqli_real_escape_string($conn, trim($email));
            $pass  = mysqli_real_escape_string($conn, trim($pass));


            $formErrors = array();

            if(empty($email)){
              $formErrors[] = "Email is empty!";
            }

            if(empty($pass)){
              $formErrors[] = "Password is empty!";
            }

            if(!empty($formErrors)){
              $formErrors = implode("<br>",$formErrors);
              $_SESSION['alert']['msg']  = $formErrors;
              $_SESSION['alert']['type'] = "error";
            }
            else{
              $pass = SHA1($pass);
              $loginUserQuery = "SELECT * FROM library_management WHERE mgt_email='$email' AND mgt_pass='$pass' LIMIT 1";

              $loginUserQueryExecution = mysqli_query($conn, $loginUserQuery);

              if(mysqli_num_rows($loginUserQueryExecution)==1){
                

                $data = mysqli_fetch_assoc($loginUserQueryExecution);

                if($data['mgt_status']=='inactive'){
                  $_SESSION['alert']['msg']  = "Your ID is locked contact a Super Admin!";
                  $_SESSION['alert']['type'] = "error";
                }
                else if($data['mgt_status']=='pending'){
                  $_SESSION['alert']['msg']  = "Your ID is under review, please wait for a while!";
                  $_SESSION['alert']['type'] = "info";
                }
                else{
                  $_SESSION['loggedInUser'] = $data;
                  header("Location: dashboard.php");
                  exit();
                }
              }
              else{
                  $_SESSION['alert']['msg']  = "Invalid Login Information!";
                  $_SESSION['alert']['type'] = "error";
              }
            }

            header("Location: index.php");
            exit();

          }
      ?>

      <p class="mt-3 text-center">
        <a href="register.php" >Create new account</a>
      </p>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery-3.5.1.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.9.0/sweetalert2.all.min.js" ></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Sweet Alert Session operation -->
<script>

<?php 

  if(isset($_SESSION['alert'])){ ?>

    var icon  = '<?=$_SESSION['alert']['type']; ?>';
    var title = '<?=ucfirst($_SESSION['alert']['type']); ?>';
    var text  = '<?=$_SESSION['alert']['msg']; ?>';

      Swal.fire({
        icon:  icon,
        title: title,
        html:  text,
        showConfirmButton: false,
        timer: 5000
      });

<?php unset($_SESSION['alert']); } ?>

</script>

<?php 
      $conn->close();
      ob_end_flush(); 
?>
</body>
</html>
