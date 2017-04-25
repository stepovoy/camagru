<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="js/index.js"></script>
</head>
<body>
<?php
	require_once('connect.php');
    include "header.php";
    echo '<div id="section">';
    echo '<center><h1><a href="edit.php">Go creating now!</a></h1></center><br/>';
	$result = $db->query("SELECT * FROM photos ORDER BY pid DESC");
	$i = 0;
	$page = 1;
	echo '<div id="Page' . $page . '" class="page" style="">';
		foreach ($result as $row) {
		    echo "<div id=\"image\"><div><strong>Image #" . $row['pid'] . "</strong></div><div>" .
		    '<img src="' . $row['image'] . '" width="200" height="150">' . "</div>" . 
		    '<div>Likes: ' . $row['likes'] . ' <a href="like.php?id=' . $row['pid'] . '">Like it!</a></div><div>';
		    $comments = $db->query("SELECT * FROM comments WHERE photo_id=" . $row['pid']);
		    foreach ($comments as $comment) {
		    	$user = $db->query("SELECT users.email FROM users INNER JOIN comments ON users.uid = comments.user_id WHERE users.uid=" . $comment['user_id']);
		    	$commentator = $user->fetch();
		    	echo 'From: <strong>' . $commentator['email'] . '</strong><br/><div>' . $comment['comment'] . '</div><br/>';
		    }
		    echo '</div><form action="comment.php?id=' . $row['pid'] . '" method="post"><textarea rows="3" cols="30" name="text"></textarea><br/><button type="submit">Send comment</button></form></div>';
		    $i++;
		    if ($i == 8) {
		    	$page++;
		    	echo '</div><div id="Page' . $page . '" class="page" style="display:none">';
		    	$i = 0;
		    }
		}
	if ($i == 0) {
		$page--;
	}
	echo '</div><p>Choose page ';
	for ($i = 1; $i <= $page; $i++) {
		echo "<span onclick=\"show('Page" . $i . "');\">" . $i . "</span> ";
	}
	echo '</p></div>';
//	On receiving a comment on user’s image, send notification on email.
//	The list of images must be presented in successive pages (i.e. X images by page).
    include "footer.php";
?>
</body>
</html>