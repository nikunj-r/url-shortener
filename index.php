<?php
include_once "connection.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>URL Shortener</title>
</head>
<body>
	<link rel="stylesheet" type="text/css" href="style.css">
	<b><h1>Shorten Your URL</h1></b>

	<form method="POST" action="">
		<input class="inp" type="text" name="url_to_short" placeholder="Enter a link to shorten it." required><br><br>
		<div class="btn_div"><input class="btn" type="submit" name="shorten" value="Make It Short"></div>
	</form>

<?php

	if(isset($_POST['shorten']))
	{
			
			// Generate key
			function generateRandomString($length = 5)
			{
				$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
				$charactersLength = strlen($characters);

				$randomString = "";
				for($i=0;$i<$length;$i++)
				{
					$randomString .= $characters[rand(0, $charactersLength - 1)];
				}

				return $randomString;	
			}

			// Generate a Random String
			$key = generateRandomString();


			// Append http:// if not present
			if(substr($_POST['url_to_short'], 0 , 7) != "http://" AND substr($_POST['url_to_short'], 0 , 8) != "https://")
			{ 
				$url = "http://" . $_POST['url_to_short'];
			}
			else
			{
				$url = $_POST['url_to_short'];
			}

			// Insert into the Database
			$query = "INSERT INTO `links`(`url`, `alias`) VALUES ('$url','$key')";
			$result = mysqli_query($connection,$query);

			// Fetch from the Database
			$query = "SELECT url FROM `links` WHERE alias='" .$key. "' ";
			$result = mysqli_query($connection,$query);
			$smallURL = mysqli_fetch_array($result);
			$link = "http://small/" . $key;

?>
			<br>
			<h3><b>Your URL is : <a href="<?php echo $smallURL[0];?>"><?php echo $link;?></a></b></h3>

<?php } ?>

</body>
</html>
