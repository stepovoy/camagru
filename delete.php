<?php
// Delete your photo
	require_once('connect.php');
	if (isset($_GET['id']) && isset($_SESSION['logged'])) {
		$res = $db->query("SELECT uid FROM users WHERE email='" . $_SESSION['logged'] . "'");
		$get_id = $res->fetch();
		$db->query("DELETE FROM photos WHERE pid=" . $_GET['id'] . " AND user_id=" . $get_id['uid']);
    }
    header('Location: edit.php');
?>