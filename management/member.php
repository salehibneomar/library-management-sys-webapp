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
            <h1 class="m-0 text-white">Member</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php" class="text-white text-bold">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="category.php" class="text-white text-bold">Member</a></li>
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
                              <h5 class="card-title">All Members</h5>
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
                                        <th style="width: 2%">
                                            #ID
                                        </th>
                                        <th style="width: 1%">
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
                                        <th style="width: 10%">
                                           Email
                                        </th>
                                        <th style="width: 8%">
                                            Joined
                                        </th>
                                        <th style="width: 2%">
                                            Status
                                        </th>
                                        <th style="width: 10%">
                                          Action
                                        </th>

                                        
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>
                        </div>

                    </div>

                  <?php }else if($action=="add"){ ?>

                    <div class="card card-dark card-outline">
                          
                          <div class="card-header">
                              <h5 class="card-title">Add Member</h5>
                              <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                      <i class="fas fa-minus"></i>
                                  </button>
                              </div>
                          </div>

                    </div>

                  <?php }else if($action=="edit"){ 
                      
                      if(isset($_GET['edit_id'])){
                          $edit_id = mysqli_real_escape_string($conn, trim($_GET['edit_id']));

                            $editMemberStatusQuery = "SELECT u_id, u_name, u_status FROM library_user WHERE u_id='$edit_id'";

                            $editMemberStatusQueryExecution = mysqli_query($conn, $editMemberStatusQuery);
                            $memberData = mysqli_fetch_assoc($editMemberStatusQueryExecution);

                            if($memberData==null){
                                header("Location: management.php");
                                exit();
                            }
                      }
                  ?>
                    <div class="card card-dark card-outline">
                          
                          <div class="card-header">
                              <h5 class="card-title">Update Member Status</h5>
                              <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                      <i class="fas fa-minus"></i>
                                  </button>
                              </div>
                          </div>

                          <div class="card-body">
                                <h5 class="mb-3 text-muted">Name: <?=$memberData['u_name']; ?></h5>

                              <form action="member.php?action=edit" method="post" >

                                <?php $optionArray = array("inactive", "active", "pending"); ?>
                                
                                <div class="row">

                                <div class="form-group col-md-12">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="edit_u_status" id="status">
                                        <?php foreach($optionArray as $option){ 
                                            $selected = $option==$memberData['u_status'] ? 'selected' : null;
                                        ?>
                                            <option value="<?=$option; ?>" <?=$selected;?>><?=ucfirst($option); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                    <input type="hidden" name="edit_u_id" value="<?=$memberData['u_id']; ?>">
                                    <div class="form-group mt-3 col-md-12">
                                        <div class="float-right">
                                          <button type="submit" name="editMemberBtn" class="btn btn-info"><b>Update&ensp;<i  class="fas fa-edit"></i></b></button>
                                        </div>
                                    </div>
                                
                                </div>

                              </form>
                          </div>

                        <?php
                            if(isset($_POST['editMemberBtn'])){
                                extract($_POST);

                                $memberStatusUpdateQuery = "UPDATE library_user SET u_status='$edit_u_status' WHERE u_id='$edit_u_id' LIMIT 1";

                                $memberStatusUpdateQueryExecution = mysqli_query($conn, $memberStatusUpdateQuery);

                                $affRows = mysqli_affected_rows($conn);

                                if($affRows==0){
                                    $_SESSION['alert']['msg']  = "No changes!";
                                    $_SESSION['alert']['type'] = "info";
                                }
                                else if($affRows==1){
                                    $_SESSION['alert']['msg']  = "Member Status Updated Successfully!";
                                    $_SESSION['alert']['type'] = "success";
                                }
                                else{
                                    $sqlError = strval(mysqli_error($conn));
                                    $sqlError = str_replace("'", "\'", $sqlError);
                                    $_SESSION['alert']['msg']  = $sqlError;
                                    $_SESSION['alert']['type'] = "error";
                                }

                                header("Location: member.php");
                                exit();

                            }
                        ?>

                    </div>
                  <?php }else if($action=="delete"){

                    }else{ header("Location: member.php"); exit(); } ?>
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
