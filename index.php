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
            <!-- Getting posts based on Pagination -->
            <?php

            $per_page = 5;

            if (isset($_GET['page'])) {

                $page = $_GET['page'];

                if ($page == 1) {
                    $page_offset = 0;
                } else {
                    $page_offset = $page * $per_page;
                }

            } else {
                $page = 1;
                $page_offset = 0;
            }

            $count_query = "SELECT * FROM posts";
            $post_count_query = mysqli_query($connection, $count_query);
            $page_count = ceil(mysqli_num_rows($post_count_query) / 5);


            $query = "SELECT * FROM posts where post_status = 'Published' LIMIT {$page_offset}, {$per_page}";
            $select_all_posts_query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_title = $row['post_title'];
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'], 0, 220);
                $post_comment_count = $row['post_comment_count'];

                ?>

                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <h5>Comments : <?php echo $post_comment_count; ?></h5>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive"
                                                                     src="images/<?php echo $post_image; ?>" alt=""></a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span
                            class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <!-- Closing } of the while loop -->
                <?php
            }
            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->
    
    <!-- Pagination -->
    <ol class="pager">
        <?php

        for ($i = 1; $i < $page_count; $i++) {
            if ($i == $page) {
                echo "<li><a style='background: #60dcf9; color: #fff;' href='index.php?page={$i}'>{$i}</a></li>";
            } else {
                echo "<li><a  href='index.php?page={$i}'>{$i}</a></li>";


            }
        }
        ?>
    </ol>

    <hr>
<?php include "includes/footer.php"; ?>