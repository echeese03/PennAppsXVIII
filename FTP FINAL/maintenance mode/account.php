<?php
session_start();
header('Location: under_maintenance/maintenance.html'); //TAKE THIS OUT
?>
<html>
	<head>	
		<meta charset="utf-8">
		<title>My Account | Hacker Snacker</title>
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
		<a href="snacks.php">My Snacks</a>
		<a class="active" href="account.php">My Account</a>
	</div>
	</body>
	<?php
	function test($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	if (array_key_exists('logstate', $_SESSION)) {
		if($_SESSION['logstate']) {
			echo '<h2>My Account</h2>';
			echo '<h3>Allergies:</h3>';
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
			$username = $_SESSION['username'];
			if (array_key_exists('allergy', $_POST) && array_key_exists('rallergy', $_POST)) {
				$allergy = $_POST['allergy'];
				$allergy = ucfirst(trim($allergy));
				unset($_POST['allergy']);
				$rallergy = $_POST['rallergy'];
				$rallergy = ucfirst(trim($rallergy));
				unset($_POST['rallergy']);
				if (empty($allergy) && empty($rallergy)) {
					echo "<div class='error'>Please enter an allergy</div>";
				} else{
					if (empty($rallergy)) {
						$sql = "SELECT * FROM allergies WHERE username = '$username' AND allergy = '$allergy';";
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) > 0) {
							echo "<div class='error'>You already listed this allergy!</div>";
						} else {
							$sql = "INSERT INTO allergies (username, allergy) VALUES ('$username', '$allergy');";
							$result = mysqli_query($conn, $sql);
						}
					} else if (empty($allergy)) {
						$sql = "SELECT * FROM allergies WHERE username = '$username' AND allergy = '$rallergy';";
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) > 0) {
							$sql = "DELETE FROM allergies WHERE allergy = '$rallergy';";
							$result = mysqli_query($conn, $sql);
						} else {
							echo "<div class='error'>This allergy is not listed.</div>";
						}
					} else {
						$sql = "SELECT * FROM allergies WHERE username = '$username' AND allergy = '$allergy';";
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) > 0) {
							echo "<div class='error'>You already listed this allergy!</div>";
						} else {
							$sql = "INSERT INTO allergies (username, allergy) VALUES ('$username', '$allergy');";
							$result = mysqli_query($conn, $sql);
						}
						$sql = "SELECT * FROM allergies WHERE username = '$username' AND allergy = '$rallergy';";
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) > 0) {
							$sql = "DELETE FROM allergies WHERE allergy = '$rallergy';";
							$result = mysqli_query($conn, $sql);
						} else {
							echo "<div class='error'>This allergy is not listed.</div>";
						}
					}
				}
			}			
			$sql = "SELECT * FROM allergies WHERE username = '$username';";
			$result = mysqli_query($conn, $sql);
			echo "<ul>";
			if ($result == TRUE) {
				if (mysqli_num_rows($result) > 0) {
					for ($x = 1; $x <= mysqli_num_rows($result); $x++) {
						$y = mysqli_fetch_assoc($result);
						$z = $y['allergy'];
						$z = ucfirst($z);
						echo "<li>$z</li>";
					}
				}
			}
			echo "</ul>";
			echo '<div class="login">
						<form method="POST">
							Add Allergy: <br><input type="text" name="allergy"><br>
							Remove Allergy: <br><input type="text" name="rallergy"><br><br>
							<input type="submit" value="Add/Remove">
							<br>
					</div>';
			echo '<a href="logout.php"><button class="logbutton" type="button">Log Out</button></a>';
		} else {
			session_unset();
			session_destroy();
			echo "<div class='error'>You have been logged out.<br></div>";
		}
	} else {
		session_unset();
		session_destroy();
		if(array_key_exists('username', $_POST)) {
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
			
			$username = test($_POST['username']);
			$password = test($_POST['password']);
			$hashedpass = hash('sha512', $password);
			$sql = "SELECT * FROM users WHERE username = '$username';";
			$result = mysqli_query($conn, $sql);
			if ($result == TRUE) {
				if (mysqli_num_rows($result) > 0) {
					$temparray = mysqli_fetch_assoc($result);
					$dbpass = $temparray['password'];
					if ($dbpass === $hashedpass) {
						session_start();
						$_SESSION['logstate'] = TRUE;
						$_SESSION['username'] = "$username";
						$_POST = array();
						echo '<h2>My Account</h2>';
			echo '<h3>Allergies:</h3>';
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
			$username = $_SESSION['username'];
			if (array_key_exists('allergy', $_POST) && array_key_exists('rallergy', $_POST)) {
				$allergy = $_POST['allergy'];
				$allergy = ucfirst(trim($allergy));
				unset($_POST['allergy']);
				$rallergy = $_POST['rallergy'];
				$rallergy = ucfirst(trim($rallergy));
				unset($_POST['rallergy']);
				if (empty($allergy) && empty($rallergy)) {
					echo "<div class='error'>Please enter an allergy</div>";
				} else{
					if (empty($rallergy)) {
						$sql = "SELECT * FROM allergies WHERE username = '$username' AND allergy = '$allergy';";
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) > 0) {
							echo "<div class='error'>You already listed this allergy!</div>";
						} else {
							$sql = "INSERT INTO allergies (username, allergy) VALUES ('$username', '$allergy');";
							$result = mysqli_query($conn, $sql);
						}
					} else if (empty($allergy)) {
						$sql = "SELECT * FROM allergies WHERE username = '$username' AND allergy = '$rallergy';";
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) > 0) {
							$sql = "DELETE FROM allergies WHERE allergy = '$rallergy';";
							$result = mysqli_query($conn, $sql);
						} else {
							echo "<div class='error'>This allergy is not listed.</div>";
						}
					} else {
						$sql = "SELECT * FROM allergies WHERE username = '$username' AND allergy = '$allergy';";
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) > 0) {
							echo "<div class='error'>You already listed this allergy!</div>";
						} else {
							$sql = "INSERT INTO allergies (username, allergy) VALUES ('$username', '$allergy');";
							$result = mysqli_query($conn, $sql);
						}
						$sql = "SELECT * FROM allergies WHERE username = '$username' AND allergy = '$rallergy';";
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) > 0) {
							$sql = "DELETE FROM allergies WHERE allergy = '$rallergy';";
							$result = mysqli_query($conn, $sql);
						} else {
							echo "<div class='error'>This allergy is not listed.</div>";
						}
					}
				}
			}			
			$sql = "SELECT * FROM allergies WHERE username = '$username';";
			$result = mysqli_query($conn, $sql);
			echo "<ul>";
			if ($result == TRUE) {
				if (mysqli_num_rows($result) > 0) {
					for ($x = 1; $x <= mysqli_num_rows($result); $x++) {
						$y = mysqli_fetch_assoc($result);
						$z = $y['allergy'];
						$z = ucfirst($z);
						echo "<li>$z</li>";
					}
				}
			}
			echo "</ul>";
			echo '<div class="login">
						<form method="POST">
							Add Allergy: <br><input type="text" name="allergy"><br>
							Remove Allergy: <br><input type="text" name="rallergy"><br><br>
							<input type="submit" value="Add/Remove">
							<br>
					</div>';
			echo '<a href="logout.php"><button class="logbutton" type="button">Log Out</button></a>';
					} else {
						echo "<div class='error'>Incorrect username or password.<br></div>";
						echo '<h2>Login: <br></h2>
						<div class="login">
						<form method="POST">
							Username: <br><input type="text" name="username" required><br><br>
							Password: <br><input type="password" name="password" required><br><br>
							<input type="submit" value="Log In">
							<br>
					</div>';
					}
				} else {
					echo "<div class='error'>No account with that username was found.<br></div>";
					echo '<h2>Login: <br></h2>
					<div class="login">
						<form method="POST">
							Username: <br><input type="text" name="username" required><br><br>
							Password: <br><input type="password" name="password" required><br><br>
							<input type="submit" value="Log In">
							<br>
					</div>';
				}
			}
			
		} else {
			echo '<h2>Login: <br></h2>
			<div class="login">
						<form method="POST">
							Username: <br><input type="text" name="username" required><br><br>
							Password: <br><input type="password" name="password" required><br><br>
							<input type="submit" value="Log In">
							<br>
					</div>';
		}
	}
	?>
</html>