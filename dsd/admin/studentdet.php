<?php
session_start();
if (isset($_SESSION['uid'])) {
    echo "";
} else {
//     header('Location: ../login.php');
//     exit();  
//
 }
?>
<!-- <?php
include('header.php');
include('titlehead.php');
?> -->
<table align="center">
<form action="updatestudent.php" method="post">
    <tr>
        <th>Enter Level</th>
        <td>
            <select name="level" required>
                <option value="Basic">Basic</option>
                <option value="Advance">Advance</option>
            </select>
        </td>
        <th>Enter User Name:</th>
        <td><input type="text" name="name" placeholder="Enter Your Name:" required></td>
      
        <td colspan="2"><input type="submit" name="submit" value="search"></td>
    </tr>
</form>
</table>
<table align="center" width="80%" border="1" style="margin-top: 10px;">
<tr style="background-color:#000; color:#fff;"> 
    <th>NO</th>
    <th>Name</th>
    <th>Registration Number</th>
    <th>Edit</th>
</tr>
<?php
if (isset($_POST['submit'])) {
    include('../dbcon.php');
    $level = $_POST['level'];
    $name = $_POST['name'];
    $sql = "SELECT * FROM `members` WHERE `standard`='$level' AND `name` LIKE '%$name%'";
    $run = mysqli_query($con, $sql);
    if (mysqli_num_rows($run) < 1) {
        echo "<tr><td colspan='4'>No records found</td></tr>";
    } else {
        $count = 0;
        while ($data = mysqli_fetch_assoc($run)) {
            $count++;
            ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $data['name']; ?></td>
                <td><?php echo $data['rno']; ?></td>
                <td><a href="updateform.php?Sid=<?php echo $data['id']; ?>">Edit</a></td>
            </tr>
            <?php
        }
    }
}
?>
</table>
</body>
</html>