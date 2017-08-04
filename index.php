<?php
	require_once('test.php');
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<title>Caupo Assignment</title>
</head>
	<body>
	<div class="container">
		<h2>Hej!</h2>
		<form action="welcome.php" method="post">
		Name: <input type="text" name="name"><br>
		E-mail: <input type="text" name="email"><br>
		<input type="submit">
		</form>
	</div>
	</body>
</html>
