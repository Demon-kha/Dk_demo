<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boxing Registration System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        h1, h3 {
            color: #333;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        h3 {
            text-align: right;
            margin: 20px 30px 0 0;
        }
        h3 a {
            text-decoration: none;
            color: #007bff;
            transition: color 0.3s;
        }
        h3 a:hover {
            color: #0056b3;
        }
        #user-reg {
            text-align: left;
            margin: 20px 0 0 30px;
        }
        #user-reg a {
            text-decoration: none;
            color: #007bff;
            transition: color 0.3s;
        }
        #user-reg a:hover {
            color: #0056b3;
        }
        form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 60vh;
        }
        table {
            border: 1px solid #ddd;
            border-collapse: collapse;
            width: 100%;
            max-width: 500px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
        }
        td {
            background-color: #ffffff;
        }
        tr:nth-child(even) td {
            background-color: #f9f9f9;
        }
        tr:hover td {
            background-color: #f1f1f1;
        }
        input[type="text"], select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h3 id="user-reg"><a href="userreg.php">User Registration</a></h3>
    <h3><a href="login.php">Admin login</a></h3>
    <h1>Welcome To Boxing Registration System</h1>
    <form action="index.php" method="post">
        <table>
            <tr>
                <th colspan="2" style="text-align: center;">User Information</th>
            </tr>
            <tr>
                <td>Choose Level</td>
                <td>
                    <select name="std" required>
                        <option value="Basic">Basic</option>
                        <option value="Advance">Advance</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Enter Registration Number</td>
                <td>
                    <input type="text" name="regno" required>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="submit" name="submit" value="Show Details">
                </td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $level = $_POST['std'];
        $regno = $_POST['regno'];
        include('dbcon.php');
        include('admin/function.php');
        showdetails($level, $regno);
    }
    ?>
</body>
</html>
