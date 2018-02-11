<?php
  require_once('phpscripts/config.php');
  confirm_logged_in();


 ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Welcome to your admin panel login</title>
</head>
<body>
  <h2>You have logged in!</h2>
  <?php echo $_SESSION['user_name']; ?>
</body>
</html>
