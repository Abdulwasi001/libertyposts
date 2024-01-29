                        <div class="right-sidebar">
                            <!-- trending posts -->
                            <div class="heading">Trending Posts<hr></div> 
                            <div class="trending-post">
                                <?php $query = mysqli_query($db, "SELECT * FROM posts WHERE tre = '1' ORDER BY postID DESC LIMIT 9 ");
                                while ($row = mysqli_fetch_array($query)) { ?>
                                    <div class="posts">
                                        <div class="row">
                                            <div class="col-4">
                                                <a href="post.php?post=<?php echo $row['link']; ?>">
                                                    <img src="users/imgs/<?php echo $row['img']; ?>" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-8">
                                                <h5>
                                                    <a href="post.php?post=<?php echo $row['link']; ?>">
                                                        <?php echo $row['postTitle']; ?>.
                                                    </a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- advert -->
                            <div class="ad">
                                <img src="users/imgs/ad1.jpg" alt="Image">
                            </div>
                            <!-- advert -->
                            <div class="ad">
                                <img src="users/imgs/post1.jpg" alt="Image">
                            </div>
                            
                            <!-- Social Media -->
                            <div class="heading">Social Media <hr></div>
                            <div class="socialmedia">
                                <a href="#">
                                    <div class="sm blue">
                                        <i class="fa fa-facebook"></i> Facebook
                                        <span>956 Likes</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="sm cyan">
                                        <i class="fa fa-twitter"></i> Twitter
                                        <span>233 Followers</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="sm green">
                                        <i class="fa fa-whatsapp"></i> Whatsapp
                                        <span>834 Members</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="sm pink">
                                        <i class="fa fa-instagram"></i> Instagram
                                        <span>454 Followers</span>
                                    </div>
                                </a>
                                <a href="#">  
                                    <div class="sm danger">
                                        <i class="fa fa-youtube-play"></i> Youtube
                                        <span>634 Subscritions</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="sm cyan">
                                        <i class="fa fa-paper-plane"></i> Telegram
                                        <span>174 Followers</span>
                                    </div>
                                </a>    
                            </div> 

                            <!-- advert -->
                            <div class="ad">
                                <img src="users/imgs/ad1.jpg" alt="Image">
                            </div>
                            <!-- advert -->
                            <div class="ad">
                                <img src="users/imgs/post1.jpg" alt="Image">
                            </div>
                        </div>