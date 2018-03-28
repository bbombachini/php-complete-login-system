<?php
  ini_set('display_errors',1);
  error_reporting(E_ALL);

  function addMovie($cover, $title, $year, $run, $story, $trailer, $release, $genre) {
    include('connect.php');
    if($cover['type'] == 'image/jpg' || $cover['type'] == 'image/jpeg'){
      $targetpath = "../images/{$cover['name']}";

      if(move_uploaded_file($cover['tmp_name'], $targetpath)){
        // echo "File transfer complete";
        $th_copy = "../images/TH_{$cover['name']}";
        if(!copy($targetpath, $th_copy)){
          $message = "Whoops, that didn't work.";
          return $message;
        }
        //Add to database
        $qstring = "INSERT INTO tbl_movies VALUES (NULL, '{$cover['name']}','{$title}', '{$year}', '{$run}', '{$story}', '{$trailer}', '{$release}')";
        echo $qstring;
        $result = mysqli_query($link, $qstring);
        if($result){
          $qstring2 = "SELECT * FROM tbl_movies ORDER BY movies_id DESC LIMIT 1";
          $result2 = mysqli_query($link, $qstring2);
          $row = mysqli_fetch_array($result2);
          $lastId = $row['movies_id'];
          echo $lastId;
          $string3 = "INSERT INTO tbl_mov_genre VALUES(NULL, {$lastId}, {$genre})";
          $result3 = mysqli_query($link, $string3);
        }
        // INSERT INTO tbl_user VALUES(NULL, '{$fname}', '{$username}', '{$pass}', '{$email}', NULL, 'no', NULL, 0, '{$lvllist}', NULL)
        // "UPDATE tbl_movie SET movies_cover = '{$cover}', movies_title = '{$title}', movies_year = '{$year}', movies_runtime = '{$run}', movies_storyline = '{$story}', movies_trailer = '{$trailer}', movies_release = '{$release}', movies_genre = '{$genre}' WHERE movies_id = {$id}";
      }
      // $size = getimagesize($targetpath);
      // echo $size[3];
    } else {
      $message = "File type not allowed.";
      return $message;
    }
    mysqli_close($link);
  }


 ?>
