<?php

require_once  '../config/db.php';
ob_start();
require_once '../config/session.php';

$table      = 'library_management';
$primaryKey = 'mgt_id';
$loggedInUser    = $_SESSION['loggedInUser']['mgt_role'];
$loggedInUserId  = $_SESSION['loggedInUser']['mgt_id'];
$iteMgtRole = null;

$columns = array(
    array( 
        'db' => 'mgt_id', 
        'dt' => 0,
        'formatter'=> function($d, $row){
            return '<span class="badge badge-dark">'.$d.'</span>';
        }
    ),
    array( 
        'db' => 'mgt_profile_image', 
        'dt' => 1,
        'formatter'=> function($d, $row){
            $image = '<img class="table-thumbnail" src="images/management/'.$d.'">';
            return $image;
        }
    ),
    array( 
        'db' => 'mgt_name', 
        'dt' => 2
    ),
    array( 
        'db' => 'mgt_gender', 
        'dt' => 3,
        'formatter' => function($d, $row){
            $badge = ($d=='male') ? 'info' : 'danger';
            return '<span class="badge badge-'.$badge.'">'.ucfirst($d).'</span>';
        }
    ),
    array( 
        'db' => 'mgt_phone', 
        'dt' => 4
    ),
    array( 
        'db' => 'mgt_joined_date', 
        'dt' => 5,
        'formatter' => function($d, $row){
            return date('jS M y', strtotime($d));
        }
    ),
    array( 
        'db' => 'mgt_role', 
        'dt' => 6,
        'formatter' => function($d, $row){
            global $iteMgtRole;
            $iteMgtRole = $d;
            $badge = ($d=='admin') ? 'primary' : 'secondary';
            return '<span class="badge badge-'.$badge.'">'.ucfirst($d).'</span>';
        }
    ),
    array( 
        'db' => 'mgt_status', 
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
        'db' => 'mgt_id', 
        'dt' => 8,
        'formatter' => function($d, $row){

            global $loggedInUser, $iteMgtRole;

            $view = 
            '<a class="btn btn-success btn-sm mb-1" href="profile.php?uid='.$d.'">
                View
            </a>';
            $edit = 
            '<a class="btn btn-info btn-sm mb-1" href="management.php?action=edit&edit_id='.$d.'">
                Edit
            </a>';
                    
            $delete = 
            '<a class="btn btn-danger btn-sm mb-1 swal-delete-trigger" href="management.php?action=delete&delete_id='.$d.'">
                Delete
            </a>';

            $action = $view;

            if($loggedInUser=='admin' && $iteMgtRole=='editor'){
                $action = $view." ".$edit." ".$delete;
            }

            return $action;
        }
    )

    
);

require( 'ssp.class.php' );

$where = "mgt_id!={$loggedInUserId}";

echo json_encode(
    SSP::complex( $_GET, DB::getDBproperty(), $table, $primaryKey, $columns, $where )
);

unset($loggedInUser, $iteMgtRolem, $loggedInUserId);
ob_end_flush();

?>