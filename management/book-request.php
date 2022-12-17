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
                              <h5 class="card-title">All Book Requests</h5>
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
                                        <th style="width: 2%">
                                            Member ID
                                        </th>
                                        <th style="width: 10%">
                                            Name
                                        </th>
                                        <th style="width: 8%">
                                            Requested
                                        </th>
                                        <th style="width: 8%">
                                            From
                                        </th>
                                        <th style="width: 8%">
                                           To
                                        </th>
                                        <th style="width: 1%">
                                            Total Books
                                        </th>
                                        <th style="width: 2%">
                                            Manager ID
                                        </th>
                                        <th style="width: 5%">
                                            Status
                                        </th>
                                        <th style="width: 2%">
                                            Remaining
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


                  <?php }else if($action=="edit"){ 
                      
                      if(isset($_GET['edit_id'])){
                          $edit_id = mysqli_real_escape_string($conn, trim($_GET['edit_id']));

                            $editBookReqStatusQuery = "SELECT br_id, br_u_name, br_status, br_book_ids FROM book_borrow_view WHERE br_id='$edit_id'";

                            $editBookReqStatusQueryExecution = mysqli_query($conn, $editBookReqStatusQuery);
                            $bookData = mysqli_fetch_assoc($editBookReqStatusQueryExecution);

                            if($bookData==null || $bookData['br_status']=="returned"){
                                header("Location: book-request.php");
                                exit();
                            }
                      }
                      
                  ?>
                    <div class="card card-dark card-outline">
                          
                          <div class="card-header">
                              <h5 class="card-title">Update Book Request Status</h5>
                              <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                      <i class="fas fa-minus"></i>
                                  </button>
                              </div>
                          </div>

                          <div class="card-body">
                                <h5 class="mb-3 text-muted">Requested By: <?=$bookData['br_u_name']; ?></h5>

                              <form action="book-request.php?action=edit" method="post" >

                                <?php $optionArray = array("pending", "accepted", "returned" ,"not returned"); ?>
                                
                                <div class="row">

                                <div class="form-group col-md-12">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="edit_br_status" id="status">
                                        <?php foreach($optionArray as $option){ 
                                            $selected = $option==$bookData['br_status'] ? 'selected' : null;
                                        ?>
                                            <option value="<?=$option; ?>" <?=$selected;?>><?=ucfirst($option); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                 
                                    <input type="hidden" name="edit_br_id" value="<?=$bookData['br_id']; ?>">
                                    <input type="hidden" name="edit_br_book_ids" value="<?=$bookData['br_book_ids']; ?>">
                                    <div class="form-group mt-3 col-md-12">
                                        <div class="float-right">
                                          <button type="submit" name="editBookStatus" class="btn btn-info"><b>Update&ensp;<i  class="fas fa-edit"></i></b></button>
                                        </div>
                                    </div>
                                
                                </div>

                              </form>
                          </div>

                        <?php
                            if(isset($_POST['editBookStatus'])){
                                extract($_POST);

                                $bookReqStatusUpdateQuery = "UPDATE book_borrow SET br_status='$edit_br_status' WHERE br_id='$edit_br_id' LIMIT 1";

                                $bookReqStatusUpdateQueryExecution = mysqli_query($conn, $bookReqStatusUpdateQuery);

                                $affRows = mysqli_affected_rows($conn);

                                if($affRows==0){
                                    $_SESSION['alert']['msg']  = "No changes!";
                                    $_SESSION['alert']['type'] = "info";
                                }
                                else if($affRows==1){

                                    if($edit_br_status=="returned"){
                                        $edit_br_book_ids = explode(",", $edit_br_book_ids);
                                        $updateBookQuantity = implode("' OR b_id='", $edit_br_book_ids);
                                        $updateBookQuantity = "b_id='".$updateBookQuantity."'";
                                        
                                        $updateBookQuantityQuery = "UPDATE book SET b_quantity=(b_quantity+1) WHERE ".$updateBookQuantity;
                                        $updateBookQuantityQueryExecution = mysqli_query($conn, $updateBookQuantityQuery);
                                    }

                                    $manager = $_SESSION['loggedInUser']['mgt_id'];
                                    $managedByQuery = "UPDATE book_borrow SET br_managed_by='$manager' LIMIT 1";
                                    $managedByQueryExe = mysqli_query($conn, $managedByQuery);

                                    $_SESSION['alert']['msg']  = "Updated Successfully!";
                                    $_SESSION['alert']['type'] = "success";
                                }
                                else{
                                    $sqlError = strval(mysqli_error($conn));
                                    $sqlError = str_replace("'", "\'", $sqlError);
                                    $_SESSION['alert']['msg']  = $sqlError;
                                    $_SESSION['alert']['type'] = "error";
                                }

                                header("Location: book-request.php");
                                exit();

                            }
                        ?>

                    </div>
                  <?php }else if($action=="view"){ 
                    
                    if(isset($_GET['view_id']) && $_GET['view_id']!=""){
                      $view_id = mysqli_real_escape_string($conn, trim($_GET['view_id']));

                      $getBookIdsQuery = "SELECT br_id, br_u_name, br_status, br_book_ids FROM book_borrow_view WHERE br_id='$view_id'";

                      $getBookIdsQueryExecution = mysqli_query($conn, $getBookIdsQuery);
                      $bookData = mysqli_fetch_assoc($getBookIdsQueryExecution);

                      if($bookData==null){
                          header("Location: book-request.php");
                          exit();
                      }

                      $bookIds = explode(",", $bookData['br_book_ids']);
                      $bookIds = implode("' OR b_id='", $bookIds);
                      $bookIds = "b_id='".$bookIds."'";

                    }
                    else{
                      header("Location: book-request.php");
                      exit();
                    }
                    
                  ?>
                    <div class="card card-dark card-outline">
                          
                          <div class="card-header">
                              <h5 class="card-title">Requested Book List</h5>
                              <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                      <i class="fas fa-minus"></i>
                                  </button>
                              </div>
                          </div>

                          <div class="card-body overflow-x-auto">
                          <h5 class="text-muted mb-4">Requested By: <?=$bookData['br_u_name']; ?></h5>
                            <table class="table table-bordered table-striped w-100">
                                <thead>
                                    <tr>
                                        <th >
                                            #Book ID
                                        </th>
                                        <th >
                                            Title
                                        </th>
                                        <th >
                                            Category
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php 

                                    $getRequestedBooksQuery = "SELECT b_id, b_title, b_cat_name, b_cat_parent_name FROM book_view WHERE ".$bookIds;

                                    $getRequestedBooksQueryExe = mysqli_query($conn, $getRequestedBooksQuery);

                                    while($row = mysqli_fetch_assoc($getRequestedBooksQueryExe)){
                                      extract($row);

                                      $catshow = ($b_cat_parent_name==null || $b_cat_parent_name=="") ? $b_cat_name : $b_cat_parent_name." > ".$b_cat_name;
                                    ?>

                                    <tr>
                                        <td><?=$b_id; ?></td>
                                        <td><?=$b_title; ?></td>
                                        <td><?=$catshow; ?></td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                  <?php }else if($action=="delete"){

                    }else{ header("Location: book-request.php"); exit(); } ?>
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
