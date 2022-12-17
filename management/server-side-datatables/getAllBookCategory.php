<?php

require_once  '../config/db.php';

$table      = 'book_category_view';
$primaryKey = 'cat_id';

$columns = array(
    array( 
        'db' => 'cat_id', 
        'dt' => 0,
        'formatter'=> function($d, $row){
            return '<span class="badge badge-dark">'.$d.'</span>';
        }
    ),
    array( 
        'db' => 'cat_name', 
        'dt' => 1
    ),
    array( 
        'db' => 'cat_status', 
        'dt' => 2,
        'formatter' => function($d, $row){
            if($d=='inactive'){
                return '<span class="badge badge-danger">Inactive</span>';
            }

            return '<span class="badge badge-success">Active</span>';
        }
    ),
    array( 
        'db' => 'cat_parent_name', 
        'dt' => 3,
        'formatter' => function($d, $row){
            if($d==null){
                return '<span class="badge badge-primary">Main</span>';
            }

            return '<span class="badge badge-secondary">'.$d.'</span>';
            
        }
    ),
    array( 
        'db' => 'cat_id', 
        'dt' => 4,
        'formatter' => function($d, $row){

            $edit = 
            '<a class="btn btn-info btn-sm mb-1" href="category.php?action=edit&edit_id='.$d.'">
                Edit
            </a>';

            $delete = 
            '<a class="btn btn-danger btn-sm mb-1 swal-delete-trigger" href="category.php?action=delete&delete_id='.$d.'">
                Delete
            </a>';

            $action = $edit." ".$delete;

            return $action;
        }
    )
    
);

require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, DB::getDBproperty(), $table, $primaryKey, $columns )
);



?>