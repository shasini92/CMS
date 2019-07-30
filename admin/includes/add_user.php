<?php
if (isset($_POST['create_user'])) {
    $user_id = $_POST['user_id'];
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_role = $_POST['user_role'];

    $query = "SELECT randSalt FROM users";
    $select_randSalt_query = mysqli_query($connection, $query);

    $row = mysqli_fetch_array($select_randSalt_query);
    $salt = $row['randSalt'];

    $user_password = crypt($user_password, $salt);


// Files superglobal stores the image on the server and we need to move it to local storage
    move_uploaded_file($user_image_temp, "../images/$user_image");

    $query = "INSERT INTO users (user_username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) ";
    $query .= "VALUES  ('$user_username','$user_password','$user_firstname','$user_lastname','$user_email','$user_image','$user_role')";
    $create_user_query = mysqli_query($connection, $query);
    header("Location: users.php");
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="user_username" id="">
    </div>
    <div class="form-group">
        <label for="author">Password</label>
        <input type="text" class="form-control" name="user_password" id="">
    </div>
    <div class="form-group">
        <label for="post_status">First Name</label>
        <input type="text" class="form-control" name="user_firstname" id="">
    </div>
    <div class="form-group">
        <label for="post_status">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" id="">
    </div>
    <div class="form-group">
        <label for="post_status">Email</label>
        <input type="text" class="form-control" name="user_email" id="">
    </div>
    <div class="form-group">
        <label for="post_image">User Image</label>
        <input type="file" name="user_image" id="">
    </div>
    <div class="form-group">
        <label for="post_tags">Role</label>
        <br>
        <select name="user_role" id="">
            <option value='Administrator'>Administrator</option>
            <option value='Subscriber'>Subscriber</option>
        </select>

    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" id="" value="Create a User">
    </div>
</form>