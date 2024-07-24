<?php
include('../dbcon.php');
$regno = $_POST['regno'];
$name = $_POST['name'];
$city = $_POST['city'];
$pcon = $_POST['pcon'];
$std = $_POST['std'];
$id = $_POST['sid'];

$qry  = "UPDATE members SET 
            rno = '$regno', 
            name = '$name', 
            city = '$city', 
            pcont = '$pcon', 
            standard = '$std' 
            WHERE id = '$id'";

$run = mysqli_query($con, $qry);

if ($run == true) {
    ?>
    <script>
        alert("Data updated successfully");
        window.open('updatestudent.php?sid=<?php echo $id; ?>', '_self');
    </script>
    <?php
}
?>
