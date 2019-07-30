<?php ob_start(); ?>
<?php
// This file defines connection parameters
// define function is used to create constants

define('HOST', 'localhost');
define('USER', 'your_username');
define('PASSWORD', 'your_password');
define('DATABASE', 'cms');

$connection = mysqli_connect(HOST, USER,PASSWORD,DATABASE);

?>