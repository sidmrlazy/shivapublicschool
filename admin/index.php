<?php
session_start();
if (isset($_SESSION["user_contact"])) {
    header("location:dashboard.php");
}
?>
<?php include('includes/header.php') ?>
<?php include('includes/login-form.php') ?>
<?php include('includes/footer.php') ?>