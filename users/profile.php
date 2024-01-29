<?php
    session_start();
    require 'assets/connect.php';

    if(!isset($_SESSION['libertyPostsloggedID'])){ header('location:sign_in.php');}

    // Update user profile 
    if (isset($_POST['editProfile'])) {
        $userID = mysqli_real_escape_string($db, $_POST['userID']);
        $fullname = mysqli_real_escape_string($db, $_POST['fullname']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $phone = mysqli_real_escape_string($db, $_POST['phone']);
        $username = mysqli_real_escape_string($db, $_POST['username']);
            
        $sql = "UPDATE users SET fullname='$fullname', email='$email', phone='$phone', username='$username' WHERE userID='$userID' ";
        if ($query_run = mysqli_query($db, $sql)) {
            header("location: profile.php?msg=up");
        } else {
            echo 'Error'.$sql.'<br>'.$db->error;
        }   
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Abdulwasi Biodun Popoola (+234 809 457 7533 || adihzah2013@gmail.com)">
        <meta name="generator" content="">
        <link rel="shortcut icon" type="image/x-icon" href="imgs/icon.png">
        <title>LibertyPosts</title>
        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="../css/style.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <!-- Web Font -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    </head>
    <body>
        
        <!-- navbar -->
        <?php require 'assets/navbar.php'; ?>

        <main>
            <div class="container">
                <div class="row">

                    <!--left sidebar nav--> 
                    <div class="col-sm-3 col-md-3 col-lg-3">
                        <?php require 'assets/sidebar-nav.php'; ?>
                    </div>

                    <!--users right menu-->
                    <div class="col-sm-9 col-md-9 col-lg-9">
                        <div class="heading">User Profile <hr></div>
                            <?php 
                                // posted successful
                                if (isset($_GET['msg']) AND $_GET['msg']=='up') {
                                    echo "<div class='text-primary text-center mt-2'>Profile Updated!</div>";
                                } 
                            ?>
                        <div class="profile">
                            <div class="data-box">
                                <label for="">Username:</label>
                                <input type="text" value="<?php echo $_SESSION['username']; ?>">
                            </div>
                            <div class="data-box">
                                <label for="">Fullname:</label>
                                <input type="text" value="<?php echo $_SESSION['fullname']; ?>">
                            </div>
                            <div class="data-box">
                                <label for="">Email Address:</label>
                                <input type="text" value="<?php echo $_SESSION['email']; ?>">
                            </div>
                            <div class="data-box">
                                <label for="">Mobile Number:</label>
                                <input type="text" value="<?php echo $_SESSION['phone']; ?>">
                            </div>

                            <button class="btn btn-primary" data-bs-toggle='modal' data-bs-target="#rateModal">Edit Profile</button>

                            <!-- RATE MODAL-->
                            <div class="modal fade" id="rateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">EDIT PROFILE</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="form-box">
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="userID" class="form-control" value="<?php echo $_SESSION['userID']; ?>" readonly>
                                                    <label for=""><b>Username</b></label>
                                                    <input type="text" name="username" class="form-control" value="<?php echo $_SESSION['username']; ?>" required>
                                                    <label for=""><b>Fullname</b></label>
                                                    <input type="text" name="fullname" class="form-control" value="<?php echo $_SESSION['fullname']; ?>" required>
                                                    <label for=""><b>Email Address</b></label>
                                                    <input type="email" name="email" class="form-control" value="<?php echo $_SESSION['email']; ?>" required>
                                                    <label for=""><b>Mobile Number</b></label>
                                                    <input type="text" name="phone" class="form-control" value="<?php echo $_SESSION['phone']; ?>" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="editProfile" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- RATE MODAL-->
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
        <!-- footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-5 col-md-5 col-lg-5">
                        <i class="fa fa-copyright"></i> 2023 All Copyright Reserved.
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <a href="index.php" class="brand"><img src="imgs/brand.png" alt="logo"></a>
                    </div>
                    <div class="col-sm-5 col-md-5 col-lg-5">
                        <span>Powered by: <a href="#">All-Embracing Softwork</a></span>
                    </div>
                </div>
            </div>
        </footer>

        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap.bundle.min.js"></script>
    </body>
</html>
