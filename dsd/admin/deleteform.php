<?php
include('../dbcon.php');

$id=$_REQUEST['sid'];
$qry  = "DELETE FROM members WHERE 'id'='$id';";

$run = mysqli_query($con, $qry);

if ($run == true) {
    ?>
    <script>
        // alert("Data Deleted successfully");
        window.open('deletestudent.php', '_self');
    </script>
    <?php
}
?>
