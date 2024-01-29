<?php
    session_start();
    require 'users/assets/connect.php';
    require 'users/assets/visitors.php';

    $todayDate = date('M d, Y');

    if (isset($_GET['post'])) {
        $getpost = mysqli_query($db, "SELECT * FROM posts WHERE link = '$_GET[post]' ");
        $post = mysqli_fetch_array($getpost);
    }

    // comment count
    $comment_count = mysqli_num_rows(mysqli_query($db, "SELECT * FROM comments WHERE postID = '$post[postID]' "));

    // add comment
    if (isset($_POST['sendComment'])) {

        $postID = mysqli_real_escape_string($db, $_POST['postID']);
        $cname = mysqli_real_escape_string($db, $_POST['cname']);
        $comment = mysqli_real_escape_string($db, $_POST['comment']);

        $sql = "INSERT INTO comments (postID, cname, comment, com_date) VALUES ('$postID', '$cname', '$comment', '$todayDate')";
        if ($query_run = mysqli_query($db, $sql)) {
            header("location:post.php?post=$post[link]");
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
    <style>
        .shares {
            margin: 10px 0;
        }
        .shares a {
            padding: 5px 10px;
            border-radius: 5px;
            margin-right: 10px;
            color: white;
            text-align: center;
            font-size: 17px;
        }
    </style>
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
                        <div class="detailPost">
                            <div class="post">
                                <img src="users/imgs/<?php echo $post['img']; ?>" alt="image">
                                <h3>
                                    <?php echo $post['postTitle']; ?>
                                </h3>
                                <div class="poster">
                                    <i class="fa fa-user"></i> 
                                    <?php 
                                        $getPoster = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE userID = '$post[userID]' ")); 
                                        if ($getPoster > 0) {
                                            echo $getPoster['fullname'];
                                        } else {
                                            echo "User";
                                        }
                                    ?>
                                    <span><i class="fa fa-calendar"></i> <?php echo $post['date_post']; ?></span>
                                    <i class="fa fa-comments-o"></i> <?php echo $comment_count; ?>
                                </div>
                                <div class="shares">
                                    <a href="https://twitter.com/intent/tweet?text=http://libertyposts.com.ng/post.php?post=<?php echo $post['link']; ?>" class="cyan" target="_blank"><i class="fa fa-twitter"></i></a>

                                    <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2Flibertyposts.com.ng/post.php?post=<?php echo $post['link']; ?>%2F&amp;src=sdkpreparse" class="blue" target="_blank"><i class="fa fa-facebook"></i></a>

                                    <a href="https://api.whatsapp.com/send?text=http://libertyposts.com.ng/post.php?post=<?php echo $post['link']; ?>" class="green" target="_blank"><i class="fa fa-whatsapp"></i></a>
                                </div>
                                <p>
                                    <?php echo $post['post_txt']; ?>
                                </p>
                            </div>
                        
                            <!--ad-->
                            <div class="ad">
                                <img src="users/imgs/ad2.png" alt="ad">
                            </div>

                            <div class="comments-box">
                                <div class="heading">Comments <hr></div>
                                <div class="display-comments">
                                    <?php $getComment = mysqli_query($db, "SELECT * FROM comments WHERE postID = '$post[postID]' ORDER BY comID DESC LIMIT 10 ");
                                    while ($com = mysqli_fetch_array($getComment)) { ?>
                                    <div class="comment">
                                        <div class="commenter">
                                            <i class="fa fa-user"></i> <?php echo $com['cname']; ?>
                                            <span>
                                                <i class="fa fa-calendar"></i> <?php echo $com['com_date']; ?>
                                            </span>
                                        </div>
                                        <p>
                                            <?php echo $com['comment']; ?>
                                        </p>
                                        <hr>
                                    </div>
                                    <?php } ?>
                                </div>

                                <!--comment form box-->
                                <div class="comment-form-box">
                                    <form action="" method="post">
                                        <input type="hidden" name="postID" class="form-control" value="<?php echo $post['postID'] ?>" required readonly>
                                        <label for=""><b>Name</b></label>
                                        <input type="text" name="cname" class="form-control" placeholder="Enter Name" required>
                                        <label for=""><b>Comment</b></label>
                                        <textarea name="comment" class="form-control" cols="30" rows="2" placeholder="Type comment here" required></textarea>
                                        <button type="submit" class="btn btn-primary mt-2" name="sendComment">Send</button>
                                    </form>
                                </div>
                            </div>

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
