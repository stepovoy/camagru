<?php
// Forgot password? Email reset link.
	require_once('connect.php');
	if ($_SESSION['logged']) {
        header('Location: index.php');
    }


if (isset($_POST['email']) && isset($_POST['email']) && $_POST['submit'] == "OK") {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please type a valid email!";
    }
    else
    {
        $result = $db->query("SELECT uid FROM users where email='" . $email . "'");
        $row = $result->fetch();
        if (isset($row['uid']))
        {
            $encrypt = md5(199*42+$row['uid']);
            echo "Your password reset link was sent to your e-mail.";
            $to = $email;
            $subject = "Forgotten Password";
            $from = 'info@localhost:8080';
            $body = 'Hi, <br/> <br/>Your uID is ' . $row['uid'] . ' <br><br>Click here to reset your password http://localhost:8080/reset.php?encrypt=' . $encrypt . ' <br/>';
            $headers = "From: " . strip_tags($from) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            mail($to, $subject, $body, $headers);
        }
        else
        {
            echo "Account not found!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
    <?php include "header.php"; ?>
    <div id="section">
    <form action="forgot.php" method="POST">
        Email: <input type="text" name="email" value="" />
        <br />
        <input type="submit" name="submit" value="OK" />
        <br />
    	<a href="login.php">Back to login</a>
    </form>
    </div>
    <?php include "footer.php"; ?>
</body></html>