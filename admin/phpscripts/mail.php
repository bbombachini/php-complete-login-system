<?php

  function redirect_to($location){
    if($location != NULL){
      header("Location: {$location}");
      exit;
    }
  }

  function submitMsg($fname, $username, $password, $email) {
    $to = $email;
    $msg =  "Hello ".$fname.",\n\nYour account has been created.\n\nYour username is:".$username.".\n\nClick on the link bellow to be redirected to our page and change your password.\n\n";
    $extra = "Reply-To: donotreply@email.com";
    $url = "https://github.com/bbombachini/Bombachini_B_3014_r2/admin/admin_login.php";
    // mail($to,$msg,$url,$extra);
  }


 ?>
