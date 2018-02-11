<?php
	require_once('admin/phpscripts/config.php');
	//to test if everything is working before adding more code
	// echo $_GET['id'];
	if(isset($_GET['id'])) {
		//get the movie info
		$tbl = "tbl_movies";
		$col = "movies_id";
		$id = $_GET['id'];
		$getMovie = getSingle($tbl, $col, $id);
		}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Details</title>
</head>
<body>
	<?php
			if(!is_string($getMovie)) {
				$row = mysqli_fetch_array($getMovie);
				echo "<img src=\"images/{$row['movies_cover']}\" alt=\"{$row['movies_title']}\">
				<p>{$row['movies_title']}</p>
				<p>{$row['movies_year']}</p>
				<p>{$row['movies_storyline']}</p>
				<a href=\"index.php\">Go Back</a>
				";
			} else {
				echo "<p>{$getMovie}</p>";
			}
	 ?>
</body>
</html>
