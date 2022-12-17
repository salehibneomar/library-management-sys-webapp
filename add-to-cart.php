<?php

include_once 'config/init.php';

if(!isset($_SESSION['loggedInMember'])
    || empty($_SESSION['loggedInMember'])
    || empty(trim($_SESSION['loggedInMember']['u_email']))
    || empty(trim($_SESSION['loggedInMember']['u_pass']))){

        header("Location: index.php");
        exit();

}


    if(isset($_GET['book_id']) && trim($_GET['book_id'])!=""){
        $book_id = mysqli_real_escape_string($conn, trim($_GET['book_id']));
        echo $book_id."<br>";

        $getBookDataQuery = "SELECT * FROM book_view WHERE b_id='$book_id' AND b_status='public'";
        $getBookDataQueryExecution = mysqli_query($conn, $getBookDataQuery);
        $bookData = mysqli_fetch_assoc($getBookDataQueryExecution);

        if($bookData==null){
            $_SESSION['alert']['msg']  = "No such book exists!";
            $_SESSION['alert']['type'] = "info";
        }
        else if($bookData['b_quantity']<1){
            $_SESSION['alert']['msg']  = "Sorry this book is out of stock!";
            $_SESSION['alert']['type'] = "error";
        }
        else{
            extract($bookData);

            if(!isset($_SESSION['cart'])){
                $_SESSION['cart']                = array();
                $_SESSION['cart']['book_id']     = array();
                $_SESSION['cart']['book_title']  = array();
                $_SESSION['cart']['book_cat']    = array();
            }

            $hasError = false;
            
            array_push($_SESSION['cart']['book_id'],    $b_id);
            array_push($_SESSION['cart']['book_title'], $b_title);
            array_push($_SESSION['cart']['book_cat'],   $b_cat_name);
            
            $countOccurances = array_count_values($_SESSION['cart']['book_id']);

            if($countOccurances[$b_id]>1){

                array_pop($_SESSION['cart']['book_id']);
                array_pop($_SESSION['cart']['book_title']);
                array_pop($_SESSION['cart']['book_cat']);
                
                $_SESSION['alert']['msg']  = "This book is already in the cart!";
                $_SESSION['alert']['type'] = "error";
                $hasError = true;
            }



            if(count($_SESSION['cart']['book_id'])>3){

                array_pop($_SESSION['cart']['book_id']);
                array_pop($_SESSION['cart']['book_title']);
                array_pop($_SESSION['cart']['book_cat']);

                $_SESSION['alert']['msg']  = "You cannot add more than 3 books at a time!";
                $_SESSION['alert']['type'] = "error";
                $hasError = true;
            }


            if(!$hasError){
                $_SESSION['alert']['msg']  = "Successfully added to cart!";
                $_SESSION['alert']['type'] = "success";
            }
            
            
        }


    }


    header("Location: index.php");
    exit();

    $conn->close();
    ob_end_flush();
?>