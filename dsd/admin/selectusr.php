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
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .approve, .reject {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .approve {
            background-color: #28a745;
            color: #fff;
        }
        .reject {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>
   
    <table>
        <tr>
            <th>Registration No</th>
            <th>Name</th>
            <th>City</th>
            <th>Parents Contact No</th>
            <th>Level</th>
            <th>Action</th>
        </tr>
        <?php
        include('../dbcon.php');
        $qry = "SELECT * FROM members WHERE approved=0";
        $run = mysqli_query($con, $qry);
        if (mysqli_num_rows($run) > 0) {
            while ($row = mysqli_fetch_assoc($run)) {
                ?>
                <tr>
                    <td><?php echo $row['rno']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['city']; ?></td>
                    <td><?php echo $row['pcont']; ?></td>
                    <td><?php echo $row['standard']; ?></td>
                    <td>
                        <form action="approve.php" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="submit" name="approve" value="Approve" class="approve">
                        </form>
                        <form action="reject.php" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="submit" name="reject" value="Reject" class="reject">
                        </form>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="6" style="text-align: center;">No pending registrations.</td>
            </tr>
            <?php
        }
        ?>
    </table>
</body>
</html>
