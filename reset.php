<?php
// Forgot password? Email reset link.
    require_once('connect.php');
    if ($_SESSION['logged']) {
        header('Location: index.php');
    }

if (isset($_REQUEST['encrypt']))
{
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
        $encrypt = $_REQUEST['encrypt'];
        $result = $db->query("SELECT uid FROM users WHERE md5(199*42+uid)='" . $encrypt . "'");
        $row = $result->fetch();
        if (isset($row['uid']))
        {
            $db->query("UPDATE users SET password='" . hash('md5', $password) . "' WHERE uid=" . $row['uid']);
            echo 'Your password changed sucessfully <a href="login.php">Click here to login</a>.';
        }
        else
        {
            echo 'Invalid key, please try again. <a href="forgot.php">Forgot Password?</a>';
        }
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
        New password: <input pattern=".{8,}" required title="8 characters minimum" type="password" name="password" value="">
        <br />
        Reset key: <input type="text" name="encrypt" value="<?php echo $_REQUEST['encrypt']; ?>" />
        <br /> 
        <input type="submit" name="submit" value="OK" />
        <br />
        <a href="login.php">Back to login</a>
    </form>
    </div>
    <?php include "footer.php"; ?>
</body></html>