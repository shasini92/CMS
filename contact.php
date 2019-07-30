<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<?php
if (isset($_POST['submit'])) {

    $subject = mysqli_real_escape_string($connection, $_POST['subject']);
    $message = mysqli_real_escape_string($connection, $_POST['body']);
    $email = "From: ".mysqli_real_escape_string($connection, $_POST['email']);
    $to = "shasini92@gmail.com";

    if (!empty($subject) && !empty($message) && !empty($email)) {
//        mail($to, $subject, $message, $email);

        $message = "Your message has been sent.";

//    header("Location: users.php");
    } else {
        $message = "Please enter all the fields.";
    }

} else {
    $message = "";
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
                        <h1 class="text-center">Contact</h1>
                        <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                            <h4 class="text-center "><?php echo $message; ?></h4>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="text" name="email" id="email" class="form-control"
                                       placeholder="Enter Your Email">
                            </div>
                            <div class="form-group">
                                <label for="subject" class="sr-only">Subject</label>
                                <input type="subject" name="subject" id="subject" class="form-control"
                                       placeholder="Subject">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <textarea name="body" class="form-control"
                                          placeholder="Enter Your Message" rows="10"></textarea>
                            </div>
                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block"
                                   value="Send">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>
    <hr>
    <?php include "includes/footer.php"; ?>
