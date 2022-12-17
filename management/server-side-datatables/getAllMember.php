<?php

require_once  '../config/db.php';
ob_start();
require_once '../config/session.php';

$table      = 'library_user';
$primaryKey = 'u_id';


$columns = array(
    array( 
        'db' => 'u_id', 
        'dt' => 0,
        'formatter'=> function($d, $row){
            return '<span class="badge badge-dark">'.$d.'</span>';
        }
    ),
    array( 
        'db' => 'u_image', 
        'dt' => 1,
        'formatter'=> function($d, $row){
            $image = '<img class="table-thumbnail" src="../images/member/'.$d.'">';
            return $image;
        }
    ),
    array( 
        'db' => 'u_name', 
        'dt' => 2
    ),
    array( 
        'db' => 'u_gender', 
        'dt' => 3,
        'formatter' => function($d, $row){
            $badge = ($d=='male') ? 'info' : 'danger';
            return '<span class="badge badge-'.$badge.'">'.ucfirst($d).'</span>';
        }
    ),
    array( 
        'db' => 'u_phone', 
        'dt' => 4
    ),
    array( 
        'db' => 'u_email', 
        'dt' => 5
    ),
    array( 
        'db' => 'u_joined_date', 
        'dt' => 6,
        'formatter' => function($d, $row){
            return date('jS M y', strtotime($d));
        }
    ),
    array( 
        'db' => 'u_status', 
        'dt' => 7,
        'formatter' => function($d, $row){
            $badge = 'success';
            if($d=='inactive'){
                $badge = 'danger';
            }
            else if($d=='pending'){
                $badge = 'warning';
            }

            return '<span class="badge badge-'.$badge.'">'.ucfirst($d).'</span>';
        }
    ),
    array( 
        'db' => 'u_id', 
        'dt' => 8,
        'formatter' => function($d, $row){

            $view = 
            '<a class="btn btn-success btn-sm mb-1" href="member-profile.php?mid='.$d.'">
                View
            </a>';
            $edit = 
            '<a class="btn btn-info btn-sm mb-1" href="member.php?action=edit&edit_id='.$d.'">
                Edit
            </a>';

            $action = $view." ".$edit;

            return $action;
        }
    )

    
);

require( 'ssp.class.php' );


echo json_encode(
    SSP::complex( $_GET, DB::getDBproperty(), $table, $primaryKey, $columns )
);


ob_end_flush();

?>