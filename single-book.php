<?php include_once 'includes/header.php'; ?>

<?php include_once 'includes/searchbar.php'; ?> 

    <section class="main-section mx-auto">

        <div class="container-fluid">
            
            <div class="row">

                
                <!--Books-->
                <div class="col-md-9 col-sm-12 mb-3">
                    
                    <?php
                        if(isset($_GET['book_id']) && trim($_GET['book_id'])!=""){
                            $book_id = mysqli_real_escape_string($conn, trim($_GET['book_id']));

                            $getSingleBookQuery = "SELECT * FROM book_view WHERE b_status='public' AND b_id='$book_id'";
                            $getSingleBookQueryExecution = mysqli_query($conn, $getSingleBookQuery);

                            $bookData = mysqli_fetch_assoc($getSingleBookQueryExecution);
                           
                            if($bookData==null){
                                header("Location: index.php");
                                exit();
                            }

                            extract($bookData);
                        }
                        else{
                            header("Location: index.php");
                            exit();
                        }
                    ?>

                    <div class="col-md-12  mb-4">
                        <h4>Book Details</h4>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row mt-4">
                                <div class="col-md-5 w-100">
                                    <img class="img-fluid single-book-image border border-secondary" src="management/images/book/<?=$b_image; ?>" alt="">
                                </div>
                                <div class="col-md-7 w-100">
                                    <h5 class="mb-4"><b>Title:</b>&ensp;
                                    <?=$b_title; ?></h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">  <b>Autor/Authors:</b> <br>
                                            <?php $b_author = explode(",", $b_author);
                                                  $b_author = implode(",&emsp;", $b_author);
                                            ?>
                                            <small class="text-info"><?=$b_author; ?></small>
                                        </li>
                                        <li class="list-group-item"><b>Publication:</b><br>
                                            <small><?=$b_publication; ?></small>
                                        </li>
                                        <li class="list-group-item">  <b>Language:</b>  <br>
                                        <small><?=$b_language; ?></small>
                                        </li>
                                        <li class="list-group-item">  <b>Category:</b>  <br>
                                        <small><?php if($b_cat_parent_name!=null || $b_cat_parent_name!=""){ echo $b_cat_parent_name." > ".$b_cat_name; } else{ echo $b_cat_name; }?></small>
                                        </li>
                                        <li class="list-group-item">  <b>Published Year:</b>  <br>
                                        <small><?=$b_published_year; ?></small>
                                        </li>
                                        <?php if($b_quantity>0){ ?>
                                            <li class="list-group-item">  <b>Availability:</b>  <br>
                                                <span class="badge badge-success">In Stock</span>
                                            </li>
                                            <li class="list-group-item">  <b>Quantity:</b>  <br>
                                            <span class="badge badge-info"><?=$b_quantity; ?></span>
                                            </li>
                                            <?php if($hasLoggedInMember){ ?>
                                            <li class="list-group-item text-right">
                                                <a class="btn btn-secondary " href="add-to-cart.php?book_id=<?=$b_id; ?>"><i class="fas fa-cart-plus"></i>&ensp; Add to cart</a>
                                            </li>
                                            <?php } else{ ?>
                                                <div class="alert alert-info rounded-0 border border-info">Want to borrow this book?<br> Then login with your library login credentials.</div>
                                            <?php } ?>
                                        <?php }else{ ?>
                                            <li class="list-group-item">  <b>Availability:</b>  <br>
                                                <span class="badge badge-danger">Out of Stock</span>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <?php include_once 'includes/sidebar.php'; ?>


            </div>

        </div>

    </section>

<?php include_once 'includes/footer.php'; ?>



