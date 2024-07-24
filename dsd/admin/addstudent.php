<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('Location: ../login.php');
    exit();
}
?>
<?php
include('header.php');
include('titlehead.php');
?>
<form action="addstudent.php" method="post">
    <table align="center" border="1" style="width:70%; margin-top: 40px;">
        <tr>
            <th>Registration NO</th>
            <td><input type="text" name="regno" placeholder="Enter your registration NO." required></td>
        </tr>
        <tr>
            <th>Full Name</th>
            <td><input type="text" name="name" placeholder="Enter your Full Name" required></td>
        </tr>
        <tr>
            <th>City</th>
            <td>
                <select name="city" required>
                    <option value="">Choose your city</option>
                    <option value="Damak">Damak</option>
                    <option value="Biratnagar">Biratnagar</option>
                    <option value="Birthamode">Birthamode</option>
                    <option value="Ithari">Ithari</option>
                    <option value="Kathmandu">Kathmandu</option>
                    <option value="Pokhara">Pokhara</option>
                    <option value="Taplejung">Taplejung</option>
                    <option value="Bhadrapur">Bhadrapur</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>Parents Contact No</th>
            <td><input type="text" name="pcon" placeholder="Enter your parents NO." required></td>
        </tr>
        <tr>
            <th>Level</th>
            <td>
                <select name="std" required>
                    <option value="">Choose your level</option>
                    <option value="Basic">Basic</option>
                    <option value="Advance">Advance</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="submit" value="Submit">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<?php
if (isset($_POST['submit'])) {
    include('../dbcon.php');

    $regno = mysqli_real_escape_string($con, $_POST['regno']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $pcon = mysqli_real_escape_string($con, $_POST['pcon']);
    $std = mysqli_real_escape_string($con, $_POST['std']);

    $qry = "INSERT INTO members (rno, name, city, pcont, standard, approved) VALUES ('$regno', '$name', '$city', '$pcon', '$std', 0)";
    $run = mysqli_query($con, $qry);

    if ($run) {
        ?>
        <script>
            alert("Registration submitted successfully. Awaiting admin approval.");
            window.open('addstudent.php', '_self');
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Data Insertion Failed: <?php echo mysqli_error($con); ?>");
        </script>
        <?php
    }
}
?>
