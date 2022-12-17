<?php include_once 'includes/header.php'; ?>

<?php include_once 'includes/searchbar.php'; ?> 

    <section class="main-section mx-auto">

        <div class="container-fluid">
            
            <div class="row">

                
                <!--Books-->
                <div class="col-md-9 col-sm-12 mb-3">
                    
                    <div class="row">
                    <?php 
                        if(isset($_GET['search_key']) && trim($_GET['search_key'])!=""){
                            $search_key = str_replace("+"," ", trim($_GET['search_key']));
                            $search_key = mysqli_real_escape_string($conn, $search_key);
                        }
                        else{
                            header("Location: index.php");
                            exit();
                        }
                        
                        $totalData = $conn->query("SELECT b_id FROM book_view WHERE b_status='public' AND (b_title LIKE '%$search_key%' OR b_published_year LIKE '%$search_key%' OR b_author LIKE '%$search_key%' OR b_language LIKE '%$search_key%' OR b_publication LIKE '%$search_key%' OR b_cat_name LIKE '%$search_key%' OR b_cat_parent_name LIKE '%$search_key%' ) ")->num_rows;

                        if($totalData<1){
                    ?>

                        <div class="col-md-12  mb-3">
                            <div class="alert alert-info border border-info">No books found for the key <b><?=$search_key.".";?></b> </div>
                        </div>

                        <?php

                        }else{ ?>
                        <div class="col-md-12  mb-3">
                            <div class="alert alert-success border border-success"><?php if($totalData==1){ echo $totalData." book"; }else { echo $totalData." books"; } ?> found for the key <b><?=$search_key.".";?></b></div>
                        </div>
                        <?php
                            $limit = 6;
                            $totalRequiredPages = ceil($totalData/$limit);
                            
                            $currPage = 1;

                            if(isset($_GET['page']) && trim($_GET['page'])!=""){
                                $currPage = mysqli_real_escape_string($conn, trim($_GET['page']));
                        
                                if($currPage<1 || $currPage>$totalRequiredPages){
                                    header("Location: search.php?search_key={$search_key}&page=1");
                                    exit();
                                }
                        
                            }
                            
                            $start = ($currPage-1)*$limit;

                            $getAllBooksQuery = "SELECT * FROM book_view WHERE b_status='public' AND (b_title LIKE '%$search_key%' OR b_published_year LIKE '%$search_key%' OR b_author LIKE '%$search_key%' OR b_language LIKE '%$search_key%' OR b_publication LIKE '%$search_key%' OR b_cat_name LIKE '%$search_key%' OR b_cat_parent_name LIKE '%$search_key%' ) ORDER BY b_id DESC LIMIT $start, $limit";

                            $getAllBooksQueryExecution = mysqli_query($conn, $getAllBooksQuery);

                            while($book = mysqli_fetch_assoc($getAllBooksQueryExecution)){
                                extract($book);
                        ?>
                        <div class="col-md-4 col-sm-6 mb-4">

                            <div class="card w-100 border border-light" >
                                <div class="position-relative">
                                <img class="card-img-top " src="management/images/book/<?=$b_image;?>" >
                                    <div class="d-block text-truncate w-100 tag position-absolute bg-info text-white py-1 px-2 m-0 border border-info text-center">
                                        <?=$b_cat_name; ?>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title d-block text-truncate w-100 py-1"><?=$b_title; ?></h5>
                                    <?php if($b_quantity>0){ ?>
                                        <span class="badge badge-success">In Stock</span>
                                    <?php } else{ ?>
                                        <span class="badge badge-danger">Out of Stock</span>
                                    <?php } ?>
                                    <p class="mt-3 card-text text-danger mb-4 d-block text-truncate w-100">
                                        <i class="fas fa-pen-square"></i>&ensp;<?=explode("," ,$b_author)[0];?>
                                    </p>
                                    <?php 
                                        $disabled = $b_quantity<1 ? 'disabled' : null;
                                        if($hasLoggedInMember){ ?>
                                    <a href="add-to-cart.php?book_id=<?=$b_id; ?>" class="btn btn-secondary mb-1 mr-2 <?=$disabled; ?> "><i class="fas fa-cart-plus"></i></a>
                                    <?php } ?>
                                    <a href="single-book.php?book_id=<?=$b_id;?>" class="btn btn-primary mb-1">View details</a>
                                </div>
                            </div>

                        </div>
                        <?php } if($totalRequiredPages>1){ ?>

                        
                        <div class="col-md-12 ">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center mt-5">
                                <?php
                                    $prevBtnDisabled = ($currPage==1) ? "disabled" : null; 
                                    $nextBtnDisabled = ($currPage==$totalRequiredPages) ? "disabled" : null;

                                    $startPaging = max(1, $currPage-2);
                                    $endPaging   = min($startPaging+4, $totalRequiredPages);
                                ?>
                                    <li class="page-item <?=$prevBtnDisabled; ?>">
                                    <a class="page-link" href="search.php?search_key=<?=$search_key;?>&page=<?=($currPage-1); ?>" >Previous</a>
                                    </li>
                                    <li class="page-item <?=$prevBtnDisabled; ?>">
                                    <a class="page-link" href="search.php?page=1" >First</a>
                                    </li>

                                    <?php
                                        for($i=$startPaging; $i<=$endPaging; $i++){
                                            $active = ($i==$currPage) ? "active" : null;
                                        
                                    ?>
                                        <li class="page-item <?=$active; ?>"><a class="page-link" href="search.php?search_key=<?=$search_key;?>&page=<?=$i; ?> "><?=$i; ?></a></li>

                                    <?php } ?>


                                    <li class="page-item <?=$nextBtnDisabled; ?>">
                                    <a class="page-link" href="search.php?search_key=<?=$search_key;?>&page=<?=$totalRequiredPages; ?>">Last</a>
                                    </li>
                                    <li class="page-item <?=$nextBtnDisabled; ?>">
                                    <a class="page-link" href="search.php?search_key=<?=$search_key;?>&page=<?=($currPage+1); ?>">Next</a>
                                    </li>
                                </ul>
                            </nav>

                        </div>
                        <?php } } ?>


                    </div>

                </div>

                <?php include_once 'includes/sidebar.php'; ?>


            </div>

        </div>

    </section>

<?php include_once 'includes/footer.php'; ?>



