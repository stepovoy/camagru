<?php
	require_once('connect.php');
	if ($_POST['submit'] == "OK" && $_POST['submit'] && $_POST['login'] && $_POST['password']) {
		if (!filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) {
	        echo "Please type a valid email!";
	    }
	    else
	    {
			$match = 0;
			$result = $db->query("SELECT uid, email FROM users");
				foreach ($result as $row) {
			        if ($row['email'] == $_POST['login']) {
						echo "User exists already!";
			        	$match = 1;
			        	break;
			        }
			    }
			if (!$match) {
				$db->query("INSERT INTO users (email, password)
				VALUES ('" . $_POST['login'] . "', '" . hash('md5', $_POST['password']) . "')");
				$result = $db->query("SELECT uid FROM users where email='" . $_POST['login'] . "'");
				$row = $result->fetch();
		        if (isset($row['uid']))
		        {
		            $encrypt = md5(149*42+$row['uid']);
		            $to = $_POST['login'];
		            $subject = "New User Validation";
		            $from = 'info@localhost:8080';
		            $body = 'Hi, <br/> <br/>Your uID is ' . $row['uid'] . ' <br><br>Click here to validate your account http://localhost:8080/activate.php?encrypt=' . $encrypt . ' <br/>';
		            $headers = "From: " . strip_tags($from) . "\r\n";
		            $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
		            $headers .= "MIME-Version: 1.0\r\n";
		            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		            mail($to, $subject, $body, $headers);
		        }
	        	header('Location: login.php');
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
    <form action="create.php" method="POST">
        Email: <input type="text" name="login" value="" />
        <br />
        Password: <input pattern=".{8,}" required title="8 characters minimum" type="password" name="password" value="">
        <br />
        <input type="submit" name="submit" value="OK" />
        <br />
    	<a href="login.php">Back to login</a>
    </form>
    </div>
    <?php include "footer.php"; ?>
</body></html>