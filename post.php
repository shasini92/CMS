<?php
include "includes/header.php";
include "includes/db.php";
?>
    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">
    <div class="row">

        <!-- Blog Entries Column -->

        <div class="col-md-8">

            <!-- Blog posts -->
            <?php

            if (isset($_GET['p_id'])) {

                $post_id = $_GET['p_id'];
                
                // Update how many views each post has
                $views_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id={$post_id}";
                $update_views_query = mysqli_query($connection,$views_query);

                // Getting the post data from the database
                $query = "SELECT * FROM posts where post_id={$post_id}";
                $select_all_posts_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];

                    ?>

                    <h2>
                        <a href="#"><?php echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                    <hr>
                    <p><?php echo $post_content; ?></p>

                    <hr>

                    <!-- Closing } of the while loop -->
                    <?php
                }
            }else{
                //Redirecting if the post ID isn't set
                header("Location: index.php");
            }
            
            // Adding comments section
            include "includes/comments.php";

            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

<?php include "includes/footer.php"; ?>