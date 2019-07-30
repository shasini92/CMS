<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "admin/includes/functions.php"; ?>

<?php
if (isset($_POST['submit'])) {

    $username = trim(mysqli_real_escape_string($connection, $_POST['username']));
    $password = trim(mysqli_real_escape_string($connection, $_POST['password']));
    $email = trim(mysqli_real_escape_string($connection, $_POST['email']));

    $error = [
        'username' => '',
        'email' => '',
        'password' => ''
    ];

    if (strlen($username) < 6) {
        $error['username'] = "Username needs to be at least 6 characters long.";
    }
    if ($username == '') {
        $error['username'] = "Username cannot be empty.";
    }
    if ($password == '') {
        $error['password'] = "Password cannot be empty.";
    }
    if (strlen($password) < 6) {
        $error['password'] = "Password needs to be at least 6 characters long.";
    }
    if ($email == '') {
        $error['email'] = "Email cannot be empty.";
    }
    if (username_exists($username)) {
        $error['username'] = "Username already exists. <a href='index.php'>Please Login</a>";
    }
    if (email_exists($email)) {
        $error['email'] = "Email already exists. <a href='index.php'>Please Login</a>";
    }

    foreach ($error as $key => $value) {

        if (empty($value)) {
            unset($error[$key]);
        }

    }

    if (empty($error)) {
        // Creating a new user

        $query = "SELECT randSalt FROM users";
        $select_randSalt_query = mysqli_query($connection, $query);

        $row = mysqli_fetch_array($select_randSalt_query);
        $salt = $row['randSalt'];

        $password = crypt($password, $salt);

        $query = "INSERT INTO users (user_username, user_password, user_email, user_role) ";
        $query .= "VALUES  ('$username','$password','$email','Subscriber')";
        $create_user_query = mysqli_query($connection, $query);

        // Logging in the new user
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

        }

        $_SESSION['username'] = $db_user_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        $_SESSION['user_id'] = $db_user_id;

        header("Location: index.php");

    }

}
?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1 class="text-center">Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                       placeholder="Enter Desired Username" autocomplete="on"
                                       value="<?php echo isset($username) ? $username : '' ?>">
                                <p style="padding-top: 5px;"><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                       placeholder="somebody@example.com" autocomplete="on"
                                       value="<?php echo isset($email) ? $email : '' ?>">
                                <p style="padding-top: 5px;"><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control"
                                       placeholder="Password">
                                <p style="padding-top: 5px;"><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block"
                                   value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>
    <hr>
    <?php include "includes/footer.php"; ?>
