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
<link rel="stylesheet" href="css/main.css">
<link href="https://fonts.googleapis.com/css?family=Bitter|Nanum+Gothic" rel="stylesheet">
<title>Welcome to your admin panel login</title>
</head>
<body>

  <h1 class="hidden">Login Panel</h1>
  <div class="container">
    <?php include('../includes/admin-nav.html'); ?>
      <div class="content">
        <h2>You have logged in!</h2>
          <div class="greeting">
            <?php echo '<h3>'.$greeting.'</h3>'; ?>
            <?php echo '<h4>Welcome, '.$_SESSION['user_name'].'</h4>'; ?><br>
            <?php echo '<h4>'.$_SESSION['last_login'].'</h4>'; ?>
            <?php if(!empty($_GET['message'])) {
                  $message = $_GET['message'];
                  echo '<div><h3>'.$message.'</h3></div>'; } ?>
            <div class="links">
              <a href="admin_createuser.php"><h5>Create User</h5></a>
              <a href="phpscripts/caller.php?caller_id=logout"><h5>Sign Out</h5></a>
            </div>
          </div>
      </div>
  </div>

</body>
</html>
