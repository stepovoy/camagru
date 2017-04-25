<?php
	require_once('auth.php');
	session_start();
    if ($_SESSION['logged']) {
        header('Location: index.php');
    }
	if ($_POST['login'] && $_POST['passwd'] && auth($_POST['login'], $_POST['passwd'])) {
		$_SESSION['logged'] = $_POST['login'];
        header('Location: index.php');
	}
    else if ($_POST['login'] && $_POST['passwd']) {
        echo "Login error\n";
        $_SESSION['logged'] = "";
    }
	else {
		$_SESSION['logged'] = "";
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
    <form action="login.php" method="POST">
        Login: <input type="text" name="login" value="" />
        <br/>
        Password: <input type="password" name="passwd" value="" />
        <br/>
        <input type="submit" name="submit" value="OK" />
    </form>
    <a href="create.php">Create an account</a>
    <br />
    <a href="forgot.php">Forgot your password?</a>
    <br />
    <a href="index.php">Back to homepage</a>
    </div>
    <?php include "footer.php"; ?>
</body></html>