<?php


  function submitMsg($fname, $username, $password, $email) {
    $to = $email;
    $msg =  "Hello ".$fname.",\n\nYour account has been created.\n\nYour username is: ".$username.".\n\nYour temporary password is: ".$password."\n\nClick on the link bellow to be redirected to our page and change your password.\n\n";
    $extra = "Reply-To: donotreply@email.com";
    $url = "https://github.com/bbombachini/Bombachini_B_3014_r2/admin/admin_updatepassword.php/?name=".$fname;
    // mail($to,$msg,$url,$extra);
  }


 ?>
