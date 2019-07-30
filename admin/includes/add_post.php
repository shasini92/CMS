<?php
if (isset($_POST['create_post'])) {
    $post_author = $_POST['author'];
    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_comment_count = 0;

// Files superglobal stores the image on the server and we need to move it to local storage
    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
    $query .= "VALUES  ({$post_category_id},'$post_title','$post_author',CURRENT_DATE(),'$post_image','$post_content','$post_tags','$post_comment_count','$post_status')";
    $create_post_query = mysqli_query($connection, $query);
    header("Location: posts.php");
}

?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" id="">
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
        <input type="text" class="form-control" name="author" id="">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <br>
        <select name="post_status" id="">
            <option value='Published'>Published</option>
            <option value='Draft'>Draft</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image" id="">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" id="">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="20"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" id="" value="Publish Post">
    </div>

</form>