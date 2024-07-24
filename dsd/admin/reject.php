<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('Location: ../login.php');
    exit();
}

include('../dbcon.php');

$id = $_GET['id'];
$sql = "UPDATE members SET rejected=1 WHERE id='$id'";
$run = mysqli_query($con, $sql);

if ($run) {
    echo '<script>window.open("selectusr.php", "_self");</script>';
} else {
    echo '<script>alert("Rejection failed: ' . mysqli_error($con) . '");</script>';
}
?>
