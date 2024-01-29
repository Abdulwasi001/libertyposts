    <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
            <div class="container">
                <a class="navbar-brand" href="index.php"><img src="imgs/brand.png" alt="Logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php"><i class="fa fa-home"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="postnews.php">Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="profile.php">Profile</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <span>
                            Welcome! <?php echo $_SESSION['fullname']; ?>
                        </span>
                        
                        <a href="sign_out.php" onclick="return confirm('Do you want to sign out')"> 
                            <i class="fa fa-power-off"></i>
                        </a>
                    </form>
                </div>
            </div>
        </nav>