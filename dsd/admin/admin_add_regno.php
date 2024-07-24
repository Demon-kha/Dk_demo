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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Add Registration Numbers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
        }
        form {
            width: 50%;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 6px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>Admin Panel - Add Registration Numbers</h2>
<form action="admin_add_regno.php" method="post">
    <label for="regno">Enter Registration Number:</label>
    <input type="text" id="regno" name="regno" placeholder="Enter registration number" required>
    <input type="submit" name="submit" value="Add Registration Number">
</form>

</body>
</html>

<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('Location: ../login.php');
    exit();
}

if (isset($_POST['submit'])) {
    include('../dbcon.php');
    
    $regno = mysqli_real_escape_string($con, $_POST['regno']);

    // Check if the registration number already exists in the valid_regnos table
    $check_query = "SELECT * FROM valid_regnos WHERE regno='$regno'";
    $check_run = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_run) > 0) {
        echo "<script>alert('Registration Number already exists in the database.')</script>";
    } else {
        // Insert the registration number into the valid_regnos table
        $insert_query = "INSERT INTO valid_regnos (regno) VALUES ('$regno')";
        $insert_run = mysqli_query($con, $insert_query);

        if ($insert_run) {
            echo "<script>alert('Registration Number added successfully.')</script>";
            echo "<script>window.open('admin_add_regno.php', '_self')</script>";
        } else {
            echo "<script>alert('Failed to add Registration Number: " . mysqli_error($con) . "')</script>";
        }
    }
}
?>
