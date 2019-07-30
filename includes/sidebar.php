<div class="col-md-4">
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <!-- We create a search form so we can look for Submit-->
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" name="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>
    <!-- Login -->
    <div class="well">
        <?php
        if (isset($_SESSION['user_role']))
        {
            echo "<h4>Logged in as <strong>{$_SESSION['username']}</strong></h4>";
            echo "<a href='includes/logout.php' class='btn btn-primary'>Logout</a>";

        } else {
            ?>

            <h4>Login</h4>
            <form action="includes/login.php" method="post">
                <div class="form-group">
                    <input name="username" type="text" class="form-control" placeholder="Enter username">
                </div>
                <div class="input-group">
                    <input name="password" type="password" class="form-control" placeholder="Enter password">
                    <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit" name="login">
                                <span class="glyphicon glyphicon-log-in"></span>
                    </button>
                    </span>
                </div>
            </form>

            <?php
        }
        ?>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <!-- Bringing categories from the database -->
                    <?php
                    $query = "SELECT * FROM categories";
                    $select_all_categories_query = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];
                        echo "<li><a href='category.php?cat_id={$cat_id}'>{$cat_title}</a></li>";
                    }
                    ?>

                </ul>
            </div>

            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>
</div>