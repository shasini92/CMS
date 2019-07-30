<?php include "db.php"; ?>
<?php include "../admin/includes/functions.php" ?>
    <!--Starting a session-->
<?php session_start(); ?>

<?php

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $query = "SELECT * FROM users WHERE user_username='{$username}'";
    $select_user_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($select_user_query)) {

        $db_user_id = $row['user_id'];
        $db_user_username = $row['user_username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_email = $row['user_email'];
        $db_user_image = $row['user_image'];
        $db_user_role = $row['user_role'];
        $randSalt = $row['randSalt'];

    }

    $password = crypt($password, $randSalt);

    if ($username !== $db_user_username || $password !== $db_user_password)
    {
        header("Location: ../index.php");

    } else
        if ($username == $db_user_username && $password == $db_user_password) {
            // Giving a session a name
            $_SESSION['username'] = $db_user_username;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;
            $_SESSION['user_id'] = $db_user_id;

            header("Location: ../admin");
        }
};
?>