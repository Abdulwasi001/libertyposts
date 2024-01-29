<?php
    session_start();
    require 'assets/connect.php';

    if(!isset($_SESSION['libertyPostsloggedID'])){ header('location:sign_in.php');}

    $todayDate = date('M d, Y');

    // COMPRESSED IMAGE FUNCTION
    function compress_image($source, $destination, $quality) {
        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source);
        elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source);
        elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source);
        elseif ($info['mime'] == 'image/jpg') $image = imagecreatefromjpg($source);

        // save it 
        imagejpeg($image, $destination, $quality);

        // return destination
        return $destination;
    }

    // add new news/posts 
    if (isset($_POST['postnews'])) {

        $userID = mysqli_real_escape_string($db, $_POST['userID']);
        $postTitle = mysqli_real_escape_string($db, $_POST['postTitle']);
        $headline = mysqli_real_escape_string($db, $_POST['headline']);
        $post_txt = mysqli_real_escape_string($db, $_POST['post_txt']);
        $cat = mysqli_real_escape_string($db, $_POST['cat']);
        $link = preg_replace("/\s+/", "-", $postTitle);

        $img = $_FILES["img"]["tmp_name"];
        $source_photo = $img;
        $name_create = time();
        $name_create_number = rand(10 , 100);
        $img_name = $name_create.$name_create_number;
        $final_name = $img_name.".jpeg";

        // check if phone already exist
        $checktitle = mysqli_query($db, "SELECT * FROM posts WHERE postTitle = '$postTitle' ");

        if (mysqli_num_rows($checktitle) == 1){
            header("location:postnews.php?msg=ti");
        } else {
            $sql = "INSERT INTO posts (userID, link, postTitle, headline, img, post_txt, date_post, cat) VALUES ('$userID', '$link', '$postTitle', '$headline', '$final_name', '$post_txt', '$todayDate', '$cat')";
            if ($query_run = mysqli_query($db, $sql)) {
                $img_folder = 'imgs/'.$final_name;
                $compressimage = compress_image($source_photo, $img_folder, 40);
                header("location:postnews.php?msg=su");
            } else {
                echo 'Error'.$sql.'<br>'.$db->error;
            } 
        }
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Abdulwasi Biodun Popoola (+2348093577533, adihzah2013@gmail.com)">
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
        
        <?php require 'assets/navbar.php'; ?> 

        <main>
            <div class="container">
                <div class="row">
                    <!-- Left Side Bar -->
                    <div class="col-sm-3 col-md-3 col-lg-3">
                        <?php require 'assets/sidebar-nav.php'; ?>
                    </div>

                    <!-- Main Display -->
                    <div class="col-sm-9 col-md-9 col-lg-9">
                        <div class="user-rightbox">
                            <div class="heading">Post News</div><hr>
                            <?php 
                                // posted successful
                                if (isset($_GET['msg']) AND $_GET['msg']=='su') {
                                    echo "<div class='text-primary text-center mt-2'>Posted Successful!</div>";
                                } 
                                // title already exists
                                if (isset($_GET['msg']) AND $_GET['msg']=='ti') {
                                    echo "<div class='text-danger text-center mt-2'>News Title Already Exists</div>";
                                } 
                            ?>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="hidden" name="userID" value="<?php echo $_SESSION['userID'];?>" class="form-control" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for=""><b>Title</b></label>
                                    <input type="text" name="postTitle" maxlength="150" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for=""><b>Headline</b></label>
                                    <input type="text" name="headline" maxlength="150" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for=""><b>Image</b></label>
                                    <input type="file" name="img" class="form-control" accept=".jpeg, .png, .jpg" required>
                                </div>
                                <div class="form-group">
                                    <label for=""><b>Categories</b></label>
                                    <select name="cat" class="form-control" required>
                                        <?php
                                            $s = mysqli_query($db, "SELECT * FROM categories ");
                                            $row_count = mysqli_num_rows($s);
                                            if ($row_count) {
                                                $c = "<option value=''></option>; ";
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
                                    <textarea name="post_txt" id="editor" cols="30" rows="10" class="form-control" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3" name="postnews">POST</button>
                            </form>
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
        <script src="ckeditor/ckeditor.js"></script>
        <script> CKEDITOR.replace( 'editor' );  </script>
    </body>
</html>
