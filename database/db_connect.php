<?php
$host = 'localhost';
$username = 'root';
$password = '';
try
{
	$conn = new PDO("mysql:host=".$host.", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "CREATE DATABASE IF NOT EXISTS socialnet";
	$conn->exec($sql);
	$sql = "use socialnet";
	$conn->exec($sql);
}
catch(PDOException $e)
{
	echo "Error".$e->getMessage();
}
?>
