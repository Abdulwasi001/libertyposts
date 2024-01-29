<?php
    session_start();
    //connection
    require('assets/connect.php');

    if (isset($_POST['libertyLogin'])) {

        $username = mysqli_real_escape_string($db, $_POST['username']);
        $pass = mysqli_real_escape_string($db, $_POST['pass']);
        $passwordHash = md5($pass);

        $query = "SELECT * FROM users WHERE username = '$username' AND pass = '$passwordHash' ";
        $result = mysqli_query($db, $query);

        while ($row = $result->fetch_assoc()){

            $userID = $row['userID'];   
            $email = $row['email'];
            $username = $row['username']; 
            $fullname = $row['fullname']; 
            $phone = $row['phone']; 
        }

        if ($result->num_rows == 0) {
            header('location:sign_in.php?msg=invalid');

        } else if ($result->num_rows == 1) {
            header("Location: index.php");
                
            $_SESSION['libertyPostsloggedID'] = true; 
            $_SESSION['userID'] = $userID;
            $_SESSION['fullname'] = $fullname; 
            $_SESSION['phone'] = $phone; 
            $_SESSION['email'] = $email; 
            $_SESSION['username'] = $username; 
              
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
        <style>
            body {
                background: url('imgs/bg.jpeg') no-repeat;
                background-size: cover;
                background-position: center;
            }
        </style>
    </head>
    <body>
        
        <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
            <div class="container">
                <a class="navbar-brand" href="index.html"><img src="imgs/brand.png" alt="Logo"></a>
            </div>
        </nav>

        <main>
            <div class="login-box">
                <div class="login-heading">USER SIGN IN <hr></div>
                <?php 
                    // invalid sign-in detail
                    if (isset($_GET['msg']) AND $_GET['msg']=='invalid') {
                        echo "<div class='text-warning text-center mb-2'>Invalid Login Detail!</div>";
                    } 
                    // password change successful
                    if (isset($_GET['msg']) AND $_GET['msg']=='pass_success') {
                        echo "<div class='text-primary text-center'>Password Changed Successful, Kindly Sign-In with the New Password.</div>";
                    } 
                ?>
                <form action="" method="post">
                    <div class="form-box">
                        <label for=""><i class="fa fa-user"></i></label>
                        <input type="text" name="username" placeholder="Enter Username" required>
                    </div>
                    <div class="form-box">
                        <label for=""><i class="fa fa-lock"></i></label>
                        <input type="password" name="pass" id="myPass" minlength="6" placeholder="Enter Password" required>
                    </div>
                    <div class="show-pass">
                        <input type="checkbox" onclick="myFunction()"> Show Password
                    </div>
                    
                    <button type="submit" class="btn btn-primary" name="libertyLogin"><i class="fa fa-sign-in"></i> Sign In</button>
                    <div class="forget-pass">
                        <a href="#"><i class="fa fa-warning"></i> Forget Password?</a>
                    </div>
                    <div class="openAccount">
                        Don't have an account?<a href="#"> Register</a>
                    </div>
                </form>
            </div>
        </main>

        <!--  for show password -->
        <script>
            function myFunction() {
                var x = document.getElementById("myPass");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
        <!-- end for show password -->

        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap.bundle.min.js"></script>
    </body>
</html>
