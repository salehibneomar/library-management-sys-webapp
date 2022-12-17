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
            <h1 class="m-0 text-white">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php" class="text-white text-bold">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="book.php" class="text-white text-bold">Books</a></li>
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
                            <h5 class="card-title">All Books</h5>
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
                                        <th style="width: 5%">
                                          Image
                                        </th>
                                        <th style="width: 25%">
                                            Title
                                        </th>
                                        <th style="width: 15%">
                                          Author
                                        </th>
                                        <th style="width: 8%">
                                          Category
                                        </th>
                                        <th style="width: 10%">
                                          Publication
                                        </th>
                                        <th style="width: 2%">
                                          Qty
                                        </th>
                                        <th style="width: 2%">
                                          Status
                                        </th>
                                        <th style="width: 20%">
                                          Action
                                        </th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>
                        </div>

                    </div>
                <?php } else if($action=="add"){ ?>
                  <div class="card card-dark card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Add Book</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <form action="book.php?action=add" method="post" enctype="multipart/form-data">
                                <div class="row">

                                <div class="input-group col-md-12 mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fas fa-book"></span>
                                        </div>
                                    </div>

                                    <input type="text" class="form-control" placeholder="Title" minlength="3" maxlength="250"  name="add_title" required>
                                        
                                </div>

                                <div class="input-group col-md-12 mb-3">

                                    <input type="text" value="" name="add_auth" data-role="tagsinput" class="bs4-tags-input" placeholder="Author/Authors Name" required>

                                    <small class="form-text text-muted">Use COMMA ( , ) to separate names</small>
                                        
                                </div>

                                <div class="input-group col-md-6 mb-3">
                                    
                                    <select name="add_cat_id" class="form-control select2bs4" style="width: 100%;" required>
                                          <option value="">--Select Category--</option>
                                          <?php  
                                              $catQuery = "SELECT cat_id, cat_name, cat_parent_name FROM book_category_view WHERE cat_status='active' AND (cat_parent_status='active' || cat_parent=0) ";

                                              $catQueryExecution = mysqli_query($conn, $catQuery);

                                              while($row = mysqli_fetch_assoc($catQueryExecution)){
                                                  extract($row);
                                                  
                                                  $optionName = $cat_name;
                                                  if($cat_parent_name!=null || !empty(trim($cat_parent_name))){
                                                    $optionName = $cat_parent_name." > ".$cat_name;
                                                  }

                                          ?>
                                                  <option value="<?=$cat_id; ?>"><?=$optionName; ?></option>
                                          <?php } ?>
                                    </select>
                                        
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    
                                    <select name="add_pub" class="form-control select2CustomInput" style="width: 100%;" required>
                                          <option value="">--Select Publication--</option>
                                          <?php  
                                              $bookPublicationQuery = "SELECT DISTINCT(b_publication) AS 'book_publication' FROM book";

                                              $bookPublicationQueryExecution = mysqli_query($conn, $bookPublicationQuery);

                                              while($row = mysqli_fetch_assoc($bookPublicationQueryExecution)){
                                                  extract($row); 
                                          ?>
                                                  <option value="<?=$book_publication; ?>"><?=$book_publication; ?></option>
                                          <?php } ?>
                                    </select>

                                    <small class="form-text text-muted">You can input new publication if not found in the list.</small>
                                        
                                </div>

                                <div class="input-group col-md-3 mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fas fa-calendar-alt"></span>
                                        </div>
                                    </div>

                                    <input type="number" class="form-control" placeholder="Published Year" min="1000"  name="add_year" required>
                                        
                                </div>

                                <div class="input-group col-md-3 mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fas fa-language"></span>
                                        </div>
                                    </div>

                                    <input type="text" class="form-control" placeholder="Language" minlength="1" maxlength="100"  name="add_lang" required>
                                        
                                </div>


                                <div class="input-group col-md-3 mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">
                                            <i class="fas fa-layer-group"></i>
                                          </div>
                                        </div>
                                        
                                        <select name="add_status" class="form-control" required>
                                            <option value="">--Status--</option>
                                            <option value="hidden">Hidden</option>
                                            <option value="public">Public</option>
                                        </select>

                                </div>

                                <div class="input-group col-md-3 mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                        Quantity
                                        </div>
                                    </div>

                                    <input type="number" class="form-control" placeholder="Quantity" min="1" max="999999"  name="add_quantity" required>
                                        
                                </div>

                                                                      
                                <div class="form-group mb-4 mt-3 col-md-12">
                                        <input id="image-uploader" name="add_image" type="file" accept=".jpg, .png, .jpeg" required>
                                </div>

                                <div class="form-group mt-3 col-md-12">
                                        <div class="float-right">
                                        <button type="reset"  class="btn btn-danger"><b>Reset&ensp;<i  class="fas fa-redo"></i></b></button>

                                          <button type="submit" name="addBook" class="btn btn-primary"><b>Add&ensp;<i  class="fas fa-plus"></i></b></button>
                                        </div>
                                </div>


                                </div>
                            </form>
                        </div>

                        <?php 

                            if(isset($_POST['addBook'])){
                                extract($_POST);
                                $add_title     = mysqli_real_escape_string($conn, trim($add_title));
                                $add_auth      = mysqli_real_escape_string($conn, trim($add_auth));
                                $add_year      = mysqli_real_escape_string($conn, trim($add_year));
                                $add_lang      = mysqli_real_escape_string($conn, trim($add_lang));
                                $add_pub       = mysqli_real_escape_string($conn, trim($add_pub));
                                $add_quantity  = mysqli_real_escape_string($conn, trim($add_quantity));

                              //Form Image Data
                              $addImageName           = $_FILES['add_image']['name'];
                              $addImageSize           = $_FILES['add_image']['size'];
                              $addImageTmpNamme       = $_FILES['add_image']['tmp_name'];

                              $addImageName           = strtolower($addImageName);
                              $addImageName           = str_replace(" ", "", $addImageName);

                              $imageAllowedExtensions = array('jpg', 'jpeg', 'png');
                              $imageAllowedSize       = 2048000;
                              $imageExtension         = pathinfo($addImageName, PATHINFO_EXTENSION);
                              $imagePath              = "images\book\\";
                              $image                  = null;

                              $formErrors = array();

                              if(empty($add_title)){
                                $formErrors[]="Title is empty!";
                              }
                              else if(mb_strlen($add_title)<3){
                                $formErrors[]="Title is too short!";
                              }
                              else if(mb_strlen($add_title)>250){
                                $formErrors[]="Title is too long!";
                              }

                              if(empty($add_year)){
                                $formErrors[]="Year is empty!";
                              }

                              if(empty($add_lang)){
                                $formErrors[]="Language is empty!";
                              }

                              if(empty($add_quantity)){
                                $formErrors[]="Quantity is empty!";
                              }

                              if(empty($add_pub)){
                                $formErrors[]="Publication is empty!";
                              }

                              if(empty($add_cat_id)){
                                $formErrors[]="Category is empty!";
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
                                header("Location: book.php?action=add");
                                exit();
                            }
                            else{
                                $add_date = date('Y-m-d');
                                $add_added_by = $_SESSION['loggedInUser']['mgt_id'];

                                $addBookQuery = "INSERT INTO book(b_title, b_published_year, b_author, b_language, b_publication, b_image, b_category_id, b_added_by, b_status, b_date_added, b_quantity)
                                VALUES('$add_title','$add_year', '$add_auth', '$add_lang', '$add_pub', '$image', '$add_cat_id', '$add_added_by', '$add_status', '$add_date', '$add_quantity')";

                                $addBookQueryExecution = mysqli_query($conn, $addBookQuery);

                                if($addBookQueryExecution){
                                    move_uploaded_file($addImageTmpNamme, $imagePath.$image);
                                    sleep(1);
                                    $_SESSION['alert']['msg']   = "Book Added Successfully!";
                                    $_SESSION['alert']['type']  = "success";
                                }
                                else{
                                    $sqlError = strval(mysqli_error($conn));
                                    $sqlError = str_replace("'", "\'", $sqlError);
                                    $_SESSION['alert']['msg']  = $sqlError;
                                    $_SESSION['alert']['type'] = "error";
                                }

                                header("Location: book.php");
                                exit();

                            }


                        }

                        ?>

                    </div>
                <?php } else if($action=="edit"){ 
                          if(isset($_GET['edit_id'])){
                            $edit_id = mysqli_real_escape_string($conn, trim($_GET['edit_id']));
                          
                              $editAdDataQuery = "SELECT * FROM book WHERE b_id='$edit_id'";
                              $editAdDataQueryExecution = mysqli_query($conn, $editAdDataQuery);
                              $bookData = mysqli_fetch_assoc($editAdDataQueryExecution);
                          
                              if($bookData==null){
                                  header("Location: book.php");
                                  exit();
                              }
                          }
                ?>
                  <div class="card card-dark card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Update Book</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <form action="book.php?action=edit" method="post" enctype="multipart/form-data">
                                <div class="row">

                                <div class="input-group col-md-12 mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fas fa-book"></span>
                                        </div>
                                    </div>

                                    <input type="text" class="form-control" placeholder="Title" minlength="3" maxlength="250"  name="edit_title" value="<?=$bookData['b_title']; ?>" required>
                                        
                                </div>

                                <div class="input-group col-md-12 mb-3">

                                    <input type="text" value="<?=$bookData['b_author']; ?>" name="edit_auth" data-role="tagsinput" class="bs4-tags-input" placeholder="Author/Authors Name" required>

                                    <small class="form-text text-muted">Use COMMA ( , ) to separate names</small>
                                        
                                </div>

                                <div class="input-group col-md-6 mb-3">
                                    
                                    <select name="edit_cat_id" class="form-control select2bs4" style="width: 100%;" required>
                                          <option value="">--Select Category--</option>
                                          <?php  
                                              $catQuery = "SELECT cat_id, cat_name, cat_parent_name FROM book_category_view WHERE cat_status='active' AND (cat_parent_status='active' || cat_parent=0) ";

                                              $catQueryExecution = mysqli_query($conn, $catQuery);

                                              while($row = mysqli_fetch_assoc($catQueryExecution)){
                                                  extract($row);
                                                  
                                                  $optionName = $cat_name;
                                                  if($cat_parent_name!=null || !empty(trim($cat_parent_name))){
                                                    $optionName = $cat_parent_name." > ".$cat_name;
                                                  }

                                                  $cat_selected = ($bookData['b_category_id']==$cat_id) ? 'selected' : null;

                                          ?>
                                                  <option value="<?=$cat_id; ?>" <?=$cat_selected; ?>><?=$optionName; ?></option>
                                          <?php } ?>
                                    </select>
                                        
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    
                                    <select name="edit_pub" class="form-control select2CustomInput" style="width: 100%;" required>
                                          <option value="">--Select Publication--</option>
                                          <?php  
                                              $bookPublicationQuery = "SELECT DISTINCT(b_publication) AS 'book_publication' FROM book";

                                              $bookPublicationQueryExecution = mysqli_query($conn, $bookPublicationQuery);

                                              while($row = mysqli_fetch_assoc($bookPublicationQueryExecution)){
                                                  extract($row);
                                                  $b_pub_selected = ($bookData['b_publication']==$book_publication) ? 'selected' : null;
                                          ?>
                                                  <option value="<?=$book_publication; ?>" <?=$b_pub_selected;?>><?=$book_publication; ?></option>
                                          <?php } ?>
                                    </select>

                                    <small class="form-text text-muted">You can input new publication if not found in the list.</small>
                                        
                                </div>

                                <div class="input-group col-md-3 mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fas fa-calendar-alt"></span>
                                        </div>
                                    </div>

                                    <input type="number" class="form-control" placeholder="Published Year" min="1000"  name="edit_year" value="<?=$bookData['b_published_year']; ?>" required>
                                        
                                </div>

                                <div class="input-group col-md-3 mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fas fa-language"></span>
                                        </div>
                                    </div>

                                    <input type="text" class="form-control" placeholder="Language" minlength="1" maxlength="100"  name="edit_lang" value="<?=$bookData['b_language']; ?>" required>
                                        
                                </div>


                                <div class="input-group col-md-3 mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">
                                            <i class="fas fa-layer-group"></i>
                                          </div>
                                        </div>
                                        
                                        <select name="edit_status" class="form-control" required>
                                            <option value="">--Status--</option>
                                            <option value="hidden" <?php if($bookData['b_status']=='hidden') echo 'selected'; ?> >Hidden</option>
                                            <option value="public" <?php if($bookData['b_status']=='public') echo 'selected'; ?> >Public</option>
                                        </select>

                                </div>

                                <div class="input-group col-md-3 mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                        Quantity
                                        </div>
                                    </div>

                                    <input type="number" class="form-control" placeholder="Quantity" min="0" max="999999"  name="edit_quantity" value="<?=$bookData['b_quantity']; ?>" required>
                                        
                                </div>

                                <div class="form-group mb-4 col-md-12">
                                <label for="">Current image</label> <br>
                                      <img class="book-current-image" src="images/book/<?=$bookData['b_image']; ?>" >
                                      <input type="hidden" name="edit_curr_image" value="<?=$bookData['b_image']; ?>">
                                </div>
                                
                                                                      
                                <div class="form-group mb-4 col-md-12">
                                <label for="">Upload new image</label> <br>
                                        <input id="image-uploader" name="edit_image" type="file" accept=".jpg, .png, .jpeg">
                                </div>

                                <input type="hidden" name="edit_b_id" value="<?=$bookData['b_id']; ?>">

                                <div class="form-group mt-3 col-md-12">
                                        <div class="float-right">
                                        <button type="reset"  class="btn btn-danger"><b>Reset&ensp;<i  class="fas fa-redo"></i></b></button>

                                          <button type="submit" name="editBook" class="btn btn-info"><b>Update&ensp;<i  class="fas fa-edit"></i></b></button>
                                        </div>
                                </div>


                                </div>
                            </form>
                        </div>

                        <?php 

                            if(isset($_POST['editBook'])){
                                extract($_POST);
                                $edit_title     = mysqli_real_escape_string($conn, trim($edit_title));
                                $edit_auth      = mysqli_real_escape_string($conn, trim($edit_auth));
                                $edit_year      = mysqli_real_escape_string($conn, trim($edit_year));
                                $edit_lang      = mysqli_real_escape_string($conn, trim($edit_lang));
                                $edit_pub       = mysqli_real_escape_string($conn, trim($edit_pub));
                                $edit_quantity  = mysqli_real_escape_string($conn, trim($edit_quantity));

                              //Form Image Data
                              $editImageName           = $_FILES['edit_image']['name'];
                              $editImageSize           = $_FILES['edit_image']['size'];
                              $editImageTmpNamme       = $_FILES['edit_image']['tmp_name'];

                              $editImageName           = strtolower($editImageName);
                              $editImageName           = str_replace(" ", "", $editImageName);

                              $imageAllowedExtensions = array('jpg', 'jpeg', 'png');
                              $imageAllowedSize       = 2048000;
                              $imageExtension         = pathinfo($editImageName, PATHINFO_EXTENSION);
                              $imagePath              = "images\book\\";
                              $image                  = $edit_curr_image;
                              $hasNewImage            = null;

                              $formErrors = array();

                              if(empty($edit_title)){
                                $formErrors[]="Title is empty!";
                              }
                              else if(mb_strlen($edit_title)<3){
                                $formErrors[]="Title is too short!";
                              }
                              else if(mb_strlen($edit_title)>250){
                                $formErrors[]="Title is too long!";
                              }

                              if(empty($edit_year)){
                                $formErrors[]="Year is empty!";
                              }

                              if(empty($edit_lang)){
                                $formErrors[]="Language is empty!";
                              }

                              if(trim($edit_quantity)==""){
                                $formErrors[]="Quantity is empty!";
                              }

                              if(empty($edit_pub)){
                                $formErrors[]="Publication is empty!";
                              }

                              if(empty($edit_cat_id)){
                                $formErrors[]="Category is empty!";
                              }


                              if(!empty($editImageName)){
                                if(!in_array($imageExtension, $imageAllowedExtensions)){
                                  $formErrors[]="Please upload a valid image!";
                                }
                                else{
                                    if($imageAllowedSize<$editImageSize){
                                      $formErrors[]="Image size if too large, upload image under 2MB!";
                                    }
                                    else if($editImageSize<=0){
                                      $formErrors[]="Invalid image!";
                                    }
                                    else{
                                      $image =  chr(rand(65,90)).rand(1000, 9999)."_".date('Ymd_His')."_".$editImageName;

                                      $hasNewImage = true;
                                    }
                                }
                              }


                              if(!empty($formErrors)){
                                $formErrors = implode("<br>",$formErrors);
                                $_SESSION['alert']['msg'] = $formErrors;
                                $_SESSION['alert']['type'] = "info";
                                header("Location: book.php?action=edit&edit_id={$edit_b_id}");
                                exit();
                            }
                            else{

                              $updateBookQuery = "UPDATE book SET b_title='$edit_title',b_published_year='$edit_year',b_author='$edit_auth',b_language='$edit_lang',b_publication='$edit_pub',b_image='$image',b_category_id='$edit_cat_id',b_status='$edit_status',b_quantity='$edit_quantity' WHERE b_id='$edit_b_id' LIMIT 1";
                                

                                $updateBookQueryExecution = mysqli_query($conn, $updateBookQuery);

                                if($updateBookQueryExecution){
                                    $affRows = mysqli_affected_rows($conn);
                                    if($affRows==1){
                                      if($hasNewImage){
                                        unlink("images\book\\".$edit_curr_image);
                                        sleep(1);
                                        move_uploaded_file($editImageTmpNamme, $imagePath.$image);
                                        sleep(1);
                                      }
                                      $_SESSION['alert']['msg']   = "Book Updated Successfully!";
                                      $_SESSION['alert']['type']  = "success";
                                    }
                                    else{
                                      $_SESSION['alert']['msg']   = "No changes!";
                                      $_SESSION['alert']['type']  = "info";
                                    }
                                }
                                else{
                                    $sqlError = strval(mysqli_error($conn));
                                    $sqlError = str_replace("'", "\'", $sqlError);
                                    $_SESSION['alert']['msg']  = $sqlError;
                                    $_SESSION['alert']['type'] = "error";
                                }

                                header("Location: book.php");
                                exit();

                            }


                        }

                        ?>

                    </div>
                <?php } else if($action=="delete"){ ?>
                <?php } else{ header("Location: book.php"); exit(); } ?>

                <!-- col -->
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
