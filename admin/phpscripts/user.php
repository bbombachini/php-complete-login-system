<?php
  function createUser($fname, $username, $email, $lvllist) {
    include('connect.php');
    $password = random_str();
    $pass = encryptPass($password);
    $userstring = "INSERT INTO tbl_user VALUES(NULL, '{$fname}', '{$username}', '{$pass}', '{$email}', NULL, 'no', NULL, 0, '{$lvllist}')";
    // echo $userstring;
    $createuser = mysqli_query($link, $userstring);

      if($createuser) {
        $sendMail = submitMsg($fname, $username, $password, $email);
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
