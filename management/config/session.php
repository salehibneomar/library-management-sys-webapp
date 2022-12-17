<?php
    session_start();
    
    if(!isset($_SESSION['loggedInUser'])
    || empty($_SESSION['loggedInUser'])
    || empty(trim($_SESSION['loggedInUser']['mgt_email']))
    || empty(trim($_SESSION['loggedInUser']['mgt_pass']))){
      
    header("Location: logout.php");
    exit();
    }
    
?>