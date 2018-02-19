<?php
  require_once('phpscripts/config.php');

  $ip = $_SERVER['REMOTE_ADDR'];
  if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $newPassword = trim($_POST['newPassword']);
    if($username !== "" && $password !== "" && $newPassword !== "") {
      $result = updatePassword($username, $password, $newPassword, $ip);
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
 <title>Welcome to your new account</title>
 </head>
 <body>

   <h1 class="hidden">Welcome Panel</h1>
   <div class="container">
     <?php include('../includes/admin-nav.html'); ?>
     <div class="content">
       <h2>Hello New User!</h2>
       <div class="greeting">
         <?php if(isset($_GET['name'])) {
           $name = $_GET['name'];
           echo '<h4>Welcome, '.$name."!</h4>"; } ?>

         <h3>Please insert your credentials to update your password:</h3>
           <?php if(!empty($message)){ echo $message;} ?>

         <form action="admin_updatepassword.php" method="post">
             <label>Username:</label>
             <input type="text" name="username" value="">
             <br>
             <label>Given password:</label>
             <input type="password" name="password" value="">
             <br><br>
             <label>New password:</label>
             <input type="password" name="newPassword" value="">

             <input type="submit" id="submit" name="submit" value="UPDATE">
         </form>

       </div>




     </div>


   </div>
 </body>
 </html>
