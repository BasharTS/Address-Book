<?php
	//session_start();
	include('header.php');
?>
	<div id = 'adminButton'>
		<a href = 'admin.php'> Want to register new admin? </a>
	</div>
		<div id = 'mainContent' >
			<div class = 'welcome'>
				<?php
					echo "<h2> Welcome To Your Address Book,  <br/>".$_SESSION['username'] ."</h2>";
				?>
				<div class='displ'>
					<div class='title'>General Information</div>
					<div class='message'><?=$msg;?></div>
						<div class='content'>
							<?php
								if (isset($_SESSION["username"])){ 
									$fullname = $_SESSION["fullname"];
									$username = $_SESSION["username"];
									$lastLogin = $_SESSION["last_Login"];
									$num_contact = $_SESSION["number_of_contact"];
									$block = "<table> <thead> <th></th> <th></th> </thead><tbody> <tr><td> Fullname: </td> <td>".$fullname." </td> </tr> <tr> <td>Username: </td> <td> ".$username." </td> </tr> <tr> <td>Last Login: </td> <td>".$lastLogin." </td> </tr> <td>Contact in Address Book: </td> <td>".$num_contact." </td> </tr> </tbody> </table> ";
									echo $block;
								} 
								//echo "<a href = 'admin.php'> Want to register new admin? </a>";
							?>
						</div>
				</div>
			</div>
		</div>
	</body>
</html>