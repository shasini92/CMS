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

            <h1 class="page-header">
                Welcome to our Blog.
            </h1>

            <!-- Blog posts -->
            <?php
            if (isset($_POST['submit'])) {
                $search = $_POST['search'];
                $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status = 'Published'";
                $search_query = mysqli_query($connection, $query);
                $count = mysqli_num_rows($search_query);

                if($count>0) {

                    while ($row = mysqli_fetch_assoc($search_query)) {
                        $post_title = $row['post_title'];
                        $post_id = $row['post_id'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];

                        ////    Checking to see if the query is fetching any results
                        //    if(!$search_query){
                        //        die("Query Failed". mysqli_error($connection));
                        //    }else{
                        //        echo $count = mysqli_num_rows($search_query);
                        //    }

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
                        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span
                                    class="glyphicon glyphicon-chevron-right"></span></a>
                        <hr>

                        <!-- Closing } of the while loop -->
                        <?php
                    }
                }else{
                    echo "<h1> No results found. </h1>";
                }
            }

            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

<?php include "includes/footer.php"; ?>