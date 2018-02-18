<?php
  function createUser($fname, $username, $password, $email, $lvllist) {
    include('connect.php');
    $userstring = "INSERT INTO tbl_user VALUES(NULL, '{$fname}', '{$username}', '{$password}', '{$email}', NULL, 'no', NULL, 0, '{$lvllist}')";
    // echo $userstring;
    $createuser = mysqli_query($link, $userstring);

      if($createuser) {
        $sendMail = submitMsg($fname, $username, $password, $email);
        $_SESSION['message'] = 'User created with success!';
        redirect_to('admin_index.php');
      } else {
        $message = "Failed to add this user.";
        return $message;
      }

    mysqli_close(link);
  }
 ?>
