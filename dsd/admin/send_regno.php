<?php
if (isset($_POST['submit'])) {
    include('../dbcon.php');
    include('PHPMailer/PHPMailerAutoload.php');

    $email = mysqli_real_escape_string($con, $_POST['email']);

    // Generate a unique registration number
    $regno = uniqid('REG-', true);

    // Insert the registration number into valid_regnos table with email
    $qry = "INSERT INTO valid_regnos (regno, email) VALUES ('$regno', '$email')";
    $run = mysqli_query($con, $qry);

    if ($run) {
        // Send email to the user with the registration number
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@example.com';
        $mail->Password = 'your-email-password';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('your-email@example.com', 'Boxing Registration System');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Your Registration Number';
        $mail->Body    = 'Your registration number is: ' . $regno;

        if ($mail->send()) {
            echo "<script>
                alert('Registration number sent to your email.');
                window.location.href = 'addstudent.php?regno=$regno&email=$email';
            </script>";
        } else {
            echo "<script>
                alert('Failed to send registration number.');
                window.location.href = 'request_regno.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Failed to generate registration number: " . mysqli_error($con) . "');
            window.location.href = 'request_regno.php';
        </script>";
    }
}
?>
