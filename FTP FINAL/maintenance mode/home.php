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
		<title>Home | Hacker Snacker</title>
		<link rel="icon" href="">
		<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type='text/css'>
		<link href="css.css" type="text/css" rel="stylesheet">
	</head>
	<body>
	<div class="topnav">
		<a href="home.php">
			<img id="logo" src="D:\wamp64\www\VTHacks" alt="LOGO HERE">
		</a>
		<a class="active" href="home.php">Home</a>
		<a href="about.php">About</a>
		<a href="snacks.php">My Snacks</a>
		<a href="account.php">My Account</a>
	</div>
	<table style="width:100%">
		<tr>
			<th colspan="2">
				<div class="header">
				  <div class="container">
					<h1>Hacker Snacker</h1>
					<p>The Healthy Way to Snack</p>
				  </div>
				</div>
			</th>
	<?php
	function test($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	function add_user($user, $userpassword, $email) {
		$servername = "db752522714.db.1and1.com";
		$username = "dbo752522714";
		$password = "yellowwhale";
		$dbname = "db752522714";
		//Create connection_aborted
		$conn = mysqli_connect($servername, $username, $password, $dbname);

		//Check connection_aborted
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		$hashedpswd = hash('sha512', $userpassword);
		$sql = "INSERT INTO users SET
			username = '$user', 
			password = '$hashedpswd',
			email = '$email';";
		if (mysqli_query($conn, $sql) === TRUE) {
			echo "<div class='successca'> Account Created! <br></div>";
		}

		mysqli_close($conn);
	}
	$numerror = 0;
	if(!empty($_POST)) {
		$servername = "db752522714.db.1and1.com";
		$username = "dbo752522714";
		$password = "yellowwhale";
		$dbname = "db752522714";
		//Create connection_aborted
		$conn = mysqli_connect($servername, $username, $password, $dbname);

		//Check connection_aborted
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		$email = test($_POST['email']);
		$username = test($_POST['username']);
		$password = test($_POST['password']);
		$rpass = test($_POST['rpass']);
		
		$sql = "SELECT * FROM users WHERE username = '$username';";
		$result = mysqli_query($conn, $sql);
		echo '<th style="background-color: #7B7B7B"><div class="login">';
		$numerror = -1;
		if ($result == TRUE) {
			if (mysqli_num_rows($result) > 0) {
				echo "<div class='errorca'>An account with that username already exists.<br></div>";
				$numerror = 1;
			}
		}
		$sql = "SELECT * FROM users WHERE email = '$email';";
		$result = mysqli_query($conn, $sql);
		if ($result == TRUE) {
			if (mysqli_num_rows($result) > 0) {
				echo "<div class='errorca'>An account with that email already exists.<br></div>";
				$numerror = 1;
			}
		}
		if ($password !== $rpass) {
			echo "<div class='errorca'>Passwords do not match.<br></div>";
			$numerror = 1;
		}
		
		if (strlen($password) < 6) {
			echo "<div class='errorca'>Password must be at least 6 characters.</div>";
			$numerror = 1;
		}
		
		if ($numerror !== 1) {
			add_user($username, $password, $email);
			$_POST = array();
		}
			
		
		mysqli_close($conn);
	}
	
	
	if((session_id() == '' || !isset($_SESSION)) && $numerror === 0) {
		echo '<th style="background-color: #7B7B7B"><div class="login">';
		echo '<form id="form1" method="POST" autocomplete="off">
									<h2 style="margin-left: 0px; color: #f2f2f2;">Login:</h2>
									Email: <br><input type="email" name="email" required><br><br>
									Username: <br><input type="text" name="username" required><br><br>
									Password: <br><input type="password" name="password" required><br><br>
									Re-enter Password: <br><input type="password" name="rpass" required><br>
									<br>
									<input type="submit" value="Create Account">
									<br>
			</div></th>';
	} else {
		if((session_id() == '' || !isset($_SESSION))) {
			echo '<form id="form1" method="POST" autocomplete="off">
										<h2 style="margin-left: 0px; color: #f2f2f2;">Login:</h2>
										Email: <br><input type="email" name="email" required><br><br>
										Username: <br><input type="text" name="username" required><br><br>
										Password: <br><input type="password" name="password" required><br><br>
										Re-enter Password: <br><input type="password" name="rpass" required><br>
										<br>
										<input type="submit" value="Create Account">
										<br>
				</div></th>';
		}
	}
	?>
	</tr></table>
	</body>
</html>