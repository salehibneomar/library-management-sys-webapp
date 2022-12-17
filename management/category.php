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
            <h1 class="m-0 text-white">Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php" class="text-white text-bold">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="category.php" class="text-white text-bold">Category</a></li>
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
                <div class="col-lg-4">
                    <?php if($action=="manage"){ ?>
                    <div class="card card-dark card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Add Category</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                                <form action="category.php?action=manage" method="post">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <input type="text" name="add_cat_name" class="form-control" placeholder="Category Name" required minlength="2" maxlength="250">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <select name="add_cat_parent" class="form-control select2bs4" style="width: 100%;">
                                                <option value="0">--Select Category Parent--</option>
                                                <?php  
                                                    $mainCatQuery = "SELECT cat_id AS 'mainCatId', cat_name AS 'mainCatName' FROM book_category WHERE cat_parent=0 AND cat_status='active'";

                                                    $mainCatQueryExecution = mysqli_query($conn, $mainCatQuery);

                                                    while($row = mysqli_fetch_assoc($mainCatQueryExecution)){
                                                        extract($row); 
                                                ?>
                                                        <option value="<?=$mainCatId; ?>"><?=$mainCatName; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <select name="add_cat_status" class="form-control" required>
                                                <option value="">--Choose Status--</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12 mt-3">
                                            <button type="submit" name="addCat" class="btn btn-primary float-right"><b>Add&ensp;<i class="fas fa-plus"></i></b></button>
                                        </div>
                                    </div>
                                </form>

                                <?php

                                 if(isset($_POST['addCat'])){ 
                                    extract($_POST);
                                    $add_cat_name   = mysqli_real_escape_string($conn, trim($add_cat_name));
                                    $add_cat_status = mysqli_real_escape_string($conn, $add_cat_status);

                                    $formErrorsString = null;

                                    if(empty($add_cat_name)){
                                        $formErrorsString = "Category name is empty!";
                                    }

                                    if($formErrorsString!=null){
                                        $_SESSION['alert']['msg'] = $formErrorsString;
                                        $_SESSION['alert']['type'] = "info";
                                    }
                                    else{
                                        $addCatQuery = "INSERT INTO book_category(cat_name, cat_status, cat_parent)
                                        VALUES('$add_cat_name', '$add_cat_status', '$add_cat_parent')";

                                        $addCatQueryExecute = mysqli_query($conn, $addCatQuery);
                                        
                                        if($addCatQueryExecute){
                                            $_SESSION['alert']['msg'] = "Category Added Successfully!";
                                            $_SESSION['alert']['type'] = "success";
                                        }
                                        else{
                                            $sqlError = strval(mysqli_error($conn));
                                            $sqlError = str_replace("'", "\'", $sqlError);
                                            $_SESSION['alert']['msg']  = $sqlError;
                                            $_SESSION['alert']['type'] = "error";
                                        }
                                    }

                                    
                                    header("Location: category.php");
                                    exit();
                                    
                                 } 
                                 
                                ?>
                        </div>
                    </div>
                    <?php }else if($action=="edit"){ 
                        if(isset($_GET['edit_id']) ){
                            $edit_id = mysqli_real_escape_string($conn, trim($_GET['edit_id']));

                            $editCategoryDataQuery = "SELECT * FROM book_category WHERE cat_id='$edit_id'";
                            $editCategoryDataQueryExecution = mysqli_query($conn, $editCategoryDataQuery);
                            $catData = mysqli_fetch_assoc($editCategoryDataQueryExecution);

                            if($catData==null){
                                header("Location: category.php");
                                exit();
                            }
                        
                    ?>
                    <div class="card card-dark card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Update Category</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                                <form action="category.php?action=edit" method="post">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <input type="text" name="edit_cat_name" class="form-control" placeholder="Category Name" required minlength="2" maxlength="250" value="<?=$catData['cat_name']; ?>">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <select name="edit_cat_parent" class="form-control select2bs4" style="width: 100%;">
                                                <option value="0">--Select Category Parent--</option>
                                                <?php  
                                                    $mainCatQuery = "SELECT cat_id AS 'mainCatId', cat_name AS 'mainCatName' FROM book_category WHERE cat_parent=0";

                                                    $mainCatQueryExecution = mysqli_query($conn, $mainCatQuery);

                                                    while($row = mysqli_fetch_assoc($mainCatQueryExecution)){
                                                        extract($row);
                                                        $selected = $mainCatId==$catData['cat_parent'] ? 'selected' : null;
                                                        
                                                        
                                                ?>
                                                        <option value="<?=$mainCatId; ?>" <?=$selected; ?>><?=$mainCatName; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <select name="edit_cat_status" class="form-control" required>
                                                <option value="">--Choose Status--</option>
                                                <option value="active" <?php if($catData['cat_status']=='active') echo 'selected'; ?> >Active</option>
                                                <option value="inactive"  <?php if($catData['cat_status']=='inactive') echo 'selected'; ?>>Inactive</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="edit_cat_id" value="<?=$catData['cat_id']; ?>">
                                        <div class="form-group col-md-12 mt-3">
                                            <button type="submit" name="updateCat" class="btn btn-info float-right"><b>Update&ensp;<i class="fas fa-edit"></i></b></button>
                                        </div>
                                    </div>
                                </form>

                                <?php
                                    }
                                    
                                    if(isset($_POST['updateCat'])){
                                        extract($_POST);
                                        $edit_cat_name   = mysqli_real_escape_string($conn, $edit_cat_name);
                                        $edit_cat_status = mysqli_real_escape_string($conn, $edit_cat_status);

                                        $editCatQuery = "UPDATE book_category SET cat_name='$edit_cat_name', cat_status='$edit_cat_status', cat_parent='$edit_cat_parent' WHERE cat_id='$edit_cat_id' LIMIT 1";

                                        $editCatQueryExecution = mysqli_query($conn, $editCatQuery);
                                        $affRows = mysqli_affected_rows($conn);

                                        if($affRows==0){
                                            $_SESSION['alert']['msg']  = "No changes!";
                                            $_SESSION['alert']['type'] = "info";
                                        }
                                        else if($affRows==1){
                                            $_SESSION['alert']['msg']  = "Category Updated Successfully!";
                                            $_SESSION['alert']['type'] = "success";
                                        }
                                        else{
                                            $sqlError = strval(mysqli_error($conn));
                                            $sqlError = str_replace("'", "\'", $sqlError);
                                            $_SESSION['alert']['msg']  = $sqlError;
                                            $_SESSION['alert']['type'] = "error";
                                        }
            
                                        header("Location: category.php");
                                        exit();
                                    }
                                ?>
                        </div>
                    </div>
                    <?php }else if($action=="delete"){ 
                        if(isset($_GET['delete_id'])){

                            $delete_id = mysqli_real_escape_string($conn, trim($_GET['delete_id']));
                            
                            if(empty($delete_id) || $delete_id<=0){
                                header("Location: category.php");
                                exit();
                            }

                            $deleteCatQuery = "DELETE FROM book_category WHERE cat_id='$delete_id' OR cat_parent='$delete_id'";

                            $deleteCatQueryExecution = mysqli_query($conn, $deleteCatQuery);

                            $affRows = mysqli_affected_rows($conn);

                            if($affRows==0){
                                $_SESSION['alert']['msg']  = "Row does not exists!";
                                $_SESSION['alert']['type'] = "info";
                            }
                            else if($affRows>=1){
                                $_SESSION['alert']['msg']  = "Category Deleted Successfully!";
                                $_SESSION['alert']['type'] = "success";
                            }
                            else{
                                $sqlError = strval(mysqli_error($conn));
                                $sqlError = str_replace("'", "\'", $sqlError);
                                $_SESSION['alert']['msg']  = $sqlError;
                                $_SESSION['alert']['type'] = "error";
                            }

                            header("Location: category.php");
                            exit();
                        }
                    ?>
                    <?php }else { header("Location: category.php"); exit(); }?>
                </div>

                <div class="col-lg-8">
                    <div class="card card-dark card-outline">
                        <div class="card-header">
                            <h5 class="card-title">All Categories</h5>
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
                                        <th style="width: 35%">
                                            Name
                                        </th>
                                        <th style="width: 10%">
                                            Status
                                        </th>
                                        <th style="width: 20%">
                                            Parent
                                        </th>
                                        <th style="width: 15%">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>
                        </div>
                    </div>
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
