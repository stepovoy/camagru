<?php
	require_once('connect.php');
	if ($_SESSION['logged']) {
		// A main section containing the preview of the user’s webcam, the list of superposable images and a button allowing to capture a picture.
		?>
<!DOCTYPE html>
<html>
<head>
	<title>Camera</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="js/edit.js"></script>
</head>
<body>
	<?php include "header.php"; ?>
    <div id="section">
	<div class="main">
	  <video id="video" width="640" height="480" autoplay></video><br/>
	  <img id="frame" src="img/frame1.png" />
	<div clas="buttons">
	<button id="snap">Snap Photo</button><br/>
	&nbsp; &nbsp; &nbsp; OR<br/>
	<input id="upload" type="file" accept="image/*"><br/>
	<canvas id="canvas" width="640" height="480"></canvas>
	</div>
	</div>
	<div class="sidebar">
		<div id="hats">
			<img id="hat1" src="img/hat1.png" width="100" height="100" />
			<img id="hat2" src="img/hat2.png" width="100" height="100" />
			<img id="hat3" src="img/hat3.png" width="100" height="100" />
		</div>
	<?php
		// A side section displaying thumbnails of all previous pictures taken. (only user's)
		$res = $db->query("SELECT uid FROM users WHERE email='" . $_SESSION['logged'] . "'");
		$get_id = $res->fetch();
		$result = $db->query("SELECT * FROM photos WHERE user_id=" . $get_id['uid'] . " ORDER BY pid DESC");
		foreach ($result as $row) {
			// get each image from photos blob (table: image)
		    echo '<div><strong>Image #' . $row['pid'] . '</strong></div><div><img src="'. $row['image'] . '" width="200" height="150"><br/><a href="delete.php?id=' . $row['pid'] . '">Delete photo</a></div>';
			// The user should be able to delete his edited images, but only his, not other users’ creations. (delete.php)
		}
	}
	else {
		header('Location: login.php');
	}
	?>
</div>
</div>
</body>
</html>