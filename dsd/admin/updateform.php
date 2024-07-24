<?php
session_start();
if (isset($_SESSION['uid'])) {
    echo "";
} else {
    header('Location: ../login.php');
    exit();  
}
?>
<?php
include('header.php');
include('titlehead.php');
include('../dbcon.php');
$sid = $_GET['Sid'];
$sql = "SELECT * FROM members WHERE `id`='$sid'"; 
$run = mysqli_query($con, $sql);

if ($run) {
    $data = mysqli_fetch_assoc($run);
} else {
    echo "Error: " . mysqli_error($con);
}
?>
<form action="updatedata.php" enctype="multipart/form-data" method="post">
    <table align="center" border="1" style="width:70%; margin-top: 40px;">
        <tr><th>Registration NO</th>
            <td><input type="text" name="regno" value="<?php echo $data['rno']; ?>" required></td>
        </tr>
        <tr><th>Full Name</th>
            <td><input type="text" name="name" value="<?php echo $data['name']; ?>" required></td>
        </tr>
        <tr><th>City</th>
            <td>
                <select name="city" required>
                    <option value="0">choose your city</option>
                    <option value="Damak" <?php if($data['city'] == 'Damak') echo 'selected'; ?>>Damak</option>
                    <option value="Biratnagar" <?php if($data['city'] == 'Biratnagar') echo 'selected'; ?>>Biratnagar</option>
                    <option value="Birthamode" <?php if($data['city'] == 'Birthamode') echo 'selected'; ?>>Birthamode</option>
                    <option value="Ithari" <?php if($data['city'] == 'Ithari') echo 'selected'; ?>>Ithari</option>
                    <option value="Kathmandu" <?php if($data['city'] == 'Kathmandu') echo 'selected'; ?>>Kathmandu</option>
                    <option value="Pokhara" <?php if($data['city'] == 'Pokhara') echo 'selected'; ?>>Pokhara</option>
                    <option value="Taplejung" <?php if($data['city'] == 'Taplejung') echo 'selected'; ?>>Taplejung</option>
                    <option value="Bhadrapur" <?php if($data['city'] == 'Bhadrapur') echo 'selected'; ?>>Bhadrapur</option>
                </select>
            </td>
        </tr>
        <tr><th>Parents Contact No</th>
            <td><input type="text" name="pcon" value="<?php echo $data['pcont']; ?>" required></td>
        </tr>
        <tr><th>Level</th>
            <td>
                <select name="std" required>
                    <option value="0">choose your course</option>
                    <option value="Basic" <?php if($data['standard'] == 'Basic') echo 'selected'; ?>>Basic</option>
                    <option value="Advance" <?php if($data['standard'] == 'Advance') echo 'selected'; ?>>Advance</option>
                </select>
            </td>
        </tr>
        <!-- <tr><th>Image</th>
            <td><input type="file" name="simg" required></td>
        </tr> -->
        <tr>
            <td colspan="2" align="center">
                <input type="hidden" name="sid" value="<?php echo $sid; ?>">
                <input type="hidden" name="sid" value="<?php echo $data['id']; ?>" />
                <input type="submit" name="submit" value="Submit">
            </td>
        </tr>
    </table>
</form>
