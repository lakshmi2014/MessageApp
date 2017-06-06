<?php
	session_start();

    $user = $_SESSION['user'];

    require('database/db_connect.php');
	$stmt = $conn->prepare("SELECT * from messages where recipient = :user");
				  
	$stmt->bindParam(':user',$user );
					
	$stmt->execute();
    $num_results = $stmt->rowCount();

	$results_per_page = 2;
	$num_pages =ceil($num_results/$results_per_page);
	if(!isset($_GET['page']))
		$page =1;
	else
		$page = $_GET['page'];

	$this_page_first_result = ($page-1)*$results_per_page;


	$stmt = $conn->prepare("SELECT * from messages where recipient = :user LIMIT ".
		$this_page_first_result.','.$results_per_page);
				  
	$stmt->bindParam(':user',$user );
					
	$stmt->execute();

	if($num_results>0)
	{
		$results = $stmt->fetchAll();
		
		echo "<h3>Your Messages</h3>";
		foreach($results as $result)
		{	
			echo "<div><span id ='author'>".$result['author']."</span>wrote <i>".$result['message']."</i> at ".$result['time']." </div>";
							
		}
				
	}

	for($page =1;$page<=$num_pages;$page++)
		echo '<a href ="messages.php?page='.$page.'">'.$page.'<a>';


?>