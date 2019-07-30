<!-- Blog Comments -->

<?php
if (isset($_POST['create_comment'])) {
    // Getting Comment Data
    $post_id = $_GET['p_id'];
    $comment_author = $_POST['comment_author'];
    $comment_email = $_POST['comment_email'];
    $comment_content = $_POST['comment_content'];
    
    // Checking for empty fields and submitting the query to the database
    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){

        $query = "INSERT INTO comments (comment_post_id, comment_author,comment_email,comment_content,comment_status, comment_date) ";
        $query .= "VALUES ($post_id, '{$comment_author}','{$comment_email}','{$comment_content}','Unapproved', NOW())";
        $create_comment_query = mysqli_query($connection, $query);

        $update_count_query = "UPDATE posts SET post_comment_count= (post_comment_count + 1) ";
        $update_count_query .= "WHERE post_id = {$post_id}";
        $update_comment_query = mysqli_query($connection, $update_count_query);
    }else{
        echo "<script>alert('Fields cannot be empty')</script>";
    }
}
?>
<!-- Comments Form -->
<div class="well">
    <h4>Leave a Comment:</h4>
    <form action="" method="post" role="form">
        <div class="form-group">
            <label for="comment_author">Author</label>
            <input type="text" class="form-control" name="comment_author">
        </div>
        <div class="form-group">
            <label for="comment_email">Email</label>
            <input type="email" class="form-control" name="comment_email">
        </div>
        <div class="form-group">
            <label for="comment_content">Your Comment</label>
            <textarea class="form-control" rows="3" name="comment_content"></textarea>
        </div>
        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
    </form>
</div>

<hr>

<!-- Posted Comments -->
<?php

$query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
$query .= "AND comment_status='Approved' ORDER BY comment_date DESC";
$show_comments_query = mysqli_query($connection, $query);

if(!$show_comments_query){
    die(mysqli_error($connection));
}

while ($row = mysqli_fetch_array($show_comments_query)) {
    $comment_date = $row['comment_date'];
    $comment_content = $row['comment_content'];
    $comment_author = $row['comment_author'];
    ?>

<?php
echo "<div class='media'>
    <a class='pull-left' href='#'>
        <img class='media-object' src='http://placehold.it/64x64' alt=''>
    </a>
    <div class='media-body'>
        <h4 class='media-heading'>$comment_author
            <small>$comment_date</small>
        </h4>
    $comment_content
    </div>
</div>"
    ?>

<?php
}
?>



