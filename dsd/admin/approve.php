<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('Location: ../login.php');
    exit();
}

include('../dbcon.php');
if (isset($_POST['approve'])) {
    $id = $_POST['id'];
    $qry = "UPDATE members SET approved=1 WHERE id=$id";
    if (mysqli_query($con, $qry)) {
        ?>
        <script>
            // alert("User approved successfully.");
            window.open('selectusr.php', '_self');
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Approval failed: <?php echo mysqli_error($con); ?>");
            window.open('selectusr.php', '_self');
        </script>
        <?php
    }
}
?>
