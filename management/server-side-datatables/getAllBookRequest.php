<?php

date_default_timezone_set('Asia/Dhaka');
require_once  '../config/db.php';
ob_start();
require_once '../config/session.php';

$table       = 'book_borrow_view';
$primaryKey  = 'br_id';
$book_status = null;
$toDate      = null;

$columns = array(
    array( 
        'db' => 'br_id', 
        'dt' => 0,
        'formatter'=> function($d, $row){
            return '<span class="badge badge-dark">'.$d.'</span>';
        }
    ),
    array( 
        'db' => 'br_requested_by', 
        'dt' => 1
    ),
    array( 
        'db' => 'br_u_name', 
        'dt' => 2
    ),
    array( 
        'db' => 'br_request_date', 
        'dt' => 3,
        'formatter' => function($d, $row){
            return date('jS M y', strtotime($d));
        }
    ),
    array( 
        'db' => 'br_from_date', 
        'dt' => 4,
        'formatter' => function($d, $row){
            return date('jS M y', strtotime($d));
        }
    ),
    array( 
        'db' => 'br_to_date', 
        'dt' => 5,
        'formatter' => function($d, $row){
            global $toDate;
            $toDate = $d;
            return date('jS M y', strtotime($d));
        }
    ),
    array( 
        'db' => 'br_total', 
        'dt' => 6
    ),
    array( 
        'db' => 'br_managed_by', 
        'dt' => 7,
        'formatter' => function($d, $row){
            $managedBy = $d;
            if($d==null || $d==""){
                $managedBy = "New Request";
            }
            return $managedBy;
        }
    ),
    array( 
        'db' => 'br_status', 
        'dt' => 8,
        'formatter' => function($d, $row){
            global $book_status;
            $book_status = $d;

            $badge = 'success';
            if($d=='not returned'){
                $badge = 'danger';
            }
            else if($d=='pending'){
                $badge = 'warning';
            }
            else if($d=='returned'){
                $badge = 'success';
            }
            else if($d=='accepted'){
                $badge = 'secondary';
            }

            return '<span class="badge badge-'.$badge.'">'.ucfirst($d).'</span>';
        }
    ),
    array( 
        'db' => 'br_status', 
        'dt' => 9,
        'formatter' => function($d, $row){
            global $toDate;
            $currDate = date_create(date('Y-m-d'));
            $toDate   = date_create($toDate);

            $dateDiff = date_diff($currDate, $toDate);

            if($dateDiff->format("%R")=="-"){
                return '<span class="badge badge-danger">Time over</span>';
            }
            else if($dateDiff->format("%a")=="0"){
                return '<span class="badge badge-warning">Dead line</span>';
            }
            else{
                return '<span class="badge badge-success">'.$dateDiff->format("%a").' Days</span>';
            }

        }
    ),
    array( 
        'db' => 'br_id', 
        'dt' => 10,
        'formatter' => function($d, $row){
            global $book_status;
            
            $view = 
            '<a class="btn btn-success btn-sm mb-1" href="book-request.php?action=view&view_id='.$d.'">
                Books
            </a>';
            $edit = 
            '<a class="btn btn-info btn-sm mb-1" href="book-request.php?action=edit&edit_id='.$d.'">
                Edit
            </a>';

            $action = $view." ".$edit;

            if($book_status=="returned"){
                $action = $view;
            }

            return $action;
        }
    )

    
);

require( 'ssp.class.php' );


echo json_encode(
    SSP::complex( $_GET, DB::getDBproperty(), $table, $primaryKey, $columns )
);

unset($book_status, $toDate);

ob_end_flush();

?>