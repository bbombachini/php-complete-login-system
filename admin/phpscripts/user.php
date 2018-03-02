<?php
  function createUser($fname, $username, $email, $lvllist) {
    include('connect.php');
    $password = random_str();
    $pass = encryptPass($password);
    $userstring = "INSERT INTO tbl_user VALUES(NULL, '{$fname}', '{$username}', '{$pass}', '{$email}', NULL, 'no', NULL, 0, '{$lvllist}', NULL)";
    // echo $userstring;
    $createuser = mysqli_query($link, $userstring);

      if($createuser) {
        $sendMail = submitMsg($fname, $username, $password, $email);
        // echo $password;
        $message = "User created with success!";
        return $message;
      } else {
        $message = "Failed to add this user.";
        return $message;
      }
    mysqli_close(link);
  }

    //function to generate random int password
    function random_str()
   {
      $length = 26;
      $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $str = '';
      $max = mb_strlen($keyspace, '8bit') - 1;
      if ($max < 1) {
          throw new Exception('$keyspace must be at least two characters long');
      }
      for ($i = 0; $i < $length; ++$i) {
          $str .= $keyspace[random_int(0, $max)];
      }
      return $str;
  }

  function encryptPass($pass) {
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    return $hash;
  }

  function checkPass($pass, $hash){
    if(password_verify($pass, $hash)) {
      $verified = true;
    } else {
      $verified = false;
    }
    return $verified;
  }

  function editUser($id, $fname, $username, $email) {
    include('connect.php');

    $updatestring = "UPDATE tbl_user SET user_fname = '{$fname}',  user_name = '{$username}', user_email = '{$email}' WHERE user_id = {$id}";
    // echo $updatestring;
    $edituser = mysqli_query($link, $updatestring);
    if($edituser) {
      redirect_to("admin_index.php");
    } else {
      $message = "Failed to update.";
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
        date_default_timezone_set('America/Toronto');
        $createdUser = $founduser['user_date'];
      //Function to get the difference between the moment the user is created and the current moment
        $diff  = date_diff( date_create($createdUser), date_create());
      //To test, store the difference in minutes into a variable and set a limit in minutes;
        $lag = $diff->i;
        $limit = 3;
      //Before check the password given, check if it's the first login and the user exceeded the time limit.
        if($founduser['last_login'] == null && $lag > $limit){
          $message = "Your password has expired! Contact your administrator.";
          return $message;
        } else {
          $verified = checkPass($password, $hash);
        }

        if($verified){
            $newPass = encryptPass($newPassword);
          //Decided to create a column inside user's table to store last timestamp of the last password update
          //For future track of password change or implement temporary password change.
            $updatePass = "UPDATE tbl_user SET user_pass= '{$newPass}', user_ip= '{$ip}', last_pass_change = NOW() WHERE user_id={$id}";
          // echo $updatePass;
            $updatePassQuery = mysqli_query($link, $updatePass);

            redirect_to("admin_login.php");
          }
          else {
            var_dump($lag);
            $message = "Ops, something wrong. Try again!";
            return $message;
          }
      } else {
        $message = "Seems that there's something wrong. Try again!";
        return $message;
      }
      mysqli_close($link);
    }

  function deleteUser($id){
    include('connect.php');
    $delstring = "DELETE FROM tbl_user WHERE user_id = {$id}";
    $delquery = mysqli_query($link, $delstring);
    if($delquery){
      redirect_to("../admin_index.php");
    } else {
      $message = "An error ocurred while deleting this user. Try again.";
    }
    mysqli_close($link);
  }

 ?>
