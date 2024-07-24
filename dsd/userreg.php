<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boxing Registration System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        h1, h2 {
            text-align: center;
        }
        form {
            width: 50%;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        input[type="text"], select {
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

<h2>Boxing Registration Form</h2>
<form action="userreg.php" method="post">
    <table>
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

<?php
if (isset($_POST['submit'])) {
    include('dbcon.php');

    $regno = mysqli_real_escape_string($con, $_POST['regno']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $pcon = mysqli_real_escape_string($con, $_POST['pcon']);
    $std = mysqli_real_escape_string($con, $_POST['std']);

    // Check if the registration number exists in the valid_regnos table
    $valid_regno_qry = "SELECT * FROM valid_regnos WHERE regno='$regno'";
    $valid_regno_run = mysqli_query($con, $valid_regno_qry);

    if (mysqli_num_rows($valid_regno_run) > 0) {
        // Registration number is valid, insert into members table
        $qry = "INSERT INTO members (rno, name, city, pcont, standard, approved) VALUES ('$regno', '$name', '$city', '$pcon', '$std', 0)";
        $run = mysqli_query($con, $qry);

        if ($run) {
            echo "<script>
                alert('Data Inserted successfully');
                window.open('userreg.php', '_self');
            </script>";
        } else {
            echo "<script>
                alert('Data Insertion Failed: " . mysqli_error($con) . "');
            </script>";
        }
    } else {
        // Registration number is not valid
        echo "<script>
            alert('Invalid Registration Number');
        </script>";
    }
}
?>

</body>
</html>
