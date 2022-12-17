<?php include_once 'includes/header.php'; ?>

<?php if(!$hasLoggedInMember){ header("Location: index.php"); exit(); } ?>

    <section class="main-section mx-auto">

        <div class="container-fluid">
            
            <div class="row">

            <!--Cart-->
            <div class="col-md-8 mx-auto mt-5">

                <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart']['book_id'])){ ?>
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="card-title">Cart</h5>
                        </div>
                        <div class="card-body">
                        <ul class="list-group list-group-flush d-block">
                            <?php 

                                $bookIdArr = $bookTitleArr = $bookCatArr = null;
                                $track = 1;

                                foreach($_SESSION['cart'] as $cartValues){
                                    if($track==1){
                                        $bookIdArr = implode(",", $cartValues);
                                    }
                                    else if($track==2){
                                        $bookTitleArr = implode(",", $cartValues);
                                    }
                                    else if($track==3){
                                        $bookCatArr = implode(",", $cartValues);
                                    }

                                    $track++;
                                }
                                
                                    $book_ids     = $bookIdArr;

                                    $bookIdArr    = explode(",",$bookIdArr);
                                    $bookTitleArr = explode(",",$bookTitleArr);
                                    $bookCatArr   = explode(",",$bookCatArr);

                                    

                                    $totalCartValues = count($bookIdArr);
                                    
                                    for($i=0; $i<$totalCartValues; $i++){

                            
                                ?>
                                    
                                    <li class="list-group-item d-block">
                                        <!--<div>
                                            <a class="btn btn-sm btn-danger float-right">Remove</a>
                                        </div>
                                        <br> <br> -->
                                        <p>
                                            <b>Book Id: </b>
                                            <small><?=$bookIdArr[$i];?></small> <br>
                                            <b>Title: </b>
                                            <small><?=$bookTitleArr[$i];?></small> <br>
                                            <b>Category: </b>
                                            <small><?=$bookCatArr[$i];?></small>
                                        </p>
                                    </li> 
                                    
                                <?php } ?>
                                </ul>
                        </div>

                        <div class="card-footer">
                                <form action="" method="post">
                                        <div class="row p-3">
                                            <div class="col-md-12 mb-2">
                                                <b>Select borrow date ranges</b>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="from">From</label>
                                                <input class="form-control" type="date" name="fromDate" id="from" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="to">To</label>
                                                <input class="form-control" type="date" name="toDate" id="to" required>
                                            </div>
                                            
                                            <div class="col-md-12 mb-4 mt-3 text-right">
                                                <a href="view-cart.php?clear_cart=true" class="btn btn-danger mr-3" type="submit" name="clearCart">Clear cart</a>

                                                <button class="btn btn-primary" type="submit" name="confirm">Confirm</button>
                                            </div>

                                        </div>

                                </form>
                        </div>

                        <?php
                            if(isset($_GET['clear_cart']) && $_GET['clear_cart']=='true'){
                                unset($_SESSION['cart']);
                                header("Location: view-cart.php");
                                exit();
                            }

                            if(isset($_POST['confirm'])){
                                $requested_by   = $_SESSION['loggedInMember']['u_id'];

                                $hasLibIssues  = $conn->query("SELECT br_id FROM book_borrow WHERE br_requested_by='$requested_by' AND br_status!='returned' ")->num_rows;

                                if($hasLibIssues>=1){
                                    header("Location: user-book-log.php");
                                    exit();
                                }

                                extract($_POST);

                                $dateDiff = date_diff(date_create($fromDate),date_create($toDate));

                                
                                if($dateDiff->format('%R')=="-"){
                                    $_SESSION['alert']['msg']  = "Invalid date range!";
                                    $_SESSION['alert']['type'] = "error";
                                }
                                else{
                                    if($dateDiff->format('%a')>20){
                                        $_SESSION['alert']['msg']  = "You cannot have books more than 20 days!";
                                        $_SESSION['alert']['type'] = "info";
                                    }
                                    else{
                                        
                                        $requested_date = date('Y-m-d');
                                        $total_books    = count($_SESSION['cart']['book_id']);
                                        $status         = 'pending';
                                        
                                        $updateBookQuantity = implode("' OR b_id='", $bookIdArr);
                                        $updateBookQuantity = "b_id='".$updateBookQuantity."'";
                                        
                                        $updateBookQuantityQuery = "UPDATE book SET b_quantity=(b_quantity-1) WHERE ".$updateBookQuantity;

                                        $mgtNotificationQuery = "INSERT INTO library_management_notification(mgt_ntype)
                                        VALUES('2')";


                                        $bookBorrowRequestQuery = "INSERT INTO 
                                        book_borrow(br_book_ids, br_requested_by, br_request_date, br_from_date, br_to_date, br_total, br_status) 
                                        VALUES ('$book_ids', '$requested_by', '$requested_date', '$fromDate', '$toDate', '$total_books', 'pending')";

                                        $bookBorrowRequestQueryExecution = mysqli_query($conn, $bookBorrowRequestQuery);

                                        if($bookBorrowRequestQueryExecution){

                                            $updateBookQuantityQueryExecution = mysqli_query($conn, $updateBookQuantityQuery);

                                            $mgtNotificationQueryExecution = mysqli_query($conn, $mgtNotificationQuery);

                                            $_SESSION['alert']['msg']  = "Request Submitted Successfully, wait for approval!";
                                            $_SESSION['alert']['type'] = "success";
                                            unset($_SESSION['cart']);
                                        }
                                        else{
                                            $_SESSION['alert']['msg']  = "Error occured!";
                                            $_SESSION['alert']['type'] = "error";
                                            
                                        }
                                    }

                                    header("Location: view-cart.php");
                                    exit();
                                }

                            }
                        ?>
                    </div>
                </div>
                <?php }else{ ?>
                    <div class="alert alert-info mt-3 border border-info">Cart is empty!</div>
                <?php } ?>
                
                </div>
            </div>

        </div>

    </section>

<?php include_once 'includes/footer.php'; ?>



