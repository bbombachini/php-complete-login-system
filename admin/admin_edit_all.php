<?php
  require_once('phpscripts/config.php');

 ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/main.css">
<link href="https://fonts.googleapis.com/css?family=Bitter|Nanum+Gothic" rel="stylesheet">
<title>Edit Info</title>
</head>
  <body>
    <?php
      $tbl = "tbl_movies";
      $col = "movies_id";
      $id = 2;
      echo single_edit($tbl, $col, $id);
     ?>

  </body>
</html>
