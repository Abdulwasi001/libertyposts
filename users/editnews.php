<?php
    session_start();
    require 'assets/connect.php';

    if(!isset($_SESSION['libertyPostsloggedID'])){ header('location:sign_in.php');}

    $date = date("d-m-y");

    $post = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM posts WHERE postID = $_GET[edit] "));

    // Update trend 
    if (isset($_POST['editpost'])) {
        $postID = mysqli_real_escape_string($db, $_POST['postID']);
        $postTitle = mysqli_real_escape_string($db, $_POST['postTitle']);
        $headline = mysqli_real_escape_string($db, $_POST['headline']);
        $post_txt = mysqli_real_escape_string($db, $_POST['post_txt']);
        $cat = mysqli_real_escape_string($db, $_POST['cat']);
        $link = preg_replace("/\s+/", "-", $postTitle);
            
        $sql = "UPDATE posts SET link='$link', postTitle='$postTitle', headline='$headline', post_txt='$post_txt', cat='$cat' WHERE postID='$postID' ";
        if ($query_run = mysqli_query($db, $sql)) {
            header("location: editnews.php?edit=$post[postID]&msg=up");
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
                        <div class="heading">Post <hr></div>
                            <?php 
                                // posted successful
                                if (isset($_GET['msg']) AND $_GET['msg']=='up') {
                                    echo "<div class='text-primary text-center mt-2'>Update Successful!</div>";
                                }  
                            ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="hidden" name="postID" value="<?php echo $post['postID'];?>" class="form-control" readonly required>
                            </div>
                            <div class="form-group">
                                <label for=""><b>Title</b></label>
                                <input type="text" name="postTitle" maxlength="150" value="<?php echo $post['postTitle'];?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for=""><b>Headline</b></label>
                                <input type="text" name="headline" maxlength="150" value="<?php echo $post['headline'];?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for=""><b>Categories</b></label>
                                <select name="cat" class="form-control" required>
                                    <?php
                                        $s = mysqli_query($db, "SELECT * FROM categories ");
                                        $row_count = mysqli_num_rows($s);
                                        $cat = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM categories WHERE catID = $post[cat] "));
                                        if ($row_count) {
                                            $c = "<option value='$post[cat]'>$cat[categories]</option>; ";
                                            while ($row = mysqli_fetch_assoc($s)) {
                                                $c .= "<option value='$row[catID]'> $row[categories]</option>";
                                            }
                                            echo $c;
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for=""><b>Compose</b></label>
                                <textarea name="post_txt" id="editor" cols="30" rows="10" class="form-control" required>
                                    <?php echo $post['post_txt'];?>
                                </textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3" name="editpost">UPDATE</button>
                        </form>
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
        <script src="ckeditor/ckeditor.js"></script>
        <script> CKEDITOR.replace( 'editor' );  </script>
    </body>
</html>
