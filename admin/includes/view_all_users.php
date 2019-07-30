<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Image</th>
        <th>Role</th>
        <th>Change Role</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $query = "SELECT * FROM users";
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

        echo "
                            <tr>
                            <td>$user_id</td>
                            <td>$user_username</td>                          
                            <td>$user_firstname</td>
                            <td>$user_lastname</td>
                            <td>$user_email</td>                            
                            <td><img width='100' style='margin: auto; display: block' src='../images/$user_image' alt=''></td>
                            <td>$user_role</td>                               
                            <td><a href='users.php?change_role={$user_id}&user_role=$user_role'>Change Role</a></td> 
                            <td><a href='users.php?source=edit_user&user_id={$user_id}'>Edit</a></td>            
                            <td><a onClick=\"return confirm('Are you sure you want to delete this user?');\" href='users.php?delete={$user_id}'>Delete</a></td>
                            </tr >
                            ";
    }

    ?>

    </tbody>
</table>

<?php

if (isset($_GET['delete']) && ($_SESSION['user_role'] == "Administrator")) {

    $user_id = mysqli_real_escape_string($connection, $_GET['delete']);

    $query = "DELETE FROM users WHERE user_id = '{$user_id}'";
    $delete_query = mysqli_query($connection, $query);

    header("Location: users.php");

}
if (isset($_GET['change_role'])) {

    $user_id = $_GET['change_role'];
    $user_role = $_GET['user_role'];

    if ($user_role == "Administrator") {
        $new_user_role = "Subscriber";
    } else if ($user_role == "Subscriber") {
        $new_user_role = "Administrator";
    }

    $query = "UPDATE users SET user_role='{$new_user_role}' WHERE user_id='{$user_id}'";
    $update_query = mysqli_query($connection, $query);

    header("Location: users.php");
}
?>