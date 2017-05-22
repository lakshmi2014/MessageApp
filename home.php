<?php
session_start();

$user = $_SESSION['user'];

require('database/db_connect.php');


if($_SERVER['REQUEST_METHOD']== "POST")
{
	if(isset($_POST['text']))
	{
		$text = $_POST['text'];
		$stmt = $conn->prepare("SELECT text from profiles where user = :user");
		$stmt->bindParam(':user',$user);
		$stmt->execute();
		if($stmt->rowCount()>0)
		{
		$stmt = $conn->prepare("UPDATE profiles SET text  =:text where user =:user");
	    }
	    else
	    {
	    	$stmt = $conn->prepare("INSERT into profiles(user,text) VALUES(:user,:text)");
	    }
		$stmt->bindParam(':text',$text );
		$stmt->bindParam(':user',$user);
		$stmt->execute();

	}
	if (!empty($_FILES['image']['name']))
	{
		$saveto ="images/$user.jpg";
		$type =1;
		$errors = array();
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_tmp = $_FILES['image']['tmp_name'];
		$file_type = $_FILES['image']['type'];
		$tmp = explode(".",$file_name);
		$file_ext = strtolower(end($tmp));
		$extensions = array("jpg","jpeg","png");

			if(in_array($file_ext,$extensions) == false)
			{
				$errors[] = "File extension not valid .Please retry";
				
			}
			if($file_size >2097152)
			{
				$errors[] ="File size should be less than 2MB";
				
			}
			if(empty($errors))
			{
				move_uploaded_file($file_tmp,$saveto);
				$stmt = $conn->prepare("UPDATE profiles SET pic  =:pic where user =:user");
				$stmt->bindParam(':pic',$saveto);
				$stmt->bindParam(':user',$user);
				$stmt->execute();

			}
			else if(!empty($errors))
			{
				foreach($errors as $val)
				{
					echo $val;
				}
				
			}

	}
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
				$stmt->bindParam(':user',$user);
				$stmt->execute();
				$results = $stmt->fetchAll();
				foreach($results as $result){
					echo "<h3>Your Profile</h3>";
					echo "<div><img src=".$result['pic']."></div>";
					echo "<div>".$result['text']."</div>";

				}
				?>
				<div id="content" style ="width:600px;height:300px" >
					<h3>Enter or edit your details and/or upload an image</h3>
					<form method ='post' action ='home.php' enctype ='multipart/form-data'>
					<textarea name ='text' cols='50' rows ='3'></textarea><br>
					<input type ='file' name = 'image' size ='14'><br>
					<input type ='submit' value ='Save Profile'><br>
					</form>
				</div>

				<?php
					$stmt = $conn->prepare("SELECT * from messages where recipient = :user");
				  
					$stmt->bindParam(':user',$user );
					
					$stmt->execute();
					if($stmt->rowCount()>0)
					{
						$results = $stmt->fetchAll();
						$i =0;$j=0;
						echo "<h3>Your Messages</h3>";
						foreach($results as $result)
						{		
							echo "<div><span id ='author'>".$result['author']."</span>wrote <i>".$result['message']."</i> at ".$result['time']." </div>";
							
						}
						
					}


				?>
				</div>


</body>
</html>