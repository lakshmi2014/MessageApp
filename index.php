<!DOCTYPE html>

<html>
<head>
	<title>SocialNet-LogIn or SignUp</title>	
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
							include('include/header-index.php');
							if(isset($_GET['message']))
							{
								echo "<p style ='color:red;text-align:center'>Invalid username/password</p>";
							}
						?>
					</div>
				</div>
				
		

			<!-- start page -->

				<div id="page">
					<div id="content" style ="text-align:center" >
						<h2>Please Register to start</h2>
						<p>Socialnet helps you connect and share with the people in your life.</p>
						<form method ="POST" class ="form-group" action ="signup.php" >
						
						    <input type="email" name="email" id = "email" class ="form-group" placeholder ="Your Email" onBlur = "checkUser()" required ><br>
						    <span id ="info"></span><br>
				            <input type="password"  name="pass" id ="pass" class ="form-group" placeholder ="Password" required><br>
							<span id ="txt"></span><br>
					        <input type="submit" name ="submit" id ="submit" class="btn btn-primary" value ="Create an account" >
							
							
	    				</form>
						
					</div>
					<!-- end content -->
					
					
					<div style="clear: both;">&nbsp;</div>
				</div>
			<!-- end page -->
			
			<!-- start footer -->
				<div id="footer">
					
						<?php
							include('include/footer.php');
						?>
					
				</div>
			<!-- end footer -->
			<script>


			$('#email').on('keypress', function(e) {
				   if (e.which == 32)
		           return false;					
		    });

		    $('#pass').keyup(function() {
		    		if((/^(?=.*\d)(?=.*[a-zA-Z]).{6,}$/).test(this.value))
  					{
  						$('#submit').prop('disabled',false);
  					}
  					else{
  						$('#txt').html("password must be 6 chars long and contain atleast 1 number");
  						$('#submit').prop('disabled',true);

  					}
  				});
  						
  				
			function checkUser()
			{
				$user = $('#email').val() ;
				if($user == '')
				{
					$('#info').html('');
					return;
				}
				else
				{
				//$('#info').html($('#email').val());
				$.ajax({
					type:"post",
					url :"checkuser.php",
					data : {'user' : $user},
					success :function(data)
					{
						if(data == "yes")
						{
							$('#info').html("This username is available");
						}
						else
						{
							$('#email').val('');
							$('#info').html("This username is not available");
						}

										
					},
					error:function()
					{
						
					}

				});
				}
									
			}
			</script>
</body>
</html>
