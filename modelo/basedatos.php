<?php
$host = "localhost";
$username = "root";
$pass = "";
$database = "ssgym";

$conn = new mysqli ($host, $username, $pass, $database);

if ($conn ->connect_error){
	die("Fallo en la conexion: " . $conn->connect_error);
}
 ?>