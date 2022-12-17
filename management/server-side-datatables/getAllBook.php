<?php

require_once  '../config/db.php';
ob_start();
require_once '../config/session.php';

$table      = 'book_view';
$primaryKey = 'b_id';


$columns = array(
    array( 
        'db' => 'b_id', 
        'dt' => 0,
        'formatter'=> function($d, $row){
            return '<span class="badge badge-dark">'.$d.'</span>';
        }
    ),
    array( 
        'db' => 'b_image', 
        'dt' => 1,
        'formatter'=> function($d, $row){
            $image = '<img class="table-thumbnail" src="images/book/'.$d.'">';
            return $image;
        }
    ),
    array( 
        'db' => 'b_title', 
        'dt' => 2,
        'formatter'=> function($d, $row){
            return '<span class="truncate-text-custom">'.$d.'</span>';
        }
    ),
    array( 
        'db' => 'b_author', 
        'dt' => 3,
        'formatter'=> function($d, $row){
            $authors = explode(",", $d);
            $authors = implode(",<br>", $authors);

            return '<small>'.$authors.'</small>';
        }
    ),
    array( 
        'db' => 'b_cat_name', 
        'dt' => 4
    ),
    array( 
        'db' => 'b_publication', 
        'dt' => 5,
        'formatter'=> function($d, $row){
            return '<span class="d-block text-truncate">'.$d.'</span>';
        }
    ),
    array( 
        'db' => 'b_quantity', 
        'dt' => 6,
        'formatter'=> function($d, $row){
            if($d==0){
                return '<span class="badge badge-danger">Out of <br> stock</span>';
            }

            return '<span class="badge badge-info">'.$d.'</span>';
        }
    ),
    array( 
        'db' => 'b_status', 
        'dt' => 7,
        'formatter'=> function($d, $row){
            $badge = ($d=='public') ? 'success' : 'danger';
            return '<span class="badge badge-'.$badge.'">'.ucfirst($d).'</span>';

        }
    ),
    array( 
        'db' => 'b_id', 
        'dt' => 8,
        'formatter'=> function($d, $row){
            $view = 
            '<a class="btn btn-success btn-sm mb-1" href="single-book.php?bid='.$d.'">
                View
            </a>';
            $edit = 
            '<a class="btn btn-info btn-sm mb-1" href="book.php?action=edit&edit_id='.$d.'">
                Edit
            </a>';

            $cart =
            '<a class="btn btn-secondary btn-sm mb-1" href="">
                Cart
            </a>';

            $action = $view." ".$edit." ".$cart;

            return $action;
        }
    ),

    
);

require( 'ssp.class.php' );


echo json_encode(
    SSP::complex( $_GET, DB::getDBproperty(), $table, $primaryKey, $columns )
);


ob_end_flush();

?>