<?php
session_start();
$is_friend = false;
$me = $_SESSION['user'];
require('database/db_connect.php');
$friend = $_GET['member'];

if(isset($_GET['action']) && isset ($_GET['member']))
{
	$action = $_GET['action'];
	

	if ($action == 'add')
	{
		$stmt = $conn->prepare("SELECT user,friend  from friends where user = :user and friend = :friend");
				$stmt ->bindParam(':user',$me);
				$stmt ->bindParam(':friend',$friend);
				$stmt->execute();
				if($stmt->rowCount() == 0)
				{
					$stmt = $conn->prepare("INSERT into friends (user,friend)
							VALUES(:user,:friend)");
				$stmt ->bindParam(':user',$me);
				$stmt ->bindParam(':friend',$friend);
				$stmt->execute();
				$is_friend = true;
			}
	}
	if ($action == 'delete'){
		$stmt = $conn->prepare("DELETE from friends where user = :user and friend = :friend");
				$stmt ->bindParam(':user',$me);
				$stmt ->bindParam(':friend',$friend);
				$stmt->execute();
				$is_friend = false;
			}
}
if($_SERVER['REQUEST_METHOD']== "POST")
{
	if(isset($_POST['text']))
	{
		$text = $_POST['text'];
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
<html>
<head>
	<title>SocialNet</title>	
	<?php
	include('include/style.php');
	?>
</head>

<body style ="background-color:#f7f7f7 ">
			<!-- start header -->
				<div id="header">
					<div id="menu">
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
						<?php
							include('include/header.php');
						?>
					</div>
				</div>
				<div id="page">
				<?php 
				$stmt = $conn->prepare("SELECT text,pic from profiles where user = :user");
				$stmt->bindParam(':user',$friend);
				$stmt->execute();
				$results = $stmt->fetchAll();
				foreach($results as $result){
					echo "<h3>$friend Profile</h3>";
					echo "<div><img src=".$result['pic']."></div>";
					echo "<div>".$result['text']."</div>";
					if($is_friend == true)
					echo "<div>Friends</div>";

				}
				?>
				<div id="content" style ="width:600px;height:300px" >
					<h3>Post a Message</h3>
					<form method ='post' action =''>
					<textarea name ='text' cols='50' rows ='3'></textarea><br>
					<input type ='submit' value ='Post'><br>
					</form>
				</div>
				
				
	</div>
	</body>
	</html>
