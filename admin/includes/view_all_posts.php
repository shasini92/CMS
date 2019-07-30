<?php
include("delete_modal.php");

if (isset($_POST['checkBoxArray'])) {

    $bulk_option = $_POST['bulk_options'];

    foreach ($_POST['checkBoxArray'] as $postValueId) {

        switch ($bulk_option) {
            case 'Published':
                $query = "UPDATE posts SET post_status = '{$bulk_option}' WHERE post_id = {$postValueId}";
                $update_query = mysqli_query($connection, $query);
                break;
            case 'Draft':
                $query = "UPDATE posts SET post_status = '{$bulk_option}' WHERE post_id = {$postValueId}";
                $update_query = mysqli_query($connection, $query);
                break;
            case 'Clone':
                $query = "SELECT* FROM posts WHERE post_id = {$postValueId}";
                $select_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_query)) {
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
                $clone_query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
                $clone_query .= "VALUES  ({$post_category_id},'$post_title','$post_author',CURRENT_DATE(),'$post_image','$post_content','$post_tags','$post_comment_count','$post_status')";
                $clone_post_query = mysqli_query($connection, $clone_query);
                break;
            case 'Delete':
                $query = "DELETE FROM posts WHERE post_id = '{$postValueId}'";
                $delete_query = mysqli_query($connection, $query);
                break;

        }
    }
}
?>

<form action="" method="post">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" class="col-xs-4" style="padding-left: 0px">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="Published">Publish</option>
                <option value="Draft">Draft</option>
                <option value="Delete">Delete</option>
                <option value="Clone">Clone</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
        </div>
        <br>
        <br>
        <thead>
        <tr>
            <th><input type="checkbox" name="" id="selectAllBoxes"></th>
            <th>Post ID</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Views</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $query = "SELECT posts.*, categories.* FROM posts ";
        $query .= "LEFT JOIN categories ON posts.post_category_id = categories.cat_id ";
        $query .= "ORDER BY posts.post_date DESC";
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
            $post_views_count = $row['post_views_count'];
            $cat_title = $row['cat_title'];
            $cat_id = $row['cat_id'];

            echo "
                    <tr>
                    <td><input class='checkboxes' type='checkbox' name='checkBoxArray[]' value={$post_id}></td>
                    <td>$post_id</td>
                    <td>$post_author</td>
                    <td><a href='../post.php?p_id={$post_id}'>$post_title</a></td>                            
                    <td>$cat_title</td>
                    <td>$post_status</td>
                    <td><img width='100' style='margin: auto; display: block' src='../images/$post_image' alt=''></td>
                    <td>$post_tags</td>
                    <td>$post_comment_count</td>
                    <td>$post_date</td>                            
                    <td>$post_views_count</td>                            
                    <td><a class='btn btn-info center-block' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>   
                    <td><a rel='$post_id' class='btn btn-danger center-block delete_link' href='javascript:void(0)'>Delete</a></td>     
                    </tr >  
                    ";
        }
        ?>

        </tbody>
    </table>
</form>

<?php
if (isset($_GET['delete'])) {
    $post_id = $_GET['post_id'];

    $query = "DELETE FROM posts WHERE post_id = '{$post_id}'";
    $delete_query = mysqli_query($connection, $query);

    header("Location: posts.php");
}
?>

<script>
    $(document).ready(function () {

        $(".delete_link").on('click',function () {
            let id = $(this).attr("rel");
            let delete_url = "posts.php?delete&post_id=" + id;
            $(".modal_delete_link").attr("href", delete_url);
            $("#myModal").modal('show');
        })
    })
</script>

