<?php
	function auth($login, $passwd) {
        require_once('connect.php');
        if (!$login || !$passwd)
	            return false;
		$result = $db->query("SELECT * FROM `users` WHERE `email` = '$login'");
		foreach($result as $row) {
			if ($row['password'] == hash('md5', $passwd) && $row['active']) {
                return true;
			}
		}
		return false;
	}
?>