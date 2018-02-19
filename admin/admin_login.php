<?php
  require_once('phpscripts/config.php');
  $ip = $_SERVER['REMOTE_ADDR'];
  // echo $ip;
  if(isset($_POST['submit'])){
    // echo "works";
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if($username !== "" && $password !== "") {
      $result = logIn($username, $password, $ip);
      $message = $result;
    } else {
      $message = "Please fill out the required fields.";
    }
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
        <h1 class="hidden">Content</h1>
        <h2>Welcome, log in to get started!</h2>

          <div class="message">
            <?php if(!empty($message)){
              echo '<h3>'.$message.'</h3>';
            } ?>
          </div>

          <form action="admin_login.php" method="post">
            <label>Username:</label>
            <input type="text" name="username" value="">
            <br>
            <label>Password:</label>
            <input type="password" name="password" value="">
            <br><br>
            <input type="submit" id="submit" name="submit" value="LOGIN">

          </form>
        </div>
    </div>

  </body>
</html>
