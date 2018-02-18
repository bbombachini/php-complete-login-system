<?php
  require_once('phpscripts/config.php');
  confirm_logged_in();

  if(isset($_POST['submit'])){
    $fname = trim($_POST['fname']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $lvllist = $_POST['lvllist'];
    if(empty($lvllist)){
      $message = "Please select a user level.";
    } else {
      $result = createUser($fname, $username, $password, $email, $lvllist);
      $message = $result;
    }
  }


 ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/main.css">
<link href="https://fonts.googleapis.com/css?family=Bitter|Nanum+Gothic" rel="stylesheet">
<title>Create User</title>
</head>
<body>
  <h1 class="hidden">Users Panel</h1>
  <div class="container">
    <?php include('../includes/admin-nav.html'); ?>
    <div class="content">
      <h2>Create User</h2>
      <?php if(!empty($message)){ echo $message;} ?>
      <form action="admin_createuser.php" method="post">
        <label for="fname">First Name:</label>
        <input type="text" name="fname" value="">

        <label for="username">Username:</label>
        <input type="text" name="username" value="">

        <label for="password">Password:</label>
        <input type="text" name="password" value="">

        <label for="email">Email:</label>
        <input type="email" name="email" value="">

        <select name="lvllist">
          <option value="">Select User Level</option>
          <option value="2">Web Admin</option>
          <option value="1">Web Master</option>
        </select>

        <input type="submit" name="submit" value="Create User">
      </form>
    </div>

  </div>
</body>
</html>
