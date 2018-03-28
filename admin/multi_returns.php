<?php
  require_once('phpscripts/config.php');
  $result = multiReturns(17);
  list($add, $multiply) = multiReturns(237);

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
    <?php
      echo "Result 1: {$result[0]}</br>";
      echo "Result 2: {$result[1]}</br></br>";
      echo "Result 1 from list: {$add}</br>";
      echo "Result 2 from list: {$multiply}</br>";
     ?>

  </body>
</html>
