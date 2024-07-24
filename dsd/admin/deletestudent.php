<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['uid'])) {
    header('Location: ../login.php');
    exit();
}
?>

<?php
include('header.php');
include('titlehead.php');
?>

<!-- Form for selecting the level -->
<table align="center">
    <form id="levelForm" action="deletestudent.php" method="post">
        <tr>
            <th>Enter Level</th>
            <td>
                <select name="level" required onchange="document.getElementById('levelForm').submit();">
                    <option value="">Select Level</option>
                    <option value="Basic">Basic</option>
                    <option value="Advance">Advance</option>
                </select>
            </td>
        </tr>
    </form>
</table>

<!-- Table for displaying results -->
<table align="center" width="80%" border="1" style="margin-top: 10px;">
    <tr style="background-color:#000; color:#fff;">
        <th>NO</th>
        <th>Name</th>
        <th>Registration Number</th>
        <th>City</th>
        <th>Parents NO</th>
        <th>Edit</th>
    </tr>

    <?php
    if (isset($_POST['level'])) {
        include('../dbcon.php');
        $level = $_POST['level'];

        // SQL query to fetch approved members based on the selected level
        $sql = "SELECT * FROM `members` WHERE `standard`='$level' AND `approved`=1";
        $run = mysqli_query($con, $sql);

        if (mysqli_num_rows($run) < 1) {
            echo "<tr><td colspan='6'>No records found</td></tr>";
        } else {
            $count = 0;
            while ($data = mysqli_fetch_assoc($run)) {
                $count++;
                ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $data['name']; ?></td>
                    <td><?php echo $data['rno']; ?></td>
                    <td><?php echo $data['city']; ?></td>
                    <td><?php echo $data['pcont']; ?></td>
                    <td><a href="deleteform.php?Sid=<?php echo $data['id']; ?>">Edit</a></td>
                </tr>
                <?php
            }
        }
    }
    ?>
</table>

</body>
</html>
