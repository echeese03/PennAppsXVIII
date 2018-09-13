<?php
session_start();
header('Location: under_maintenance/maintenance.html'); //TAKE THIS OUT
if (array_key_exists('logstate', $_SESSION)) {
		if(!$_SESSION['logstate']) {
			session_unset();
			session_destroy();
		}
} else {
	session_unset();
	session_destroy();
}
?>
<html>
	<head>	
		<meta charset="utf-8">
		<title>Snacks | Hacker Snacker</title>
		<link rel="icon" href="">
		<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type='text/css'>
		<link href="css.css" type="text/css" rel="stylesheet">
	</head>
	<body>
	<div class="topnav">
		<a href="home.php">
			<img id="logo" src="D:\wamp64\www\VTHacks" alt="LOGO HERE">
		</a>
		<a href="home.php">Home</a>
		<a href="about.php">About</a>
		<a class="active" href="snacks.php">My Snacks</a>
		<a href="account.php">My Account</a>
	</div>
	</body>
	<?php
	if(session_status() == 2) {
		echo '<h2 style="margin-top: 10px; text-align: center; font-size: 60px;">My Snacks</h2>
		<table style="width: 100%">
			<tr>
				<th colspan="2">
					<h2>Snack 1</h2>
				</th>
				<th colspan="2">
					<h2>Snack 2</h2>
				</th>
				<th colspan="2">
					<h2>Snack 3</h2>
				</th>
			</tr>
			<tr>
				<th colspan="2">
					<div class="container1"><img src="https://www.fritolay.com/images/default-source/blue-bag-image/doritos-nacho-cheese.png?sfvrsn=b64e563a_2" alt="Snack 1"></div>
				</th>
				<th colspan="2">
					<div class="container1"><img src="https://www.fritolay.com/images/default-source/blue-bag-image/doritos-nacho-cheese.png?sfvrsn=b64e563a_2" alt="Snack 2"></div>
				</th>
				<th colspan="2">
					<div class="container1"><img src="https://www.fritolay.com/images/default-source/blue-bag-image/doritos-nacho-cheese.png?sfvrsn=b64e563a_2" alt="Snack 3"></div>
				</th>';
		
	} else {
		echo "<div class='error'>You need to <a class ='error' href='account.php'>login</a> first!<br></div>";
	}
	?>
</html>