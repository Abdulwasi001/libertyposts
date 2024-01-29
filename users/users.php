<?php
    session_start();
    require 'assets/connect.php';

    if(!isset($_SESSION['libertyPostsloggedID'])){ header('location:sign_in.php');}

    // add new user
    if (isset($_POST['adduser'])) {

        $fullname = mysqli_real_escape_string($db, $_POST['fullname']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $phone = mysqli_real_escape_string($db, $_POST['phone']);
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $passHash = md5($phone);

        // check if email already exist
        $checkemail = mysqli_query($db, "SELECT * FROM users WHERE email = '$email' ");
        // check if phone already exist
        $checkphone = mysqli_query($db, "SELECT * FROM users WHERE phone = '$phone' ");
        // check if username already exist
        $checkuser = mysqli_query($db, "SELECT * FROM users WHERE username = '$username' ");


        if (mysqli_num_rows($checkphone) == 1){
            header("location:users.php?msg=ph");
        } else if (mysqli_num_rows($checkemail) == 1){
            header("location:users.php?msg=em");
        } else if (mysqli_num_rows($checkuser) == 1){
            header("location:users.php?msg=us");
        } else {
            $sql = "INSERT INTO users (fullname, email, phone, username, pass) VALUES ('$fullname', '$email', '$phone', '$username', '$passHash')";
            if ($query_run = mysqli_query($db, $sql)) {
                header("location:users.php?msg=su");
            } else {
                echo 'Error'.$sql.'<br>'.$db->error;
            } 
        }
    }

    // Update user profile 
    if (isset($_POST['editProfile1'])) {
        $userID = mysqli_real_escape_string($db, $_POST['userID']);
        $fullname = mysqli_real_escape_string($db, $_POST['fullname']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $phone = mysqli_real_escape_string($db, $_POST['phone']);
        $username = mysqli_real_escape_string($db, $_POST['username']);
            
        $sql = "UPDATE users SET fullname='$fullname', email='$email', phone='$phone', username='$username' WHERE userID='$userID' ";
        if ($query_run = mysqli_query($db, $sql)) {
            header("location:users.php?msg=up");
        } else {
            echo 'Error'.$sql.'<br>'.$db->error;
        }   
    }

    // delete post/news
    if (isset($_GET['del'])) {
        $query = "DELETE FROM users WHERE userID = '$_GET[del]' ";
        if (mysqli_query($db, $query)) {
            header("location:users.php?msg=del");
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
                        <div class="">
                            <button class="btn btn-primary" data-bs-toggle='modal' data-bs-target="#rateModal">Add New User</button>

                            <!-- ADD USER MODAL-->
                            <div class="modal fade" id="rateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">ADD NEW USER</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="form-box">
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="userID" class="form-control" readonly>
                                                    <label for=""><b>Username</b></label>
                                                    <input type="text" name="username" class="form-control" required>
                                                    <label for=""><b>Fullname</b></label>
                                                    <input type="text" name="fullname" class="form-control" required>
                                                    <label for=""><b>Email Address</b></label>
                                                    <input type="email" name="email" class="form-control" required>
                                                    <label for=""><b>Mobile Number</b></label>
                                                    <input type="text" name="phone" class="form-control"  required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="adduser" class="btn btn-primary">Add</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ADD USER MODAL-->
                        </div>

                            <?php 
                                // posted successful
                                if (isset($_GET['msg']) AND $_GET['msg']=='su') {
                                    echo "<div class='text-primary text-center mt-2'>User Added!</div>";
                                } 
                                if (isset($_GET['msg']) AND $_GET['msg']=='ph') {
                                    echo "<div class='text-danger text-center mt-2'>Mobile Number Already Exists!</div>";
                                }
                                if (isset($_GET['msg']) AND $_GET['msg']=='em') {
                                    echo "<div class='text-danger text-center mt-2'>Email Address Already Exists!</div>";
                                }
                                if (isset($_GET['msg']) AND $_GET['msg']=='us') {
                                    echo "<div class='text-danger text-center mt-2'>Username Already Exists, Choose Another One!</div>";
                                }
                                if (isset($_GET['msg']) AND $_GET['msg']=='del') {
                                    echo "<div class='text-danger text-center mt-2'>Username Deleted!</div>";
                                }
                            ?>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <th style="width:5%"></th>
                                    <th>USERNAME</th>
                                    <th>NAMES</th>
                                    <th>EMAIL ADDRESS</th>
                                    <th>CONTACT</th>
                                    <th style="width:5%"></th>
                                </thead>
                                <tbody>
                                    <?php
                                        $sn = 1;
                                        $query = mysqli_query($db, "SELECT * FROM users WHERE userID NOT IN (1) ");
                                        while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $row['username']; ?></td>
                                        <td><?php echo $row['fullname']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td><a href="users.php?del=<?php echo $row['userID']; ?>" onclick="return confirm('Do you want to delete this user?')"><i class="fa fa-trash-o"></i></a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
