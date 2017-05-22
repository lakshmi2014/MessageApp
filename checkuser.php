<?php
if(isset($_POST['user']))
{
	$user = $_POST['user'];
	require('database/db_connect.php');
	$stmt = $conn->prepare("SELECT user from members where user ='$user'");
	$stmt ->execute();
	if($stmt->rowCount()>0)
	{
		echo "no";
	}
	else
		echo "yes";
}

?>