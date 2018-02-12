<?php
  require_once('phpscripts/config.php');
  confirm_logged_in();

  if($_SESSION['time'] >= 5 && $_SESSION['time'] <= 11 ){
    $greeting = "Have a full mug of coffee before start to work this morning!";
  } else if ($_SESSION['time'] >= 12 && $_SESSION['time'] <= 17) {
    $greeting = "Making small breaks and stretch frequently make you more productive in the afternoon!";
  } else if ($_SESSION['time'] >= 18 && $_SESSION['time'] <= 23) {
    $greeting = "What a long day ahn? Prioritize and finish tomorrow!";
  } else {
    $greeting = "Go home, seriously!";
  }



 ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Welcome to your admin panel login</title>
</head>
<body>
  <h2>You have logged in!</h2>
  <?php echo $greeting; ?>
  <?php echo $_SESSION['user_name']; ?><br>
  <p>Your last login was:</p>
  <?php echo $_SESSION['last_login'] ?>


</body>
</html>
