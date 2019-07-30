<?php

if (isset($_GET['p_id'])) {
    $p_id = $_GET['p_id'];
}

$query = "SELECT * FROM posts WHERE post_id = {$p_id}";
$select_posts = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_posts)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_content = $row['post_content'];

}

if (isset($_POST['update_post'])) {

    $post_author = $_POST['author'];
    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    move_uploaded_file($post_image_temp, "../images/$post_image");

//    Checking to see if the image was submitted while editing, if not, use the same one;
    if (empty($post_image)) {
        $query = "SELECT * FROM posts where post_id = {$p_id}";
        $select_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($select_query)) {
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}',";
    $query .= "post_category_id = '{$post_category_id}',";
    $query .= "post_date = CURRENT_DATE(), ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE post_id = {$p_id}";

    $update_query = mysqli_query($connection, $query);

    if (!$update_query) {
        die(mysqli_error($connection));
    }
    echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$p_id}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";
}
?>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" value="<?php echo $post_title; ?>" class="form-control" name="title" id="">
    </div>
    <div class="form-group">
        <label for="post_category_id">Post Category</label>
        <br>
        <select name="post_category_id" id="">

            <?php
            $query = "SELECT * FROM categories";
            $select_categories_query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_categories_query)) {
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];

                echo "<option value='$cat_id'>$cat_title</option>";

            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" value="<?php echo $post_author; ?>" class="form-control" name="author" id="">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <br>
        <select name="post_status" id="">
            <option value='<?php echo $post_status ?>'><?php echo $post_status ?></option>
            <?php
            if ($post_status == 'Published') {
                echo "<option value = 'Draft' >Draft</option >";
            } else {
                echo "<option value = 'Published' >Published</option >";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <br>
        <img width="200" src="../images/<?php echo $post_image; ?>" alt="">
        <br>
        <br>

        <input type="file" name="image" id="">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" value="<?php echo $post_tags; ?>" class="form-control" name="post_tags" id="">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30"
                  rows="20"><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" id="" value="Update Post">
    </div>

</form>

