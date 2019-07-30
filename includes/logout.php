<?php ob_start(); ?>
<?php session_start(); ?>

<?php

$_SESSION['username'] = null;
$_SESSION['firstname'] = null;
$_SESSION['lastname'] = null;
$_SESSION['user_role'] = null;
$_SESSION['user_id'] = null;

header("Location:../index.php");

?>