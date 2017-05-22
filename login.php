<?php
session_start();
if(isset($_GET['email']) && isset($_GET['pass']))
{
	$user = $_GET["email"];
	$pass = SHA1($_GET["pass"]);
	//echo $pass;

	require('database/db_connect.php');

	$stmt = $conn->prepare("Select user,pass from members WHERE user = :username  and pass =:password");
	$stmt ->bindParam(':username',$user);
	$stmt ->bindParam(':password',$pass);
	$stmt->execute();
	if ($stmt->rowCount()== 0)
	{
		//echo "welcome";
		header("Location:index.php?message=invalid");
	}
	else
	{
		$_SESSION['user'] = $user;
		$_SESSION['pass'] = $pass;

		header("Location:home.php");

	}

}

?>