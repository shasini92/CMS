<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Home</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">

                <?php
                $page_name = basename($_SERVER['PHP_SELF']);
                switch ($page_name) {
                    case "registration.php":
                        $registration_class = "active";
                        break;
                    case "contact.php":
                        $contact_class = "active";
                        break;
                    default:
                        $registration_class = "";
                        $contact_class = "";
                }
                ?>

                <?php
                if (isset($_SESSION['user_role'])) {
                    echo "<li><a href='admin/index.php'>Admin</a></li>";
                }
                if(!isset($_SESSION['user_role']))
                {
                   echo '<li class="<?php echo $registration_class; ?>"><a href="registration.php">Registration</a></li>';
                }


                ?>

                <li class="<?php echo $contact_class; ?>"><a href="contact.php">Contact Us</a></li>

                <?php
                if (isset($_SESSION['user_role']) && isset($_GET['p_id'])) {
                    $p_id = $_GET['p_id'];
                    echo "<li><a href='admin/posts.php?source=edit_post&p_id={$p_id}'>Edit Post</a></li>";
                }
                ?>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>