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
    <title>Admin Panel - See Registration Numbers</title>
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
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Admin Panel - See Registration Numbers</h2>

<table>
    <tr>
        <th>Registration Numbers</th>
    </tr>

    <?php
    include('../dbcon.php');

    $query = "SELECT * FROM valid_regnos";
    $run = mysqli_query($con, $query);

    if (mysqli_num_rows($run) < 1) {
        echo "<tr><td>No registration numbers found</td></tr>";
    } else {
        while ($data = mysqli_fetch_assoc($run)) {
            echo "<tr><td>{$data['regno']}</td></tr>";
        }
    }
    ?>

</table>

</body>
</html>
