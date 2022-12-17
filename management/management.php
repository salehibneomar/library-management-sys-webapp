<?php
    include_once 'includes/top.php';
?>

<div class="wrapper">
  <!-- Navbar -->
  <?php include_once 'includes/navbar.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include_once 'includes/sidebar.php'; ?>

  <?php $action = (isset($_GET['action'])) ? $_GET['action'] : 'manage'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-white">Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php" class="text-white text-bold">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="category.php" class="text-white text-bold">Management</a></li>
              <li class="breadcrumb-item text-white"><?=ucfirst($action);?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
                  <?php if($action=="manage"){ ?>

                    <div class="card card-dark card-outline">
                          
                          <div class="card-header">
                              <h5 class="card-title">All Users</h5>
                              <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                      <i class="fas fa-minus"></i>
                                  </button>
                              </div>
                          </div>

                          <div class="card-body overflow-x-auto">
                            <table class="table table-bordered table-striped w-100" id="dataTable">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">
                                            #ID
                                        </th>
                                        <th style="width: 2%">
                                            Image
                                        </th>
                                        <th style="width: 20%">
                                            Name
                                        </th>
                                        <th style="width: 3%">
                                            Gender
                                        </th>
                                        <th style="width: 10%">
                                            Phone
                                        </th>
                                        <th style="width: 5%">
                                            Joined
                                        </th>
                                        <th style="width: 3%">
                                            Role
                                        </th>
                                        <th style="width: 2%">
                                            Status
                                        </th>
                                        <th style="width: 12%">
                                          Action
                                        </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>
                        </div>

                    </div>

                  <?php }else if($action=="add" && $_SESSION['loggedInUser']['mgt_role']=='admin'){ ?>

                    <div class="card card-dark card-outline">
                          
                          <div class="card-header">
                              <h5 class="card-title">Add User</h5>
                              <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                      <i class="fas fa-minus"></i>
                                  </button>
                              </div>
                          </div>

                          <div class="card-body">

                              <form action="management.php?action=add" method="post" enctype="multipart/form-data">
                                
                                <div class="row">

                                      <div class="input-group col-md-12 mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                          </div>
                                        </div>

                                        <input type="text" class="form-control" placeholder="Name" minlength="3" maxlength="150"  name="add_name" required>
                                        
                                      </div>

                                      <div class="input-group col-md-6 mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">
                                            <span class="fas fa-at"></span>
                                          </div>
                                        </div>

                                        <input type="email" class="form-control" placeholder="Email" maxlength="250" name="add_email" required>

                                      </div>

                                      <div class="input-group col-md-6 mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">
                                            <span class="fas fa-phone"></span>
                                          </div>
                                        </div>

                                        <input type="phone" class="form-control" placeholder="Phone" name="add_phone" required>

                                      </div>

                                      <div class="input-group col-md-6 mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">
                                            <span class="fas fa-key"></span>
                                          </div>
                                        </div>

                                        <input type="password" class="form-control" placeholder="Password" minlength="6" maxlength="250" name="add_pass" required>

                                      </div>

                                      <div class="input-group col-md-6 mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">
                                            <span class="fas fa-key"></span>
                                          </div>
                                        </div>

                                        <input type="password" class="form-control" placeholder="Retype Password" minlength="6" maxlength="250" name="add_repass" required>

                                      </div>

                                      <div class="input-group col-md-12 mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">
                                            <i class="fas fa-map-marker-alt"></i>
                                          </div>
                                        </div>

                                        <input type="text" class="form-control" placeholder="Address" name="add_address" required>

                                      </div>

                                      <div class="input-group col-md-12 mb-3">
                                          <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="male" name="add_gender" value="male" class="custom-control-input" required>
                                            <label class="custom-control-label" for="male">Male</label>
                                          </div>
                                          <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="female" name="add_gender" class="custom-control-input" value="female" required>
                                            <label class="custom-control-label" for="female">Female</label>
                                          </div>
                                      </div>

                                      <div class="input-group col-md-3 mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">
                                            <b>Date Of Birth</b>
                                          </div>
                                        </div>
                                        <input type="date" class="form-control" name="add_dob" required>

                                      </div>

                                      <div class="input-group col-md-3 mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">
                                            <i class="fas fa-layer-group"></i>
                                          </div>
                                        </div>
                                        
                                        <select name="add_status" class="form-control" required>
                                            <option value="">--Status--</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>

                                      </div>

                                      <div class="input-group col-md-3 mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">
                                            <i class="fas fa-user-tag"></i>
                                          </div>
                                        </div>
                                        
                                        <select name="add_role" class="form-control" required>
                                            <option value="">--Role--</option>
                                            <option value="admin">Admin</option>
                                            <option value="editor">Editor</option>
                                        </select>

                                      </div>

                                      <div class="input-group col-md-3 mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">
                                            <b>Joined Date</b>
                                          </div>
                                        </div>
                                        
                                        <input type="date" class="form-control" name="add_joined_date" required>

                                      </div>

                                      
                                    <div class="form-group mb-4 mt-2 col-md-12">
                                        <input id="image-uploader" name="add_image" type="file" accept=".jpg, .png, .jpeg" required>
                                    </div>
                                  
                                    <div class="form-group mt-3 col-md-12">
                                        <div class="float-right">
                                        <button type="reset"  class="btn btn-danger"><b>Reset&ensp;<i  class="fas fa-redo"></i></b></button>

                                          <button type="submit" name="addUser" class="btn btn-primary"><b>Add&ensp;<i  class="fas fa-plus"></i></b></button>
                                        </div>
                                    </div>


                                </div>

                              </form>
                          </div>

                          <?php 
                          if(isset($_POST['addUser'])){
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
                                  $_SESSION['alert']['msg'] = $formErrors;
                                  $_SESSION['alert']['type'] = "info";
                                  header("Location: management.php?action=add");
                                  exit();
                              }
                              else{
                                  $addUserQuery = "INSERT INTO library_management(mgt_name, mgt_gender, mgt_dob, mgt_email, mgt_phone, mgt_pass, mgt_role, mgt_status, mgt_joined_date, mgt_profile_image, mgt_present_address)
                                  VALUES('$add_name', '$add_gender', '$add_dob', '$add_email', '$add_phone', '$add_pass', '$add_role', '$add_status', '$add_joined_date', '$image', '$add_address')";


                                  $addUserQueryExecution = mysqli_query($conn, $addUserQuery);

                                  if($addUserQuery){
                                    move_uploaded_file($addImageTmpNamme, $imagePath.$image);
                                    sleep(1);
                                    $_SESSION['alert']['msg']   = "User Added Successfully!";
                                    $_SESSION['alert']['type']  = "success";
                                    $add_pass=null;
                                    $add_repass=null;
                                  }
                                  else{
                                    $sqlError = strval(mysqli_error($conn));
                                    $sqlError = str_replace("'", "\'", $sqlError);
                                    $_SESSION['alert']['msg']  = $sqlError;
                                    $_SESSION['alert']['type'] = "error";
                                  }
                              }

                              header("Location: management.php");
                              exit();


                          } 
                          ?>

                    </div>

                  <?php }else if($action=="edit" && $_SESSION['loggedInUser']['mgt_role']=='admin'){ 
                      
                      if(isset($_GET['edit_id'])){
                          $edit_id = mysqli_real_escape_string($conn, trim($_GET['edit_id']));

                            $editUserDataQuery = "SELECT * FROM library_management WHERE mgt_id='$edit_id'";
                            $editUserDataQueryExecution = mysqli_query($conn, $editUserDataQuery);
                            $userData = mysqli_fetch_assoc($editUserDataQueryExecution);

                            if($userData==null){
                                header("Location: management.php");
                                exit();
                            }
                    
                  ?>
                    <div class="card card-dark card-outline">
                          
                          <div class="card-header">
                              <h5 class="card-title">Edit User</h5>
                              <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                      <i class="fas fa-minus"></i>
                                  </button>
                              </div>
                          </div>

                          <div class="card-body">

                              <form action="management.php?action=edit" method="post" enctype="multipart/form-data">
                                
                                <div class="row">

                                      <div class="input-group col-md-12 mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                          </div>
                                        </div>

                                        <input type="text" class="form-control" placeholder="Name" minlength="3" maxlength="150" value="<?=$userData['mgt_name']; ?>" name="edit_name" required>
                                        
                                      </div>

                                      <div class="input-group col-md-6 mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">
                                            <span class="fas fa-at"></span>
                                          </div>
                                        </div>

                                        <input type="email" class="form-control" placeholder="Email" maxlength="250" value="<?=$userData['mgt_email']; ?>" name="edit_email" required>

                                      </div>

                                      <div class="input-group col-md-6 mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">
                                            <span class="fas fa-phone"></span>
                                          </div>
                                        </div>

                                        <input type="phone" class="form-control" placeholder="Phone" value="<?=$userData['mgt_phone']; ?>" name="edit_phone" required>

                                      </div>

                                      <div class="input-group col-md-6 mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">
                                            <span class="fas fa-key"></span>
                                          </div>
                                        </div>

                                        <input type="password" class="form-control" placeholder="Password" minlength="6" maxlength="250" name="edit_pass" >

                                      </div>

                                      <div class="input-group col-md-6 mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">
                                            <span class="fas fa-key"></span>
                                          </div>
                                        </div>

                                        <input type="password" class="form-control" placeholder="Retype Password" minlength="6" maxlength="250" name="edit_repass" >

                                      </div>

                                      <div class="input-group col-md-12 mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">
                                            <i class="fas fa-map-marker-alt"></i>
                                          </div>
                                        </div>

                                        <input type="text" class="form-control" placeholder="Address" value="<?=$userData['mgt_present_address']; ?>" name="edit_address" required>

                                      </div>

                                      <div class="input-group col-md-12 mb-3">
                                          <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="male" name="edit_gender" class="custom-control-input" <?php if($userData['mgt_gender']=='male'){ echo 'checked'; } ?> value="male" required>
                                            <label class="custom-control-label" for="male">Male</label>
                                          </div>
                                          <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="female" name="edit_gender" class="custom-control-input" <?php if($userData['mgt_gender']=='female'){ echo 'checked'; } ?> value="female" required>
                                            <label class="custom-control-label" for="female">Female</label>
                                          </div>
                                      </div>

                                      <div class="input-group col-md-4 mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">
                                            <b>Date Of Birth</b>
                                          </div>
                                        </div>
                                        <input type="date" class="form-control" value="<?=$userData['mgt_dob']; ?>" name="edit_dob"  required>

                                      </div>

                                      <div class="input-group col-md-4 mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">
                                            <i class="fas fa-layer-group"></i>
                                          </div>
                                        </div>
                                        
                                        <select name="edit_status" class="form-control" required>
                                            <option value="">--Status--</option>
                                            <option value="active" <?php if($userData['mgt_status']=='active'){ echo 'selected'; } ?> >Active</option>
                                            <option value="inactive" <?php if($userData['mgt_status']=='inactive'){ echo 'selected'; } ?>>Inactive</option>
                                        </select>

                                      </div>

                                      <div class="input-group col-md-4 mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">
                                            <i class="fas fa-user-tag"></i>
                                          </div>
                                        </div>
                                        
                                        <select name="edit_role" class="form-control" required>
                                            <option value="">--Role--</option>
                                            <option value="admin" <?php if($userData['mgt_role']=='admin'){ echo 'selected'; } ?> >Admin</option>
                                            <option value="editor" <?php if($userData['mgt_role']=='editor'){ echo 'selected'; } ?> >Editor</option>
                                        </select>

                                      </div>
                                    <input type="hidden" name="edit_user_id" value="<?=$userData['mgt_id']; ?>">
                                    <div class="form-group mt-3 col-md-12">
                                        <div class="float-right">
                                        <button type="reset" class="btn btn-danger"><b>Reset&ensp;<i  class="fas fa-redo"></i></b></button>

                                          <button type="submit" name="editUserBtn" class="btn btn-info"><b>Update&ensp;<i  class="fas fa-edit"></i></b></button>
                                        </div>
                                    </div>


                                </div>

                              </form>
                          </div>

                          <?php
                            }

                            if(isset($_POST['editUserBtn'])){
                              extract($_POST);

                              $edit_name      = ucwords(mysqli_real_escape_string($conn, trim($edit_name)));
                              $edit_email     = strtolower(mysqli_real_escape_string($conn, trim($edit_email)));
                              $edit_phone     = mysqli_real_escape_string($conn, trim($edit_phone));
                              $edit_pass      = mysqli_real_escape_string($conn, trim($edit_pass));
                              $edit_repass    = mysqli_real_escape_string($conn, trim($edit_repass));
                              $edit_address   = mysqli_real_escape_string($conn, trim($edit_address));
                              $hasNewPassword = false;

                              $formErrors = array();

                              if(empty($edit_name)){
                                $formErrors[]="Name is empty!";
                              }
                              else if(mb_strlen($edit_name)<3){
                                $formErrors[]="Name is too short!";
                              }
                              else if(mb_strlen($edit_name)>150){
                                $formErrors[]="Name is too long!";
                              }

                              if(empty($edit_email)){
                                $formErrors[]="Email is empty!";
                              }

                              if(empty($edit_phone)){
                                $formErrors[]="Phone is empty!";
                              }

                              if(!empty($edit_pass)){
                                if(mb_strlen($edit_pass)>=6){
                                  if($edit_pass==$edit_repass){
                                    $hasNewPassword = true;
                                    $edit_pass = SHA1($edit_pass);
                                  }
                                  else{
                                    $formErrors[]="Password and Retyped password did not match!";
                                  }
                                }
                                else{
                                  $formErrors[]="Password must have minimum of 6 characters!";
                                }
                              }


                              if(empty($edit_address)){
                                $formErrors[]="Address is empty!";
                              }

                              if(!isset($_POST['edit_gender']) || empty($_POST['edit_gender'])){
                                $formErrors[]="Select a gender!";
                              }


                              if(!empty($formErrors)){
                                  $formErrors = implode("<br>",$formErrors);
                                  $_SESSION['alert']['msg'] = $formErrors;
                                  $_SESSION['alert']['type'] = "info";
                                  header("Location: management.php?action=edit&edit_id={$edit_user_id}");
                                  exit();
                              }
                              else{
                                  
                                $editUserQuery = "UPDATE library_management SET mgt_name='$edit_name', mgt_gender='$edit_gender', mgt_dob='$edit_dob', mgt_email='$edit_email', mgt_phone='$edit_phone', mgt_role='$edit_role', mgt_status='$edit_status', mgt_present_address='$edit_address' WHERE mgt_id='$edit_user_id' LIMIT 1";

                                if($hasNewPassword){
                                  $editUserQuery = "UPDATE library_management SET mgt_name='$edit_name', mgt_gender='$edit_gender', mgt_dob='$edit_dob', mgt_email='$edit_email', mgt_phone='$edit_phone', mgt_role='$edit_role', mgt_status='$edit_status', mgt_present_address='$edit_address', mgt_pass='$edit_pass' WHERE mgt_id='$edit_user_id' LIMIT 1";
                                }

                                $editUserQueryExecution = mysqli_query($conn, $editUserQuery);

                                $affRows = mysqli_affected_rows($conn);

                                if($affRows==0){
                                    $_SESSION['alert']['msg']  = "No changes!";
                                    $_SESSION['alert']['type'] = "info";
                                }
                                else if($affRows==1){
                                    $_SESSION['alert']['msg']  = "User Updated Successfully!";
                                    $_SESSION['alert']['type'] = "success";
                                }
                                else{
                                    $sqlError = strval(mysqli_error($conn));
                                    $sqlError = str_replace("'", "\'", $sqlError);
                                    $_SESSION['alert']['msg']  = $sqlError;
                                    $_SESSION['alert']['type'] = "error";
                                }

                              }

                              header("Location: management.php");
                              exit();

                            }

                          ?>

                    </div>
                  <?php }else if($action=="delete" && $_SESSION['loggedInUser']['mgt_role']=='admin'){

                        if(isset($_GET['delete_id'])){
                          $delete_id = mysqli_real_escape_string($conn, trim($_GET['delete_id']));

                          if(empty($delete_id) || $delete_id<=0){
                            header("Location: management.php");
                            exit();
                          }
                          
                          $unlinkUserImageQuery = "SELECT mgt_profile_image FROM library_management WHERE mgt_id='$delete_id' LIMIT 1";
                          $unlinkUserImageQueryExecution = mysqli_query($conn, $unlinkUserImageQuery);
                          $unlinkUserImageData = mysqli_fetch_assoc($unlinkUserImageQueryExecution);  

                          $deleteUserQuery = "DELETE FROM library_management WHERE mgt_id='$delete_id' LIMIT 1";
                          $deleteUserQueryExecution = mysqli_query($conn, $deleteUserQuery);
                          $affRows = mysqli_affected_rows($conn);


                          if($affRows==0){
                              $_SESSION['alert']['msg']  = "Row does not exists!";
                              $_SESSION['alert']['type'] = "info";
                          }
                          else if($affRows==1){
                              unlink("images\management\\".$unlinkUserImageData['mgt_profile_image']);
                              sleep(1);
                              $_SESSION['alert']['msg']  = "User Deleted Successfully!";
                              $_SESSION['alert']['type'] = "success";
                          }
                          else{
                              $sqlError = strval(mysqli_error($conn));
                              $sqlError = str_replace("'", "\'", $sqlError);
                              $_SESSION['alert']['msg']  = $sqlError;
                              $_SESSION['alert']['type'] = "error";
                          }

                          header("Location: management.php");
                          exit();

                        }

                        }else{ header("Location: management.php"); exit(); } ?>
              </div>
          </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php include_once 'includes/footer.php'; ?>
  
</div>
<!-- ./wrapper -->

<?php include_once 'includes/bottom.php'; ?>
