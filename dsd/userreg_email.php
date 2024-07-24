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
        input[type="email"] {
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

<h2>Boxing Registration Email Submission</h2>
<form action="userreg_email.php" method="post">
    <label for="email">Enter your email:</label>
    <input type="email" id="email" name="email" required>
    <input type="submit" name="submit" value="Submit">
</form>

<?php
if (isset($_POST['submit'])) {
    include('dbcon.php');
    require 'vendor/autoload.php';  // Make sure the path to PHPMailer autoload is correct

    $email = mysqli_real_escape_string($con, $_POST['email']);

    // Check if the email is already used
    $email_check_query = "SELECT * FROM registration_requests WHERE email='$email'";
    $email_check_result = mysqli_query($con, $email_check_query);

    if (mysqli_num_rows($email_check_result) > 0) {
        $email_data = mysqli_fetch_assoc($email_check_result);
        if ($email_data['request_count'] >= 4) {
            echo "<script>alert('You have reached the maximum number of requests.');</script>";
        } else {
            // Increment request count
            $new_count = $email_data['request_count'] + 1;
            $update_count_query = "UPDATE registration_requests SET request_count='$new_count' WHERE email='$email'";
            mysqli_query($con, $update_count_query);

            // Get an unused registration number
            $regno_query = "SELECT regno FROM valid_regnos WHERE used=FALSE LIMIT 1";
            $regno_result = mysqli_query($con, $regno_query);

            if (mysqli_num_rows($regno_result) > 0) {
                $regno_data = mysqli_fetch_assoc($regno_result);
                $regno = $regno_data['regno'];

                // Mark the registration number as used
                $update_regno_query = "UPDATE valid_regnos SET used=TRUE WHERE regno='$regno'";
                mysqli_query($con, $update_regno_query);

                // Send the registration number to the user's email using PHPMailer
                $mail = new PHPMailer\PHPMailer\PHPMailer();

                try {
                    //Server settings
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.your-email-provider.com'; // Set the SMTP server to send through
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'your-email@example.com';       // SMTP username
                    $mail->Password   = 'your-email-password';         // SMTP password
                    $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
                    $mail->Port       = 587;                            // TCP port to connect to

                    //Recipients
                    $mail->setFrom('your-email@example.com', 'Boxing Registration');
                    $mail->addAddress($email);     // Add a recipient

                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Your Boxing Registration Number';
                    $mail->Body    = "Dear User,<br><br>Your registration number is: <strong>$regno</strong><br><br>Please use this registration number to complete your registration.<br><br>Thank you.";
                    $mail->AltBody = "Dear User,\n\nYour registration number is: $regno\n\nPlease use this registration number to complete your registration.\n\nThank you.";

                    $mail->send();
                    echo "<script>alert('Registration number sent to your email.');</script>";
                } catch (Exception $e) {
                    echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
                }
            } else {
                echo "<script>alert('No available registration numbers. Please contact the administrator.');</script>";
            }
        }
    } else {
        // Get an unused registration number
        $regno_query = "SELECT regno FROM valid_regnos WHERE used=FALSE LIMIT 1";
        $regno_result = mysqli_query($con, $regno_query);

        if (mysqli_num_rows($regno_result) > 0) {
            $regno_data = mysqli_fetch_assoc($regno_result);
            $regno = $regno_data['regno'];

            // Mark the registration number as used
            $update_regno_query = "UPDATE valid_regnos SET used=TRUE WHERE regno='$regno'";
            mysqli_query($con, $update_regno_query);

            // Insert the registration request with initial request_count 1
            $insert_request_query = "INSERT INTO registration_requests (email, regno, request_count) VALUES ('$email', '$regno', 1)";
            mysqli_query($con, $insert_request_query);

            // Send the registration number to the user's email using PHPMailer
            $mail = new PHPMailer\PHPMailer\PHPMailer();

            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.your-email-provider.com'; // Set the SMTP server to send through
                $mail->SMTPAuth   = true;
                $mail->Username   = 'your-email@example.com';       // SMTP username
                $mail->Password   = 'your-email-password';         // SMTP password
                $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
                $mail->Port       = 587;                            // TCP port to connect to

                //Recipients
                $mail->setFrom('your-email@example.com', 'Boxing Registration');
                $mail->addAddress($email);     // Add a recipient

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Your Boxing Registration Number';
                $mail->Body    = "Dear User,<br><br>Your registration number is: <strong>$regno</strong><br><br>Please use this registration number to complete your registration.<br><br>Thank you.";
                $mail->AltBody = "Dear User,\n\nYour registration number is: $regno\n\nPlease use this registration number to complete your registration.\n\nThank you.";

                $mail->send();
                echo "<script>alert('Registration number sent to your email.');</script>";
            } catch (Exception $e) {
                echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
            }
        } else {
            echo "<script>alert('No available registration numbers. Please contact the administrator.');</script>";
        }
    }
}
?>

</body>
</html>
