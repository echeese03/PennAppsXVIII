<?php
$servername = "db752522714.db.1and1.com";;
$username = "dbo752522714";
$password = "yellowwhale";
$dbname = "db752522714";
//Create connection_aborted
$conn = mysqli_connect($servername, $username, $password, $dbname);

//Check connection_aborted
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
$sql = "CREATE TABLE users (  
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username NVARCHAR(200) NOT NULL,
	password NVARCHAR(500) NOT NULL,
	email NVARCHAR(100)
	)";
$result = mysqli_query($conn, $sql);
if ($result) {
	echo "Table 'users' created!";
}
$sql = "CREATE TABLE allergies (  
	username NVARCHAR(200) NOT NULL,
	allergy NVARCHAR(200) NOT NULL
	)";
$result = mysqli_query($conn, $sql);
if($result) {
	echo "Table 'allergies' created!";
}
?>