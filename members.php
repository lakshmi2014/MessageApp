<?php
session_start();
$user = $_SESSION['user'];

require('database/db_connect.php');
$stmt = $conn->prepare("SELECT * from members");
$stmt->bindParam(':user',$user);
$stmt->execute();
$results = $stmt->fetchAll();

?>

<html>
<head>
	<title>Members</title>	
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
				<h2 style ='text-align:center'>Other Members</h2>
				<?php
				
				foreach($results as $result)
				{
					if($result['user'] == $user)
						continue;
						$member = $result["user"];
						$stmt = $conn->prepare("SELECT * from friends where user =:user and friend = :friend");
						$stmt->bindParam(':user',$user);
						$stmt->bindParam(':friend',$member);
						$stmt->execute();
						if($stmt->rowCount()>0)
						{
						     echo "<div style ='text-align:center'>".$member.""."<a href ='profile.php?action=delete&member=$member'>[Drop Friend]</a><a href ='profile.php?member=$member'>[View Profile]</a></div>";
						}
						else

						echo "<div style ='text-align:center'>".$member." "."<a href ='profile.php?action=add&member=$member'>[Add Friend]</a>
						<a href ='profile.php?member=$member'>[View Profile]</a></div>";

				}

				?>

				</div>

</body>
</html>