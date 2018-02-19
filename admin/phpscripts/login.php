<?php
  function logIn($username, $password, $ip) {
    require_once('connect.php');
    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);

    $queryUser = "SELECT * FROM tbl_user WHERE user_name='{$username}'";
    $checkUser = mysqli_query($link, $queryUser);

    //Check if user exists before match with password
    if(mysqli_num_rows($checkUser)){
      $founduser = mysqli_fetch_array($checkUser, MYSQLI_ASSOC);
      $id = $founduser['user_id'];
      // Before allow user in, check if it's blocked
      if($founduser['user_attempts'] < 3){
        // As user exists, check if password match
        $verified = checkPass($password, $founduser['user_pass']);
        if($verified){
              // Necessary to set timezone otherwise would print the server time
              date_default_timezone_set('America/Toronto');
              $_SESSION['user_id'] = $id;
              $_SESSION['user_name'] = $founduser['user_fname'];
              $_SESSION['time'] = date("H");

              //Check the last login or if it's the first login
              if(!is_null($founduser['last_login'])){
                $_SESSION['last_login'] = "Your last login was on ".$founduser['last_login'];
              } else {
                $_SESSION['last_login'] = "This is your first Login!";
              }

              //Update IP on db
              $update = "UPDATE tbl_user SET user_ip='{$ip}' WHERE user_id={$id}";
              $updatequery = mysqli_query($link, $update);

              //Update to reset user attempt
              $resetAttempt = "UPDATE tbl_user SET user_attempts = 0 WHERE user_id={$id}";
              $attemptQuery = mysqli_query($link, $resetAttempt);

              //Update login on db
              $updateLogin = "UPDATE tbl_user SET last_login= NOW() WHERE user_id={$id}";
              $updateLoginQuery = mysqli_query($link, $updateLogin);

              redirect_to("admin_index.php");
            }
          //If user is not blocked, increment user attempts column
          $updateAttempt = "UPDATE tbl_user SET user_attempts = user_attempts + 1 WHERE user_id={$id}";
          $incrementQuery = mysqli_query($link, $updateAttempt);
        }//Check if user attempt is bigger than 3
        else if ($founduser['user_attempts'] == 3) {

            $message = "Your account has been blocked! Please contact your administrator.";
            return $message;
        }
        $message = "Please be minded that after 3 attempts, your user will be blocked";
        return $message;
      }
      //As user is not found, return an error message
      else {
        $message = "Seems that there's something wrong. Try again!";
        return $message;
      }


    mysqli_close($link);
  }


  function updatePassword($username, $password, $newPassword, $ip) {
    require_once('connect.php');
    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);
    $newPassword = mysqli_real_escape_string($link, $newPassword);

    $user = "SELECT * FROM tbl_user WHERE user_name='{$username}'";
    $userQuery = mysqli_query($link, $user);

    //Check if user exists before match with password
    if(mysqli_num_rows($userQuery)){
      $founduser = mysqli_fetch_array($userQuery, MYSQLI_ASSOC);
      $id = $founduser['user_id'];
      $hash = $founduser['user_pass'];
      $verified = checkPass($password, $hash);

      if($verified){
          $newPass = encryptPass($newPassword);
          $updatePass = "UPDATE tbl_user SET user_pass='{$newPass}' WHERE user_id={$id}";
          $updatePassQuery = mysqli_query($link, $updatePass);

          $update = "UPDATE tbl_user SET user_ip='{$ip}' WHERE user_id={$id}";
          $updatequery = mysqli_query($link, $update);
          redirect_to("admin_index.php");
        }
        else {
          $message = "Ops, something wrong. Try again!";
          return $message;
        }
    } else {
      $message = "Seems that there's something wrong. Try again!";
      return $message;
    }

    mysqli_close($link);
  }

 ?>
