                <!--Category-->
                <div class="col-md-3 col-sm-12 mb-3">
                        <div class="mb-4 w-100">
                            <h4>Categories</h4>
                        </div>
                    <div class="card">
                        <div class="card-body p-1">
                            <ul class="list-group list-group-flush text-center">

                            <?php 
                                $getMainCatQuery = "SELECT cat_id AS main_cat_id, cat_name AS main_cat_name FROM  book_category_view WHERE cat_status='active' AND cat_parent=0";

                                $getMainCatQueryExecution = mysqli_query($conn, $getMainCatQuery);

                                while($mainCat = mysqli_fetch_assoc($getMainCatQueryExecution)){
                                    extract($mainCat);

                                    $getSubCatList = "SELECT cat_id AS sub_cat_id, cat_name AS sub_cat_name FROM book_category_view WHERE cat_status='active' AND cat_parent='$main_cat_id' ";

                                    $getSubCatListExecution = mysqli_query($conn, $getSubCatList);

                                    $subCatCounts = mysqli_num_rows($getSubCatListExecution);

                            ?>
                                <li class="list-group-item position-relative">
                                
                                <?php if($subCatCounts==0) { ?>
                                    <a class="nav-link p-0" href="category.php?cat_name=<?=str_replace(" ","+", $main_cat_name); ?>"><?=$main_cat_name;?></a>
                                <?php } else{ ?>
                                    <span class="text-primary p-0"><?=$main_cat_name;?></span>
                                <?php } ?>

                                    <?php if($subCatCounts>0){ ?>
                                        <div class="dropdown position-absolute dropdown-btn">
                                        <button class="btn dropdown-toggle btn-light" type="button" data-toggle="dropdown">
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-custom dropdown-menu-right" >
                                        
                                        <?php while($subCat = mysqli_fetch_assoc($getSubCatListExecution) ){
                                            extract($subCat); 
                                        ?>
                                          <a class="dropdown-item text-primary" href="category.php?cat_name=<?=str_replace(" ","+", $sub_cat_name); ?>" ><?=$sub_cat_name; ?></a>
                                          <?php } ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                              </ul>
                        </div>
                    </div>


                </div>