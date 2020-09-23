<?php
$servername = "localhost";
$dbname = "name";
$username = "username";
$password = "password";

try {
 $conn = new PDO("mysql:host=$servername;
 dbname=$dbname", $username, $password);
 // set the PDO error mode to exception
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 echo "Connected successfully";
} catch(PDOException $e) {
 echo "Database Connection Error: " . $e->getMessage();
}
?>
