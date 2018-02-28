<?php
  require_once('phpscripts/config.php');
  // confirm_logged_in();

  $id = $_SESSION['user_id'];
  $tbl = "tbl_user";
  $col = "user_id";
  $popForm = getSingle($tbl, $col, $id);
  // echo $popForm;
  $info = mysqli_fetch_array($popForm);
  // echo $info;

  if(isset($_POST['submit'])){
    $fname = trim($_POST['fname']);
    $username = trim($_POST['username']);
    // $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $result = editUser($id, $fname, $username, $email);
    $message = $result;

  }

 ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/main.css">
<link href="https://fonts.googleapis.com/css?family=Bitter|Nanum+Gothic" rel="stylesheet">
<title>Edit User</title>
</head>
<body>
  <h1 class="hidden">Edit User</h1>
  <div class="container">
    <?php include('../includes/admin-nav.html'); ?>
    <div class="content">
      <h2>Edit User</h2>

        <div class="message">
          <?php if(!empty($message)){ echo '<h3>'.$message.'</h3>';} ?>
        </div>
        <!-- Change the action first thing -->
        <form action="admin_edituser.php" method="post">

          <label for="fname">First Name:</label>
          <input type="text" name="fname" value="<?php echo $info['user_fname'];  ?>">

          <label for="username">Username:</label>
          <input type="text" name="username" value="<?php echo $info['user_name'];  ?>">

          <label for="password">Previous Password:</label>
          <input type="text" name="password" value="">

          <label for="password">New Password:</label>
          <input type="text" name="password" value="">

          <label for="email">Email:</label>
          <input type="email" name="email" value="<?php echo $info['user_email'];  ?>">

          <input type="submit" id="submit" name="submit" value="Save Changes">
        </form>
    </div>

  </div>
</body>
</html>
