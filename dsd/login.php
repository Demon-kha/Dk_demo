<?php
session_start();
if (isset($_SESSION['uid'])) {
    header('Location: admin/admindash.php');
    exit; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
        }
        input[type="text"], input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Admin Login</h1>
        <form action="login.php" method="post">
            <table>
                <tr>
                    <td>
                        Username: <input type="text" name="uname" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Password: <input type="password" name="pass" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="login" value="Login">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>

<?php
include('dbcon.php');
if (isset($_POST['login'])) {
    $username = $_POST['uname'];
    $password = $_POST['pass'];
    $qry = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $run = mysqli_query($con, $qry);
    $row = mysqli_num_rows($run);
    if ($row < 1) {
        ?>
        <script>
            alert('Username and password do not match !!');
            window.open('login.php','_self');
        </script>
        <?php
    } else {
        $data = mysqli_fetch_assoc($run);
        $id = $data['id'];
        $_SESSION['uid'] = $id;
        header('Location: admin/admindash.php');
    }
}
?>
