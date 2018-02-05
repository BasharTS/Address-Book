<?PHP
	include('header.php');
	$fullname=''; 
	$username=''; 
	$password=''; 
?> 
		<div id = 'mainContent_reg' >
			<?php
				if(isset($_POST['submit'])){
					$fullname=strtoupper($_POST['fullname']); 
					$username=($_POST['username']); 
					$password=($_POST['password']); 
					
					if($fullname != '' && $username != '' && $password != '' ) {
						$insertResult = $Engine->insertData2($fullname, $username, $password);
						$addInsertMessage = $insertResult['message'];
					}else {
						$fullname=strtoupper($_POST['fullname']); 
						$username=($_POST['username']); 
						$password=($_POST['password']); 
						
						$addInsertMessage = "Invalid input! Note that all fields are required";
					}
				}
			?>
			<div id = 'heading' > ADD ADMIN </div>
			<div id = 'message' > <?php if (isset($addInsertMessage)){echo $addInsertMessage;} ?> </div>
			<div id = 'formSection' >
				<form method = 'POST' action = '' >
					<input type = 'hidden' name = 'id' id = 'id' />
					<!-- <label for="firstName">&nbsp First Name</label><br />  -->
					<input type = 'text' name = 'fullname' id = 'fullname' value = '<?=$fullname?>' placeholder = 'fullname' /> <br />
					<!-- <label for="lastName">&nbsp Last Name</label><br /> -->
					<input type = 'text' name = 'username' id = 'username' value = '<?=$username?>' placeholder = 'username' /> <br />
					<!-- <label for="nickName">&nbsp Nickname</label><br /> -->
					<input type = 'password' name = 'password' id = 'password' value = '<?=$password?>' placeholder = 'password' /> <br />
					<input type = 'submit' name = 'submit' id = 'submit' value = 'ADD' /><br />
				</form>
			</div>
		</div>
	</body>
</html>