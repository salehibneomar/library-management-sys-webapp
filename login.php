<?php include_once 'includes/header.php'; ?>

<?php if($hasLoggedInMember){ header("Location: index.php"); exit(); } ?>
    <section class="main-section mx-auto">

        <div class="container-fluid">
            
            <div class="row">

                
                <!--Books-->
                <div class="col-lg-5 col-md-8 col-sm-10 mx-auto mt-5">
                    
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="card-title">Login Panel</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" type="email" name="email" id="email"  required>
                                </div>
                                <div class="form-group">
                                    <label for="pass">Password</label>
                                    <input class="form-control" type="password" name="pass" id="pass" autocomplete="off" required>
                                </div>
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary" name="loginBtn">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

                <?php
                    if(isset($_POST['loginBtn'])){

                        extract($_POST);
                        $email = mysqli_real_escape_string($conn, trim($email));
                        $pass  = mysqli_real_escape_string($conn, trim($pass));


                        $formErrors = array();

                        if(empty($email)){
                        $formErrors[] = "Email is empty!";
                        }

                        if(empty($pass)){
                        $formErrors[] = "Password is empty!";
                        }

                        $hasErrors = false;

                        if(!empty($formErrors)){
                            $formErrors = implode("<br>",$formErrors);
                            $_SESSION['alert']['msg']  = $formErrors;
                            $_SESSION['alert']['type'] = "error";
                            $hasErrors = true;
                        }
                        else{
                        $pass = SHA1($pass);
                        $loginUserQuery = "SELECT * FROM library_user WHERE u_email='$email' AND u_pass='$pass' LIMIT 1";

                        $loginUserQueryExecution = mysqli_query($conn, $loginUserQuery);

                            if(mysqli_num_rows($loginUserQueryExecution)==1){
                                

                                $data = mysqli_fetch_assoc($loginUserQueryExecution);

                                if($data['u_status']=='inactive'){
                                    $_SESSION['alert']['msg']  = "Your ID is locked contact a Librarian!";
                                    $_SESSION['alert']['type'] = "error";
                                    $hasErrors = true;
                                }
                                else if($data['u_status']=='pending'){
                                    $_SESSION['alert']['msg']  = "Your ID is under review, usually it takes 24hrs to verify a member account, please be patient!";
                                    $_SESSION['alert']['type'] = "info";
                                    $hasErrors = true;
                                }
                                else{
                                $_SESSION['loggedInMember'] = $data;
                                header("Location: index.php");
                                exit();
                                }
                            }
                            else{
                                $_SESSION['alert']['msg']  = "Invalid Login Information!";
                                $_SESSION['alert']['type'] = "error";
                                $hasErrors = true;
                            }
                        }

                        if($hasErrors){
                            header("Location: login.php");
                            exit();
                        }

                    }
                ?>
            </div>

        </div>

    </section>

<?php include_once 'includes/footer.php'; ?>



