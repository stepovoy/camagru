<?php
	require_once('connect.php');
	if (isset($_GET['id']) && $_SESSION['logged']) {
		$db->query("UPDATE photos SET likes = likes + 1 WHERE pid=" . $_GET['id']);
	}
	header('Location: index.php');
?>