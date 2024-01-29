<?php
    session_start();
    require 'users/assets/connect.php';
    require 'users/assets/visitors.php';
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Abdulwasi Biodun Popoola (+234 809 457 7533 || adihzah2013@gmail.com)">
        <meta name="generator" content="">
        <link rel="shortcut icon" type="image/x-icon" href="users/imgs/icon.png">
        <title>LibertyPosts</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!-- Web Font -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    </head>
    <body>
        
        <?php require 'main-navbar.php'; ?>

        <!-- HAND BANNER AD -->
        <div class="container">
            <div class="head-ad">
                <div class="row">
                    <div class="col-sm-2 col-md-2 col-lg-2"></div>
                    <div class="col-sm-10 col-md-10 col-lg-10">
                        <?php require 'ads/tophead-banner.php'; ?>
                    </div>
                </div>
            </div>
        </div>

        <main>
            <div class="container">
                <div class="row">
                    <!-- display news/posts-->
                    <div class="col-sm-8 col-md-8 col-lg-8">
                        <div class="displayPosts">
                            <!-- display politics, sport and world posts -->
                            <?php $query = mysqli_query($db, "SELECT * FROM posts WHERE cat IN (1, 4, 6) ORDER BY postID DESC LIMIT 9 ");
                                while ($row = mysqli_fetch_array($query)) { ?>

                                <div class="posts">
                                    <div class="row">
                                        <div class="col-4">
                                            <a href="post.php?post=<?php echo $row['link']; ?>">
                                                <img src="users/imgs/<?php echo $row['img']; ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="col-7">
                                            <h4>
                                                <a href="post.php?post=<?php echo $row['link']; ?>">
                                                    <?php echo $row['postTitle']; ?>
                                                </a> 
                                            </h4>
                                            <div class="poster">
                                                <i class="fa fa-user"></i>   
                                                <?php 
                                                    $getPoster = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE userID = '$row[userID]' ")); 
                                                    if ($getPoster > 0) {
                                                        echo $getPoster['fullname'];
                                                    } else {
                                                        echo "User";
                                                    }
                                                ?>
                                                <span>
                                                    <i class="fa fa-calendar"></i> <?php echo $row['date_post']; ?>
                                                </span>
                                            </div>
                                            <p>
                                                <?php echo $row['headline']; ?>... 
                                                <a href="post.php?post=<?php echo $row['link']; ?>">continue read</a>
                                            </p> 
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>

                            <!--ad-->
                            <div class="ad">
                                <img src="users/imgs/ad2.png" alt="ad">
                            </div>

                            <!-- display education, technology and lifestyle posts -->
                            <?php $query = mysqli_query($db, "SELECT * FROM posts WHERE cat IN (2, 3, 5) ORDER BY postID DESC LIMIT 9 ");
                                while ($row = mysqli_fetch_array($query)) { ?>

                                <div class="posts">
                                    <div class="row">
                                        <div class="col-4">
                                            <a href="post.php?post=<?php echo $row['link']; ?>">
                                                <img src="users/imgs/<?php echo $row['img']; ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="col-7">
                                            <h4>
                                                <a href="post.php?post=<?php echo $row['link']; ?>">
                                                    <?php echo $row['postTitle']; ?>
                                                </a> 
                                            </h4>
                                            <div class="poster">
                                                <i class="fa fa-user"></i>   
                                                <?php 
                                                    $getPoster = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE userID = '$row[userID]' ")); 
                                                    if ($getPoster > 0) {
                                                        echo $getPoster['fullname'];
                                                    } else {
                                                        echo "User";
                                                    }
                                                ?>
                                                <span>
                                                    <i class="fa fa-calendar"></i> <?php echo $row['date_post']; ?>
                                                </span>
                                            </div>
                                            <p>
                                                <?php echo $row['headline']; ?>... 
                                                <a href="post.php?post=<?php echo $row['link']; ?>">continue read</a>
                                            </p> 
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>
                            <!--ad-->
                            <div class="ad">
                                <img src="users/imgs/ad2.png" alt="ad">
                            </div>

                            <!-- display entertainment posts -->
                            <?php $query = mysqli_query($db, "SELECT * FROM posts WHERE cat IN (7, 8) ORDER BY postID DESC LIMIT 9 ");
                                while ($row = mysqli_fetch_array($query)) { ?>

                                <div class="posts">
                                    <div class="row">
                                        <div class="col-4">
                                            <a href="post.php?post=<?php echo $row['link']; ?>">
                                                <img src="users/imgs/<?php echo $row['img']; ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="col-7">
                                            <h4>
                                                <a href="post.php?post=<?php echo $row['link']; ?>">
                                                    <?php echo $row['postTitle']; ?>
                                                </a> 
                                            </h4>
                                            <div class="poster">
                                                <i class="fa fa-user"></i>   
                                                <?php 
                                                    $getPoster = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE userID = '$row[userID]' ")); 
                                                    if ($getPoster > 0) {
                                                        echo $getPoster['fullname'];
                                                    } else {
                                                        echo "User";
                                                    }
                                                ?>
                                                <span>
                                                    <i class="fa fa-calendar"></i> <?php echo $row['date_post']; ?>
                                                </span>
                                            </div>
                                            <p>
                                                <?php echo $row['headline']; ?>... 
                                                <a href="post.php?post=<?php echo $row['link']; ?>">continue read</a>
                                            </p> 
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>
                            <!--ad-->
                            <div class="ad">
                                <img src="users/imgs/ad2.png" alt="ad">
                            </div>

                        </div>
                    </div>

                    <!-- right sidebar -->
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <?php require 'sidebar.php'; ?>
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
                        <a href="index.php" class="brand"><img src="users/imgs/brand.png" alt="logo"></a>
                    </div>
                    <div class="col-sm-5 col-md-5 col-lg-5">
                        <span>Powered by: <a href="#">All-Embracing Softwork</a></span>
                    </div>
                </div>
            </div>
        </footer>

        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>
