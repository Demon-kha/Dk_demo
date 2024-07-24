<?php
function showdetails($standard, $regno) {
    include('dbcon.php');

    $sql = "SELECT * FROM members WHERE rno='$regno' AND standard='$standard' AND approved=1";
    $run = mysqli_query($con, $sql);

    if (!$run) {
        echo "<p>MySQL Error: " . mysqli_error($con) . "</p>";
        return;
    }

    if (mysqli_num_rows($run) > 0) {
        $data = mysqli_fetch_assoc($run);
        ?>
        <table border="1" style="width: 50%; margin-top: 20px; margin-left: auto; margin-right: auto; padding-left: 30px;">
            <tr>
                <th colspan="3">Student Details</th>
            </tr>
            <tr>
                <th>Registration Number</th>
                <td><?php echo $data['rno']; ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?php echo $data['name']; ?></td>
            </tr>
            <tr>
                <th>Level</th>
                <td><?php echo $data['standard']; ?></td>
            </tr>
            <tr>
                <th>Parents Contact No.</th>
                <td><?php echo $data['pcont']; ?></td>
            </tr>
            <tr>
                <th>City</th>
                <td><?php echo $data['city']; ?></td>
            </tr>
        </table>
        <?php
    } else {
        echo "<script>alert('No student found or the student has not been approved yet.');</script>";
    }
}
?>
