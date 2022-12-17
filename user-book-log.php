<?php include_once 'includes/header.php'; ?>

<?php if(!$hasLoggedInMember){ header("Location: index.php"); exit(); } ?>

    <section class="main-section mx-auto">

        <div class="container-fluid">
            
            <div class="row">

                <!--Cart-->
                <div class="col-md-12 mx-auto mt-5">
                    <?php
                        $requestedBy = $_SESSION['loggedInMember']['u_id'];

                        $totalData = $conn->query("SELECT * FROM book_borrow_view WHERE br_requested_by='$requestedBy'")->num_rows;

                        if($totalData<1){

                    ?>
                        <div class="alert alert-info border border-info">No data found</div>
                    <?php }else{ 
                        
                        $limit = 5;
                        $totalRequiredPages = ceil($totalData/$limit);

                        //echo $totalRequiredPages;
                        
                        $currPage = 1;

                        if(isset($_GET['page']) && trim($_GET['page'])!=""){
                            $currPage = mysqli_real_escape_string($conn, trim($_GET['page']));
                    
                            if($currPage<1 || $currPage>$totalRequiredPages){
                                header("Location: user-book-log.php?page=1");
                                exit();
                            }
                    
                        }
                        
                        $start = ($currPage-1)*$limit;

                        $getAllReqLog = "SELECT * FROM book_borrow_view WHERE br_requested_by='$requestedBy' ORDER BY br_id DESC LIMIT $start, $limit";

                        $getAllReqLogExecution = mysqli_query($conn, $getAllReqLog)
                    ?>
                        <div class="card mt-3">
                            <div class="card-header">
                                <h5 class="card-title">Book Borrow Log</h5>
                                <?php 
                                    $totalData = $conn->query("SELECT br_id FROM book_borrow WHERE br_requested_by='$requestedBy' AND br_status!='returned' ")->num_rows;

                                    if($totalData>=1){
                                ?>
                                    <div class="text-center alert alert-warning border border-warning">You might have <b>Pending</b>, <b>Currently Borrowed</b>, or <b>Not Returned</b> books, so you won't be able to borrow new books untill your dues are cleared. <br>
                                    Contact a librarian if you are seeing this message if you don't have above mentioned issues.
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th >#SL</th>
                                            <th >Requested</th>
                                            <th >From</th>
                                            <th >To</th>
                                            <th >Total Books</th>
                                            <th >Remaining</th>
                                            <th >Status</th>
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    <?php $sl=1; while($row = mysqli_fetch_assoc($getAllReqLogExecution)){
                                        extract($row);
                                    ?>
                                        <tr>
                                            <td><?=$sl; ?></td>
                                            <td><?=date('jS M y', strtotime($br_request_date)); ?></td>
                                            <td><?=date('jS M y', strtotime($br_from_date)); ?></td>
                                            <td><?=date('jS M y', strtotime($br_to_date)); ?> </td>
                                            <td><?=$br_total; ?></td>
                                            <td>
                                            <?php

                                                $currDate = date_create(date('Y-m-d'));
                                                $toDate   = date_create($br_to_date);

                                                $dateDiff = date_diff($currDate, $toDate);

                                                if($dateDiff->format("%R")=="-"){
                                                    echo '<span class="badge badge-danger">Time over</span>';
                                                }
                                                else if($dateDiff->format("%a")=="0"){
                                                    echo '<span class="badge badge-warning">Dead line</span>';
                                                }
                                                else{
                                                    echo '<span class="badge badge-success">'.$dateDiff->format("%a").' Days</span>';
                                                }

                                            ?>
                                            </td>
                                            <td>
                                                <?php if($br_status=="pending"){ ?>
                                                    <span class="badge badge-warning">Pending</span>
                                                <?php }else if($br_status=="accepted"){ ?>
                                                    <span class="badge badge-secondary">Accepted</span>
                                                <?php }else if($br_status=="returned"){ ?>
                                                    <span class="badge badge-success">Returned</span>
                                                <?php }else{ ?>
                                                    <span class="badge badge-danger">Not returned</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-success btn-sm" href="">Books</a>
                                            </td>
                                        </tr>
                                    <?php $sl++; } ?> 
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
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
                                                <a class="page-link" href="user-book-log.php?page=<?=($currPage-1); ?>" >Previous</a>
                                                </li>
                                                <li class="page-item <?=$prevBtnDisabled; ?>">
                                                <a class="page-link" href="user-book-log.php?page=1" >First</a>
                                                </li>

                                                <?php
                                                    for($i=$startPaging; $i<=$endPaging; $i++){
                                                        $active = ($i==$currPage) ? "active" : null;
                                                    
                                                ?>
                                                    <li class="page-item <?=$active; ?>"><a class="page-link" href="user-book-log.php?page=<?=$i; ?> "><?=$i; ?></a></li>

                                                <?php } ?>


                                                <li class="page-item <?=$nextBtnDisabled; ?>">
                                                <a class="page-link" href="user-book-log.php?page=<?=$totalRequiredPages; ?>">Last</a>
                                                </li>
                                                <li class="page-item <?=$nextBtnDisabled; ?>">
                                                <a class="page-link" href="user-book-log.php?page=<?=($currPage+1); ?>">Next</a>
                                                </li>
                                            </ul>
                                        </nav>

                                    </div>
                            </div>
                        </div>

                    <?php } ?>    
                </div>
                
            </div>

        </div>

    </section>

<?php include_once 'includes/footer.php'; ?>



