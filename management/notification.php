<?php

    include_once 'config/init.php';

    if(isset($_GET['type']) && !empty($_GET['type'])){
        $url = "Location: dashboard.php";

        $type = mysqli_real_escape_string($conn, trim($_GET['type']));

        if($type==1 && $_SESSION['loggedInUser']['mgt_role']!='admin'){
            header($url);
            exit();
        }

        $notificationUpdateQuery = "UPDATE library_management_notification SET mgt_nstatus=1 WHERE mgt_ntype='$type'";
        $notificationUpdateQueryExecution = mysqli_query($conn, $notificationUpdateQuery);

        
        if($type==1){
            $url = "Location: management.php";
        }
        else if($type==2){
            $url = "Location: book-request.php";
        }
        else if($type==3){
            $url = "Location: member.php";
        }

        header($url);
        exit();
        
        
    }
    


    $conn->close();
    ob_end_flash();
?>

