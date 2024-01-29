
                        <div class="left-sidebar">
                            <div class=""><b>Navigator</b> <hr></div>
                            <a href="index.php">
                                <i class="fa fa-home"></i> Home
                            </a>
                            <a href="postnews.php">
                                <i class="fa fa-newspaper-o"></i> Posts
                            </a>
                            <a href="profile.php">
                                <i class="fa fa-user"></i> Profile
                            </a>
                            <?php if ($_SESSION['userID'] == '1') { ?>
                                <a href="users.php">
                                    <i class="fa fa-users"></i> Users
                                </a>
                                <a href="categories.php">
                                    <i class="fa fa-list"></i> Categories
                                </a>
                            <?php } ?>
                            
                        </div>