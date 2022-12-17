<?php
      date_default_timezone_set('Asia/Dhaka');
      require_once 'config/db.php';
      ob_start();
      session_start();

      if(isset($_SESSION['loggedInUser'])
      && !empty(trim($_SESSION['loggedInUser']))
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
  <title>Library Management | Registration</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!--Krajee File input-->
  <link rel="stylesheet" href="plugins/krajee-bs-file-input/css/fileinput.min.css">
  <link rel="stylesheet" href="plugins/krajee-bs-file-input/themes/explorer-fas/theme.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="icon" href="images/icon/title_icon.png" type="image/x-icon">

    <style>
      .file-upload-indicator, .file-caption-name{
          display: none !important;
      }
      .file-preview-image{
        max-width: 120px !important;
        min-width: 80px !important;
      }
   </style>

</head>

<body class="hold-transition bg-secondary">

<div class="container mt-3">
  <div class="row">
      <div class="mt-5 mb-5 col-lg-8 col-md-10 col-sm-12 mx-auto">

        <div class="register-logo">
          <a href="" class="text-white"><b>Registration </b>Panel</a>
        </div>
      
        <div class="card">
          <div class="card-body register-card-body">
            <p class="login-box-msg">Management Self Registration</p>
      
            <form action="" method="post" enctype="multipart/form-data">
      
              <div class="row">
      
                <div class="input-group col-md-12 mb-3">
                  <input type="text" class="form-control" name="add_name" placeholder="Name" minlength="3" maxlength="150" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                </div>
      
                <div class="input-group col-md-6 mb-3">
                  <input type="email" class="form-control" name="add_email" placeholder="Email" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-at"></span>
                    </div>
                  </div>
                </div>
      
                <div class="input-group col-md-6 mb-3">
                  <input type="phone" class="form-control" name="add_phone" placeholder="Phone" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-phone"></span>
                    </div>
                  </div>
                </div>
      
                <div class="input-group col-md-6 mb-3">
                  <input type="password" class="form-control" name="add_pass" placeholder="Password" minlength="6" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-key"></span>
                    </div>
                  </div>
                </div>
      
                <div class="input-group col-md-6 mb-3">
                  <input type="password" class="form-control" name="add_repass" placeholder="Retype Password" minlength="6" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-key"></span>
                    </div>
                  </div>
                </div>
      
                <div class="input-group col-md-12 mb-3">
                  <input type="text" class="form-control" name="add_address" placeholder="Address" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <i class="fas fa-map-marker-alt"></i>
                    </div>
                  </div>
                </div>

                <div class="input-group col-md-6 mb-4">
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="male" name="add_gender" value="male" class="custom-control-input" required>
                      <label class="custom-control-label" for="male">Male</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="female" name="add_gender" value="female" class="custom-control-input" required>
                      <label class="custom-control-label" for="female">Female</label>
                    </div>
                </div>

                <div class="input-group col-md-6 mb-4">                     
                <input type="date" class="form-control" name="add_dob" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      Date of Birth
                    </div>
                  </div>
                </div>

                
              <div class="form-group mb-3 col-md-12">
                  <input id="management-profile-image" name="add_image" type="file" accept=".jpg, .png, .jpeg" required>
              </div>
                
      
              </div>
      
              <div class="row">
                <div class="col-12">
                  <div class="icheck-primary">
                    <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                    <label for="agreeTerms">
                    I agree to the <a href="#">terms</a>
                    </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-12 mt-3">
                    <button type="submit" name="registerBtn" class="btn btn-primary btn-block">Register</button>
                </div>
                <!-- /.col -->
              </div>
            </form>

            <?php
                    if(isset($_POST['registerBtn'])){
                      extract($_POST);
                      $add_name     = ucwords(mysqli_real_escape_string($conn, trim($add_name)));
                      $add_email    = strtolower(mysqli_real_escape_string($conn, trim($add_email)));
                      $add_phone    = mysqli_real_escape_string($conn, trim($add_phone));
                      $add_pass     = mysqli_real_escape_string($conn, trim($add_pass));
                      $add_repass   = mysqli_real_escape_string($conn, trim($add_repass));
                      $add_address  = mysqli_real_escape_string($conn, trim($add_address));
              
                       //Form Image Data
                      $addImageName           = $_FILES['add_image']['name'];
                      $addImageSize           = $_FILES['add_image']['size'];
                      $addImageTmpNamme       = $_FILES['add_image']['tmp_name'];
              
                      $addImageName           = strtolower($addImageName);
                      $addImageName           = str_replace(" ", "", $addImageName);
              
                      $imageAllowedExtensions = array('jpg', 'jpeg', 'png');
                      $imageAllowedSize       = 2048000;
                      $imageExtension         = pathinfo($addImageName, PATHINFO_EXTENSION);
                      $imagePath              = "images\management\\";
                      $image                  = null;
              
                      $formErrors = array();
              
                      if(empty($add_name)){
                        $formErrors[]="Name is empty!";
                      }
                      else if(mb_strlen($add_name)<3){
                        $formErrors[]="Name is too short!";
                      }
                      else if(mb_strlen($add_name)>150){
                        $formErrors[]="Name is too long!";
                      }
                      else if(preg_match("/^[A-z\s]+$/", $add_name)==false){
                        $formErrors[]="Invalid name characters!";
                      }
              
                      if(empty($add_email)){
                        $formErrors[]="Email is empty!";
                      }
              
                      if(empty($add_phone)){
                        $formErrors[]="Phone is empty!";
                      }
              
                      if(empty($add_pass)){
                        $formErrors[]="Password is empty!";
                      }
                      else if(mb_strlen($add_pass)<6){
                        $formErrors[]="Password must have minimum of 6 characters!";
                      }
                      else if($add_pass!=$add_repass){
                        $formErrors[]="Password and Retyped password did not match!";
                      }
                      else{
                        $add_pass = SHA1($add_pass);
                      }
              
                      if(empty($add_address)){
                        $formErrors[]="Address is empty!";
                      }
              
                      if(!isset($_POST['add_gender']) || empty($_POST['add_gender'])){
                        $formErrors[]="Select a gender!";
                      }
              
                      if(empty($addImageName)){
                        $formErrors[]="Image is empty!";
                      }
                      else{
                        if(!in_array($imageExtension, $imageAllowedExtensions)){
                          $formErrors[]="Please upload a valid image!";
                        }
                        else{
                            if($imageAllowedSize<$addImageSize){
                              $formErrors[]="Image size if too large, upload image under 2MB!";
                            }
                            else if($addImageSize<=0){
                              $formErrors[]="Invalid image!";
                            }
                            else{
                              $image =  chr(rand(65,90)).rand(1000, 9999)."_".date('Ymd_His')."_".$addImageName;
                            }
                        }
                      }
              
              
                      if(!empty($formErrors)){
                          $formErrors = implode("<br>",$formErrors);
                          $_SESSION['alert']['msg']  = $formErrors;
                          $_SESSION['alert']['type'] = "error";
                          header("Location: register.php");
                          exit();
                      }
                      else{

                        $checkUserDuplicacy = "SELECT * FROM library_management WHERE mgt_email='$add_email' OR mgt_phone='$add_phone' LIMIT 1";

                        $checkUserDuplicacyExecution = mysqli_query($conn, $checkUserDuplicacy);

                        if(mysqli_num_rows($checkUserDuplicacyExecution)==1){
                            $_SESSION['alert']['msg']  = "The email or phone entered is already registered!";
                            $_SESSION['alert']['type'] = "error";
                            header("Location: register.php");
                            exit();
                        }  

                        $add_joined_date = date('Y-m-d');
                        $add_role        = 'editor';
                        $add_status      = 'pending';

                          $addUserQuery = "INSERT INTO library_management(mgt_name, mgt_gender, mgt_dob, mgt_email, mgt_phone, mgt_pass, mgt_role, mgt_status, mgt_joined_date, mgt_profile_image, mgt_present_address)
                          VALUES('$add_name', '$add_gender', '$add_dob', '$add_email', '$add_phone', '$add_pass', '$add_role', '$add_status', '$add_joined_date', '$image', '$add_address')";
              
              
                          $addUserQueryExecution = mysqli_query($conn, $addUserQuery);
              
                          if($addUserQuery){
                            move_uploaded_file($addImageTmpNamme, $imagePath.$image);
                            sleep(1);
                            $_SESSION['alert']['msg']   = "Successfully registered, wait for an Admin to activate your ID.";
                            $_SESSION['alert']['type']  = "success";
                            $add_pass=null;
                            $add_repass=null;

                            $mgtNotificationQuery = "INSERT INTO library_management_notification(mgt_ntype)
                            VALUES('1')";
                            $mgtNotificationQueryExecution = mysqli_query($conn, $mgtNotificationQuery);
                          }
                          else{
                            $sqlError = strval(mysqli_error($conn));
                            $sqlError = str_replace("'", "\'", $sqlError);
                            $_SESSION['alert']['msg']  = $sqlError;
                            $_SESSION['alert']['type'] = "error";
                          }
                      }
              
                      header("Location: index.php");
                      exit();
              
                  } 
            ?>
      
            <p class="mt-3 w-100 text-center">
              <a href="index.php" >Already have an account</a>
            </p>
      
          </div>
          <!-- /.form-box -->
        </div><!-- /.card -->
      
      </div>
  </div>
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery-3.5.1.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.9.0/sweetalert2.all.min.js" ></script>

<!-- Krajee -->
<script src="plugins/krajee-bs-file-input/js/plugins/piexif.js" ></script>
<script src="plugins/krajee-bs-file-input/js/plugins/sortable.js" ></script>
<script src="plugins/krajee-bs-file-input/js/fileinput.js" ></script>
<script src="plugins/krajee-bs-file-input/js/locales/fr.js" ></script>
<script src="plugins/krajee-bs-file-input/js/locales/es.js" ></script>
<script src="plugins/krajee-bs-file-input/themes/fas/theme.js" ></script>
<script src="plugins/krajee-bs-file-input/themes/explorer-fas/theme.js" ></script>

<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>
          $("#management-profile-image").fileinput({
            'theme': 'explorer-fas',
            'uploadUrl': '#',
            dropZoneEnabled: false,
            browseOnZoneClick: true,
            showRemove: false,
            showUpload: false,
            showCancel: false,
            showCaption: true,
            showClose: false,
            browseClass: "btn btn-success",
            browseIcon: '<i class="fas fa-image"></i>',
            browseLabel: '&ensp;Click here to choose image',
            focusCaptionOnBrowse: true,
            allowedFileTypes: ["image"],
            allowedFileExtensions: ["jpg", "jpeg", "png"],
            maxFileSize: 2048,
            fileActionSettings: {
                showRemove: true,
                showZoom: false,
                showUpload: false,
                removeClass: 'btn btn-sm btn-danger',
                zoomClass: 'btn btn-sm btn-info' 
            },

        });

</script>


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
