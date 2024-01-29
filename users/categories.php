<?php
    session_start();
    require 'assets/connect.php';

    if(!isset($_SESSION['libertyPostsloggedID'])){ header('location:sign_in.php');}

    // add new user
    if (isset($_POST['addcat'])) {

        $categories = mysqli_real_escape_string($db, $_POST['categories']);

        // check if categories already exist
        $checkcat = mysqli_query($db, "SELECT * FROM categories WHERE categories = '$categories' ");

        if (mysqli_num_rows($checkcat) == 1){
            header("location:categories.php?msg=ca");
        } else {
            $sql = "INSERT INTO categories (categories) VALUES ('$categories')";
            if ($query_run = mysqli_query($db, $sql)) {
                header("location:categories.php?msg=su");
            } else {
                echo 'Error'.$sql.'<br>'.$db->error;
            } 
        }
    }

    // Update user profile 
    if (isset($_POST['updatecat'])) {
        $catID = mysqli_real_escape_string($db, $_POST['catID']);
        $categories = mysqli_real_escape_string($db, $_POST['categories']);
            
        $sql = "UPDATE categories SET categories='$categories' WHERE catID='$catID' ";
        if ($query_run = mysqli_query($db, $sql)) {
            header("location: categories.php?msg=up");
        } else {
            echo 'Error'.$sql.'<br>'.$db->error;
        }   
    }

    // delete post/news
    if (isset($_GET['del'])) {
        $query = "DELETE FROM categories WHERE catID = '$_GET[del]' ";
        if (mysqli_query($db, $query)) {
            header("location: categories.php?msg=del");
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

                    <!--categories right menu-->
                    <div class="col-sm-9 col-md-9 col-lg-9">
                        <div class="">
                            <button class="btn btn-primary" data-bs-toggle='modal' data-bs-target="#rateModal">Add New Cateogories</button>

                            <!-- ADD USER MODAL-->
                            <div class="modal fade" id="rateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">ADD NEW CATEGORIES</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="form-box">
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    <label for=""><b>Categories</b></label>
                                                    <input type="text" name="categories" class="form-control" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="addcat" class="btn btn-primary">Add</button>
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
                                    echo "<div class='text-primary text-center mt-2'>Categories Added!</div>";
                                }
                                if (isset($_GET['msg']) AND $_GET['msg']=='up') {
                                    echo "<div class='text-primary text-center mt-2'>Categories Updated!</div>";
                                } 
                                if (isset($_GET['msg']) AND $_GET['msg']=='ca') {
                                    echo "<div class='text-danger text-center mt-2'>Categories Already Exists!</div>";
                                }
                                if (isset($_GET['msg']) AND $_GET['msg']=='del') {
                                    echo "<div class='text-danger text-center mt-2'>Categories Deleted!</div>";
                                }
                            ?>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <th style="width:5%"></th>
                                    <th>Cateogories</th>
                                    <th style="width:5%"></th>
                                    <th style="width:5%"></th>
                                </thead>
                                <tbody>
                                    <?php
                                        $sn = 1;
                                        $query = mysqli_query($db, "SELECT * FROM categories ");
                                        while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $row['categories']; ?></td>
                                        <td><span data-bs-toggle='modal' data-bs-target="#editModal<?php echo $row['catID']?>"><i class="fa fa-edit"></i></span></td>
                                        <td><a href="categories.php" onclick="return confirm('Do you want to delete this user?')"><i class="fa fa-trash-o"></i></a></td>
                                    </tr>
                                    <?php ?> 
                                    <!-- ADD USER MODAL-->
                                    <div class="modal fade" id="editModal<?php echo $row['catID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">ADD NEW CATEGORIES</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="form-box">
                                                    <form action="" method="post">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="catID" value="<?php echo $row['catID']?>" class="form-control" required readonly>
                                                            <label for=""><b>Categories</b></label>
                                                            <input type="text" name="categories" value="<?php echo $row['categories']?>" class="form-control" required>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="updatecat" class="btn btn-primary">Add</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ADD USER MODAL-->
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
