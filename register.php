<?php include_once 'includes/header.php'; ?>

<?php if($hasLoggedInMember){ header("Location: index.php"); exit(); } ?>

    <section class="main-section mx-auto">

        <div class="container-fluid">
            
            <div class="row">

                
                <!--Books-->
                <div class="col-lg-7 col-md-9 col-sm-12 mx-auto mt-5">
                    
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="card-title">Registration Panel</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="name">Name</label>
                                        <input class="form-control" type="name" name="name" id="name" autocomplete="off" minlength="3" maxlength="150" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" type="phone" name="phone" id="phone" autocomplete="off" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input class="form-control" type="email" name="email" id="email" autocomplete="off" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label >Select Gender</label>
                                        <br>
                                          <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="male" name="gender" value="male" class="custom-control-input" required>
                                            <label class="custom-control-label" for="male">Male</label>
                                          </div>
                                          <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="female" name="gender" class="custom-control-input" value="female" required>
                                            <label class="custom-control-label" for="female">Female</label>
                                          </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="dob">Date of birth</label>
                                        <input class="form-control" type="date" name="dob" id="dob"  required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="pass">Password</label>
                                        <input class="form-control" type="password" name="pass" id="pass" autocomplete="off" minlength="6" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="repass">Retype Password</label>
                                        <input class="form-control" type="password" name="repass" id="repass" autocomplete="off" minlength="6" required>
                                    </div>

                                    <div class="form-group mt-2 col-md-12">
                                        <input id="image-uploader" name="image" type="file" accept=".jpg, .png, .jpeg" required>
                                    </div>


                                    <div class="form-group mt-3 col-md-12">
                                        <button type="submit" class="btn btn-primary" name="registerBtn">Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

                <?php
                    if(isset($_POST['registerBtn'])){
                      extract($_POST);
                      $name     = ucwords(mysqli_real_escape_string($conn, trim($name)));
                      $email    = strtolower(mysqli_real_escape_string($conn, trim($email)));
                      $phone    = mysqli_real_escape_string($conn, trim($phone));
                      $pass     = mysqli_real_escape_string($conn, trim($pass));
                      $repass   = mysqli_real_escape_string($conn, trim($repass));
              
                       //Form Image Data
                      $imageName           = $_FILES['image']['name'];
                      $imageSize           = $_FILES['image']['size'];
                      $imageTmpNamme       = $_FILES['image']['tmp_name'];
              
                      $imageName           = strtolower($imageName);
                      $imageName           = str_replace(" ", "", $imageName);
              
                      $imageAllowedExtensions = array('jpg', 'jpeg', 'png');
                      $imageAllowedSize       = 2048000;
                      $imageExtension         = pathinfo($imageName, PATHINFO_EXTENSION);
                      $imagePath              = "images\member\\";
                      $image                  = null;
              
                      $formErrors = array();
              
                      if(empty($name)){
                        $formErrors[]="Name is empty!";
                      }
                      else if(mb_strlen($name)<3){
                        $formErrors[]="Name is too short!";
                      }
                      else if(mb_strlen($name)>150){
                        $formErrors[]="Name is too long!";
                      }
                      else if(preg_match("/^[A-z\s]+$/", $name)==false){
                        $formErrors[]="Invalid name characters!";
                      }
              
                      if(empty($email)){
                        $formErrors[]="Email is empty!";
                      }
              
                      if(empty($phone)){
                        $formErrors[]="Phone is empty!";
                      }
              
                      if(empty($pass)){
                        $formErrors[]="Password is empty!";
                      }
                      else if(mb_strlen($pass)<6){
                        $formErrors[]="Password must have minimum of 6 characters!";
                      }
                      else if($pass!=$repass){
                        $formErrors[]="Password and Retyped password did not match!";
                      }
                      else{
                        $pass = SHA1($pass);
                      }
              
                      if(!isset($_POST['gender']) || empty($_POST['gender'])){
                        $formErrors[]="Select a gender!";
                      }
              
                      if(empty($imageName)){
                        $formErrors[]="Image is empty!";
                      }
                      else{
                        if(!in_array($imageExtension, $imageAllowedExtensions)){
                          $formErrors[]="Please upload a valid image!";
                        }
                        else{
                            if($imageAllowedSize<$imageSize){
                              $formErrors[]="Image size if too large, upload image under 2MB!";
                            }
                            else if($imageSize<=0){
                              $formErrors[]="Invalid image!";
                            }
                            else{
                              $image =  chr(rand(65,90)).rand(1000, 9999)."_".date('Ymd_His')."_".$imageName;
                            }
                        }
                      }
              
              
                      if(!empty($formErrors)){
                          $formErrors = implode("<br>",$formErrors);
                          $_SESSION['alert']['msg']  = $formErrors;
                          $_SESSION['alert']['type'] = "error";

                      }
                      else{

                        $checkUserDuplicacy = "SELECT u_id FROM library_user WHERE u_email='$email' OR u_phone='$phone' LIMIT 1";

                        $checkUserDuplicacyExecution = mysqli_query($conn, $checkUserDuplicacy);

                        if(mysqli_num_rows($checkUserDuplicacyExecution)==1){
                            $_SESSION['alert']['msg']  = "The email or phone entered is already registered!";
                            $_SESSION['alert']['type'] = "error";

                        }  

                        $joined_date = date('Y-m-d');
                        $status      = 'pending';

                          $addMemberQuery = "INSERT INTO library_user (u_name, u_gender, u_dob, u_email, u_phone, u_pass, u_image, u_joined_date, u_status) 
                          VALUES ('$name', '$gender', '$dob', '$email', '$phone', '$pass', '$image', '$joined_date', '$status')";
              
              
                          $addMemberQueryExecution = mysqli_query($conn, $addMemberQuery);
              
                          if($addMemberQuery){
                            move_uploaded_file($imageTmpNamme, $imagePath.$image);
                            sleep(1);
                            $_SESSION['alert']['msg']   = "Successfully registered, wait for an Admin to activate your ID.";
                            $_SESSION['alert']['type']  = "success";

                            $mgtNotificationQuery = "INSERT INTO library_management_notification(mgt_ntype)
                            VALUES('3')";
                            $mgtNotificationQueryExecution = mysqli_query($conn, $mgtNotificationQuery);
                          }
                          else{
                            $_SESSION['alert']['msg']  = "Fatal Error Occured!";
                            $_SESSION['alert']['type'] = "error";
                          }
                      }
              
                      header("Location: register.php");
                      exit();
              
                  } 
            ?>

            </div>

        </div>

    </section>

<?php include_once 'includes/footer.php'; ?>



