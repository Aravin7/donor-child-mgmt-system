<?php
session_start();
include 'functions.php';
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Donation System - Login</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= SYSTEM_PATH ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <?php
                                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                                        //$UserName = '';  // Default empty value
                                        //$Password = '';  // Default empty value
                                        extract($_POST);
                                        //echo $UserName;
                                        //we dont clean password
                                        $Email = cleanInput($Email);

                                        $message = array();

                                         if (empty($Email)) {
                                            $message['error_username'] = "The email should not be blank";
                                         }
                                         if (empty($Password)) {
                                             $message['error_password'] = "The password should not be blank";
                                         }
                                         if(empty($message)){
                                            //check and change
                                             //$Password= sha1($Password);
                                             $sql = "SELECT * FROM tbl_users WHERE Email='$Email' AND Password='$Password'";
                                             $db = dbConnection();
                                             $result = $db->query($sql);
                                             print_r($result);
                                             if($result->num_rows<=0){
                                                 $message['error_login'] = "Invalid User name or password";
                                             }else{
                                                 echo "success";
                                                   $row = $result->fetch_assoc();
                                                   $_SESSION['userid'] = $row['UserId'];
                                                   $_SESSION['title'] = $row['Title'];
                                                   $_SESSION['firstname'] = $row['FirstName'];
                                                   $_SESSION['lastname'] = $row['LastName'];
                                                   $_SESSION['userrole'] = $row['UserRole'];
                                                  header("Location:index.php");
                                             }
                                        }
                                    }
                                    ?>
                                    <form class="user" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                        <div class="text-danger"><?= @$message['error_username'] ?></div>
                                        <div class="text-danger"><?= @$message['error_password'] ?></div>
                                        <div class="text-danger"><?= @$message['error_login'] ?></div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                            id="Email" name="Email" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                            id="Password" name="Password" placeholder="Password">
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" type="submit">
                                            Login
                                        </button>
                                        <hr>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="<?= SYSTEM_PATH ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= SYSTEM_PATH ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= SYSTEM_PATH ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= SYSTEM_PATH ?>assets/js/sb-admin-2.min.js"></script>

</body>

</html>