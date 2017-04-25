<?php
// Forgot password? Email reset link.
    require_once('connect.php');
    if ($_SESSION['logged']) {
        header('Location: index.php');
    }

if (isset($_REQUEST['encrypt'])) {
    $encrypt = $_REQUEST['encrypt'];
    $result = $db->query("SELECT * FROM users WHERE md5(149*42+uid)='" . $encrypt . "'");
    $row = $result->fetch();
    if (isset($row['uid']))
    {
        $db->query("UPDATE users SET active=1 WHERE uid=" . $row['uid']);
        echo 'Your account was activated sucessfully <a href="login.php">Click here to login</a>.';
    }
    else
    {
        echo 'Invalid key, please try again.';
    }
}
else
{
    header("Location: login.php");
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
    <form action="reset.php" method="POST">
        Activation key: <input type="text" name="encrypt" value="<?php echo $_REQUEST['encrypt']; ?>" />
        <br /> 
        <input type="submit" name="submit" value="OK" />
        <br />
        <a href="login.php">Back to login</a>
    </form>
    </div>
    <?php include "footer.php"; ?>
</body></html>