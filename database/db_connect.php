<?php
$host = 'localhost';
$dbName = 'socialnet';
$username = 'root';
$password = '';
try
{
	$conn = new PDO("mysql:host=".$host.";dbname=".$dbName, $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo "Error".$e->getMessage();
}
?>