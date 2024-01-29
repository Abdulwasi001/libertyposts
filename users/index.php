<?php
    session_start();
    require 'assets/connect.php';

    if(!isset($_SESSION['libertyPostsloggedID'])){ header('location:sign_in.php');}

    $date = date("d-m-y");

    // Update trend 
    if (isset($_POST['trendbtn'])) {
        $postID = mysqli_real_escape_string($db, $_POST['postID']);
        $tre = mysqli_real_escape_string($db, $_POST['tre']);
            
        $sql = "UPDATE posts SET tre='$tre' WHERE postID='$postID' ";
        if ($query_run = mysqli_query($db, $sql)) {
            header('location: index.php?msg=up');
        } else {
            echo 'Error'.$sql.'<br>'.$db->error;
        }   
    }

    // delete post/news
    if (isset($_GET['del'])) {
        $query = "DELETE FROM posts WHERE postID = '$_GET[del]' ";
        if (mysqli_query($db, $query)) {
            header('location: index.php?msg=del');
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
            .count {
                color: #000;
                margin: 20px 0px;
            }
            .count span {
                text-align: center;
                margin: 10px 0;
            }
        </style>
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

                        <?php if ($_SESSION['userID'] == '1') { ?>
                            <!-- COUNT -->
                            <?php
                                // total visitor today
                                $todayView = mysqli_num_rows(mysqli_query($db, "SELECT * FROM visitors WHERE  lastVisit = '$date' "));
                                // desktop count
                                $deskCount = mysqli_num_rows(mysqli_query($db, "SELECT * FROM visitors WHERE mob = '0' "));
                                // mobile count
                                $mobCount = mysqli_num_rows(mysqli_query($db, "SELECT * FROM visitors WHERE mob = '1' "));
                            ?>
                            <div class="count">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <span><i class="fa fa-eye"></i> Today Views <?php echo $todayView; ?></span>
                                    </div>
                                    <div class="col-sm-3">
                                        <span><i class="fa fa-desktop"></i> Total Desktop <?php echo $deskCount; ?></span>
                                    </div>
                                    <div class="col-sm-3">
                                        <span><i class="fa fa-mobile"></i> Total Mobile <?php echo $mobCount; ?></span>
                                    </div>
                                    <div class="col-sm-3">
                                        <span><i class="fa fa-eye"></i> Total Views <?php echo $mobCount + $deskCount; ?></span>
                                    </div>
                                </div>
                                
                                
                                
                            </div>
                            <!-- POSTS LIST-->
                            <div class="heading">Posts <hr></div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <th style="width:5%"></th>
                                        <th>POSTER</th>
                                        <th>TITLE</th>
                                        <th style="width:15%">DATE</th>
                                        <th style="width:3%">TRE.</th>
                                        <th style="width:3%">COM.</th>
                                        <th style="width:2%"></th>
                                        <th style="width:2%"></th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sn = 1;
                                            $query = mysqli_query($db, "SELECT * FROM posts ");
                                            while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $sn++; ?></td>
                                            <td>
                                                <?php $gp = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE userID = '$row[userID]' ")); echo $gp['username'] ?>
                                            </td>
                                            <td><?php echo $row['postTitle']; ?></td>
                                            <td><?php echo $row['date_post']; ?></td>
                                            <td>
                                                <?php if ($row['tre'] == "1") { ?>
                                                    <i class="fa fa-check text-success" data-bs-toggle='modal' data-bs-target="#rateModal<?php echo $row['postID']; ?>"></i>
                                                <?php } else { ?>
                                                    <i class="fa fa-close text-danger" data-bs-toggle='modal' data-bs-target="#rateModal<?php echo $row['postID']; ?>"></i>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php echo $comment_count = mysqli_num_rows(mysqli_query($db, "SELECT * FROM comments WHERE postID = '$row[postID]' ")); ?>
                                            </td>
                                            <td>
                                                <span><a href="editnews.php?edit=<?php echo $row['postID']; ?>"><i class="fa fa-edit"></i></a></span>
                                            </td>
                                            <td>
                                                <a href="index.php?del=<?php echo $row['postID']; ?>" onclick="return confirm('Do you want to delete this?')"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                        <?php ?>
                                        <!-- CHANGE TRENDING STATUS MODAL-->
                                        <div class="modal fade" id="rateModal<?php echo $row['postID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">TRENDING</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="form-box">
                                                        <form action="" method="post">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="postID" class="form-control" value="<?php echo $row['postID']; ?>" readonly>
                                                                <label for=""><b>Do you want to trending this post?</b></label>
                                                                <select name="tre" class="form-control" required>
                                                                    <option value=""></option>
                                                                    <option value="1">YES</option>
                                                                    <option value="0">NO</option>
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="trendbtn" class="btn btn-primary">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- CHANGE TRENDING STATUS MODAL-->
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- USERS LIST-->
                            <div class="heading">Users <hr></div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <th style="width:5%"></th>
                                        <th>USERNAME</th>
                                        <th>NAMES</th>
                                        <th>EMAIL ADDRESS</th>
                                        <th>CONTACT</th>
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
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                        <?php } else { ?>
                        
                            <!-- POSTS LIST-->
                            <div class="heading">Posts <hr></div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <th style="width:5%"></th>
                                        <th>POSTER</th>
                                        <th>TITLE</th>
                                        <th style="width:15%">DATE</th>
                                        <th style="width:3%">TRE.</th>
                                        <th style="width:3%">COM.</th>
                                        <th style="width:2%"></th>
                                        <th style="width:2%"></th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sn = 1;
                                            $query = mysqli_query($db, "SELECT * FROM posts WHERE userID = '$_SESSION[userID]' ");
                                            while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $sn++; ?></td>
                                            <td>
                                                <?php $gp = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE userID = '$row[userID]' ")); echo $gp['username'] ?>
                                            </td>
                                            <td><?php echo $row['postTitle']; ?></td>
                                            <td><?php echo $row['date_post']; ?></td>
                                            <td>
                                                <span class="text-primary" data-bs-toggle='modal' data-bs-target="#rateModal"><i class="fa fa-check"></i></span>
                                            </td>
                                            <td>
                                                <?php echo $comment_count = mysqli_num_rows(mysqli_query($db, "SELECT * FROM comments WHERE postID = '$row[postID]' ")); ?>
                                            </td>
                                            <td>
                                                <span><a href="editnews.php"><i class="fa fa-edit"></i></a></span>
                                            </td>
                                            <td>
                                                <a href="users.html" onclick="alert('Do you want to delete this user')"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                        <?php ?>
                                        <!-- CHANGE TRENDING STATUS MODAL-->
                                        <div class="modal fade" id="rateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">TRENDING</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="form-box">
                                                        <form action="" method="post">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="userID" class="form-control" value="<?php echo $_SESSION['userID']; ?>" readonly>
                                                                <label for=""><b>Do you want to trending this post?</b></label>
                                                                <select name="tre" class="form-control" required>
                                                                    <option value=""></option>
                                                                    <option value="1">YES</option>
                                                                    <option value="0">NO</option>
                                                                </select>
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
                                        <!-- CHANGE TRENDING STATUS MODAL-->
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                        <?php } ?>
                        
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
