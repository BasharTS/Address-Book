<?PHP
	include('header.php');
?> 
		<div id = 'mainContent_reg' >
			<?php
				if (isset($_GET['id'])){
					$id = htmlentities($_GET['id']);
					$record = $Engine->edit($id);
					$result = $record['details'];
				
					if(isset($_POST['submit'])){ 
						$id = $_POST['id'];
						$firstName=strtoupper($_POST['firstName']); 
						$lastName=strtoupper($_POST['lastName']); 
						$nickName=strtoupper($_POST['nickName']); 
						$gender=strtoupper($_POST['gender']); 
						$phoneNumber=$_POST['phoneNumber']; 
						$emailAddress=strtoupper($_POST['emailAddress']);
						$state=strtoupper($_POST['state']); 
						$department=strtoupper($_POST['department']);
						
						$imgFile = $_FILES['passport']['name'];
						$tmp_dir = $_FILES['passport']['tmp_name'];
						$imgSize = $_FILES['passport']['size'];
						
						$upload_dir = 'uploads/'; // upload directory
				
						$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
					
						// valid image extensions
						$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
					
						// rename uploading image
						$userpic = rand(10,1000).".".$imgExt;
						if(empty($imgExt)){
							$userpic = '';
						}
							
						// allow valid image file formats
						if(in_array($imgExt, $valid_extensions)){			
							// Check file size '5MB'
							if($imgSize < 5000000)				{
								move_uploaded_file($tmp_dir, $upload_dir.$userpic);
							}
							else{
								$errMSG = "Sorry, your file is too large.";
							}
						}
						else{
							$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
						}
						
						if($firstName != '' && $lastName != '' && $phoneNumber != '' && $state != '') {
							$insertResult = $Engine->insertUpdate($id, $userpic, $firstName, $lastName, $nickName, $gender, $phoneNumber,$emailAddress, $state, $department);
							$addInsertMessage = $insertResult['message'];
							
							$result['first_name']='';
							$result['last_name']='';
							$result['nickname']='';
							$result['phone_number']='';
							$result['email_address']='';
							$result['state']='';
							$result['department']='';
						}else {
							$addInsertMessage = "Invalid input! Note that all fields are required";
						}
					}
				}
			?>
			<div id = 'heading' > UPDATE PROFILE </div>
			<div id = 'message' > <?php if (isset($addInsertMessage)){echo $addInsertMessage;} ?> </div>
			<div id = 'formSection' >
				<form method = 'POST' action = '' enctype = 'multipart/form-data' >
					<input type = 'hidden' name = 'id' id = 'id' value = <?=$result['id'];?>  />
					<label for="passport"> &nbsp  Please Upload Your Passport</label><br />
					<input type = 'file' name = 'passport' id = 'passport' /><br />
					<!-- <label for="firstName">&nbsp First Name</label><br />  -->
					<input type = 'text' name = 'firstName' id = 'firstName' value = '<?=$result['first_name'];?>' placeholder = 'First name' /> <br />
					<!-- <label for="lastName">&nbsp Last Name</label><br /> -->
					<input type = 'text' name = 'lastName' id = 'lastName' value = '<?=$result['last_name'];?>' placeholder = 'Last name' /> <br />
					<!-- <label for="nickName">&nbsp Nickname</label><br /> -->
					<input type = 'text' name = 'nickName' id = 'nickName' value = '<?=$result['nickname'];?>' placeholder = 'Nickname' /> <br />
					<!-- <label for="gender">&nbsp Gender</label><br /> -->
					<select name = 'gender' id = 'gender'>
					<?php
						if($result['gender']=='male'){
							echo '<option value = "male" selected> Male </option>';
							echo '<option value = "female" > Female </option>';
						}else{
							echo '<option value = "male" > Male </option>';
							echo '<option value = "female" selected> Female </option>';
						}
					?>
						
						
					</select><br />
					<!-- <label for="phoneNumber">&nbsp Phone Number</label><br /> -->
					<input type = 'text' name = 'phoneNumber' id = 'phoneNumber' value = '<?=$result['phone_number'];?>' placeholder = 'Phone Number' /> <br />
					<!-- <label for="emailAddress">&nbsp Email Address</label><br /> -->
					<input type ='text' name ='emailAddress' id = 'emailAddress' value = '<?=$result['email_address'];?>' placeholder = 'Email Address' /> <br />
					<!-- <label for="state">&nbsp State</label><br /> -->
					<input type = 'text' name = 'state' id = 'state' value = '<?=$result['state'];?>' placeholder = 'State/Hometown' /> <br />
					<!-- <label for="department">&nbsp Department</label><br /> -->
					<input type = 'text' name = 'department' id = 'department' value = '<?=$result['department'];?>' placeholder = 'Department/Unit' /> <br />
					<input type = 'submit' name = 'submit' id = 'submit' value = 'REGISTER' /><br />
				</form>
			</div>
		</div>
	</body>
</html>