<?php

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

$query = "SELECT * FROM users WHERE user_id = {$user_id}";
$select_users = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_users)) {
    $user_id = $row['user_id'];
    $user_username = $row['user_username'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
}

if (isset($_POST['update_user'])) {
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    move_uploaded_file($user_image_temp, "../images/$user_image");

    $query = "SELECT randSalt FROM users";
    $select_randSalt_query = mysqli_query($connection, $query);

    $row = mysqli_fetch_array($select_randSalt_query);
    $salt = $row['randSalt'];

    $user_password = crypt($user_password, $salt);

//    Checking to see if the image was submitted while editing, if not, use the same one;
    if (empty($user_image)) {
        $query = "SELECT * FROM users where user_id = {$user_id}";
        $select_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($select_query)) {
            $user_image = $row['user_image'];
        }
    }

    $query = "UPDATE users SET ";
    $query .= "user_username = '{$user_username}',";
    $query .= "user_password = '{$user_password}',";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "user_image = '{$user_image}' ";
    $query .= "WHERE user_id = '{$user_id}'";

    $update_query = mysqli_query($connection, $query);

    if (!$update_query) {
        die(mysqli_error($connection));
    }

    header("Location: users.php");

}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="user_username" id="" value="<?php echo $user_username ?>">
    </div>
    <div class="form-group">
        <label for="author">Password</label>
        <input type="password" class="form-control" name="user_password" id="" value="<?php echo $user_password ?>">
    </div>
    <div class="form-group">
        <label for="post_status">First Name</label>
        <input type="text" class="form-control" name="user_firstname" id="" value="<?php echo $user_firstname ?>">
    </div>
    <div class="form-group">
        <label for="post_status">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" id="" value="<?php echo $user_lastname ?>">
    </div>
    <div class="form-group">
        <label for="post_status">Email</label>
        <input type="text" class="form-control" name="user_email" id="" value="<?php echo $user_email ?>">
    </div>
    <div class="form-group">
        <label for="post_image">User Image</label>
        <br>
        <img width="200" src="../images/<?php echo $user_image; ?>" alt="">
        <br>
        <br>
        <input type="file" name="user_image" id="">
    </div>
    <div class="form-group">
        <label for="user_role">User Role</label>
        <br>
        <select name="user_role" id="">
            <option value='<?php echo $user_role ?>'><?php echo $user_role ?></option>
            <?php
            if ($user_role == 'Administrator') {
                echo "<option value = 'Subscriber' >Subscriber</option >";
            } else {
                echo "<option value = 'Administrator' >Administrator</option >";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_user" id="" value="Update a User">
    </div>
</form>

