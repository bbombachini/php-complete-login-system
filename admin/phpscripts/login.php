<?php
  function logIn($username, $password, $ip) {
    require_once('connect.php');
    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);
    $loginstring = "SELECT * FROM tbl_user WHERE user_name='{$username}' AND user_pass='{$password}'";
    // echo $loginstring;
    $user_set = mysqli_query($link, $loginstring);
    // echo mysqli_num_rows($user_set);
    if(mysqli_num_rows($user_set)) {
      $founduser = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
      $id = $founduser['user_id'];
      // echo $id;
      // Necessary to set timezone otherwise would print the server time
      date_default_timezone_set('America/Toronto');
      $_SESSION['user_id'] = $id;
      $_SESSION['user_name'] = $founduser['user_fname'];
      $_SESSION['time'] = date("H");
      if(!is_null($founduser['last_login'])){
        $_SESSION['last_login'] = "Your last login was on ".$founduser['last_login'];
      } else {
        $_SESSION['last_login'] = "Welcome, this is your first Login!";
      }


      if(mysqli_query($link, $loginstring)){
        //Update IP on db
        $update = "UPDATE tbl_user SET user_ip='{$ip}' WHERE user_id={$id}";
        $updatequery = mysqli_query($link, $update);

        //Update login on db
        $updateLogin = "UPDATE tbl_user SET last_login= NOW() WHERE user_id={$id}";
        $updateLoginQuery = mysqli_query($link, $updateLogin);

      }
      redirect_to("admin_index.php");
    } else {

      $insertLog = "INSERT INTO tbl_login_attempts (login_attempts, user_ip) VALUES (1, '$ip')";
      $insertQuery = mysqli_query($link, $insertLog);
      $message = "Seems that there's something wrong. You have more 2 attempts. Try again!";
      return $message;
    }


    mysqli_close($link);
  }



 ?>
