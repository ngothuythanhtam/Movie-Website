<header>
    <div class="container">
        <div class="navbar flex1">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <div class="menu-main-menu-container">
                    <ul id="top-menu" class="navbar-nav ml-auto">
                        <li class="menu-item">
                            <a href='index.php'>Home</a>
                        </li>
                        <li class="menu-item">
                            <a href="movies.php">Movies</a>
                        </li>
                        <li class="menu-item">
                            <a href="library.php">Library</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">Genres</a>
                            <ul class="sub-menu">
                                <?php
                                get_genres();
                                ?>
                            </ul>
                        </li>
                        <li class="menu-item">
                            <a href="#">Pages</a>
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a href="#">About Us</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">Contact Us</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">FAQ</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="login flex">
                <div class="navbar-right menu-right">
                    <ul class="d-flex align-items-center list-inline m-0">
                        <li class="nav-item nav-icon">
                            <div class="search-box iq-search-bar d-search">
                                <form action="searchmovie.php" method="get" class="searchbox">
                                    <div class="form-group position-relative">
                                        <input type="search" class="text search-input font-size-12"
                                            placeholder="Type here to search..." aria-label="Search" name="search_data">
                                        <input type="submit" value="Search" class="btn" id="btn"
                                            name="search_data_movie">
                                        <i class="search-link fa fa-search"></i>
                                    </div>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
                <a href="profile.php">
                    <img src="img/user/<?php echo $img ?>" class="user-pic">
                </a>
                <div class="notify">
                    <a href="mylist.php" class="notify">
                        <i class="bx bx-movie-play bn22">
                            <span>
                                <sup>
                                    <?php
                                    if (isset($_GET['add_to_list'])) {
                                        global $con;
                                        $get_ip_address = getIPAddress();
                                        $select_query = "select * from `mlist` where ip_address='$get_ip_address' and uid='$user_id'";
                                        $result_query = mysqli_query($con, $select_query);
                                        $count_movie_items = mysqli_num_rows($result_query);
                                    } else {
                                        global $con;
                                        $get_ip_address = getIPAddress();
                                        $select_query = "select * from `mlist` where ip_address='$get_ip_address' and uid='$user_id'";
                                        $result_query = mysqli_query($con, $select_query);
                                        $count_movie_items = mysqli_num_rows($result_query);
                                    }
                                    echo $count_movie_items;
                                    ?>
                                </sup>
                            </span>
                        </i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>