<?php
session_start();
require('database/db_connect.php');
if($_SERVER['REQUEST_METHOD']== "POST")
{
	if(isset($_POST['message']))
	{
		$text = $_POST['message'];
		$me = $_POST['user'];
		$friend = $_POST['recipient'];
		$time = date("Y-m-d h:i:sa",time());
		
		$stmt = $conn->prepare("INSERT into messages(author,recipient,time,message)
				 VALUES(:user,:recipient,:time,:text)");
	    }
		$stmt->bindParam(':text',$text );
		$stmt->bindParam(':user',$me);
		$stmt->bindParam(':time',$time);
		$stmt->bindParam(':recipient',$friend);
		$stmt->execute();

	}
?>