<?php
	require_once('connect.php');
	session_start();
	if (isset($_SESSION['logged'])) {
		if (isset($_REQUEST['image'])) {
			$data = $_POST['image'];
			$res = $db->query("SELECT uid FROM users WHERE email='" . $_SESSION['logged'] . "'");
			$get_id = $res->fetch();
			$db->query("INSERT INTO photos (user_id, image) VALUES ('" . $get_id['uid'] . "', '" . $data . "')");
			print "Thank you, your file has been uploaded.";
			// header('Location: edit.php');
		}
		else {
			print "No file added. Try again please";
		}
	}
	else {
		header('Location: login.php');
	}
?>