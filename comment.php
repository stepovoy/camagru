<?php
	require_once('connect.php');
	if (isset($_REQUEST['id']) && $_SESSION['logged']) {
		$res = $db->query("SELECT uid FROM users WHERE email='" . $_SESSION['logged'] . "'");
		$get_id = $res->fetch();
		$db->query("INSERT INTO comments (user_id, photo_id, comment) VALUES ('" . $get_id['uid'] . "', '" . $_REQUEST['id'] ."', '" . $_REQUEST['text'] . "')");		
	//	On receiving a comment on user’s image, send notification on email.
		$result = $db->query("SELECT email FROM `users`
		INNER JOIN photos ON users.uid = photos.user_id
		WHERE photos.pid = " . $_REQUEST['id']);
		$data = $result->fetch();
		$to = $data['email'];;
        $subject = "New Comment On Your Image";
        $from = 'info@localhost:8080';
        $body = 'Hi, <br/> You have recieved a new comment on your image #' . $_REQUEST['id'] . '<br/> from: ' . $_SESSION['logged'] . '<br/>Here is comment:<br/>' . $_REQUEST['text'];
        $headers = "From: " . strip_tags($from) . "\r\n";
        $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        mail($to, $subject, $body, $headers);
	}
	header('Location: index.php');
?>