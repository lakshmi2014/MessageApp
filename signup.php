<?php
session_start();
if(isset($_POST['email']) && isset($_POST['pass']))
{
	$user = $_POST["email"];
	$pass = $_POST["pass"];


	require('database/db_connect.php');

	$stmt = $conn->prepare("INSERT into members (user,pass)
							VALUES(:username,:password)");
	$stmt ->bindParam(':username',$user);
	$stmt ->bindParam(':password',SHA1($pass));
	$stmt->execute();
	if ($stmt->rowCount()== 0)
	{
		echo "Error creating account";
		header("Location:index.php");
	}
	else
	{
		$_SESSION['user'] = $user;
		$_SESSION['pass'] = $pass;

		header("Location:home.php");

	}

}

?>