<?PHP
	include('header.php');
	$imgholder = null;
?> 
		<div id = 'mainContent_reg' >
			<div id = 'heading' > Search  Individual Record </div>
				<div id = 'formSection' >
				<form action = '' method = 'POST'>
					<input type = 'text' name = 'search' id = 'search' placeholder = 'Search by Nickname|Phone Number|Email' autofocus required />
					<input type = 'submit' name = 'submit' id = 'submit' value = 'Search' />
				</form>
				</div >
				<div id = 'tableSection' >
				<?php 
					if (isset($_POST['submit'])){
						$searchVar = $_POST['search'];
						
						if(empty($searchVar)){
							$msg = 'The input field is empty! Pls search by nickname, phone number or email address ';
							$block = "<div class = 'message' > $msg </div>";
							echo $block; 
						}else{
							$result = $Engine->search($searchVar);
							
							if (!(isset($result['details']))){
								$msg = 'Record is not in the database';
								$block = "<div class = 'message' > $msg </div>";
								echo $block;
							}else{
								$row = $result['details'];
								if(!empty($row['passport'])){
									$imgholder = '<img src = "uploads/'.$row['passport'].'" height= 120 width= 120 alt = "No Passport" />';
								}else{
									$imgholder = '<img src = "images/noImage.jpeg" height= 120 width= 120 alt = "No Passport" />';
								}
								if (isset($row)){
									$block = "<table>
										<tbody> 
										<tr> 
											<td> &nbsp </td> 
											<td> ".$imgholder." </td>
										</tr>
										<tr> 
											<td> First Name</td> <td>".$row['first_name']." </td>
										</tr>
										<tr> 
											<td> Last Name </td> <td>".$row['last_name']." </td>
										</tr>
										<tr> 
											<td> Nickname</td> <td>".$row['nickname']." </td>
										</tr>
										<tr> 
											<td> Gender</td> <td>".$row['gender']." </td>
										</tr>
										<tr> 
											<td> Phone Number</td> <td>".$row['phone_number']." </td>
										</tr>
										<tr> 
											<td> Email</td> <td>".$row['email_address']." </td>
										</tr>
										<tr> 
											<td> State/Hometown</td> <td>".$row['state']." </td>
										</tr>
										<tr> 
											<td> Department/Unit</td> <td>".$row['department']." </td>
										</tr>
										</tbody> 
										</table>";
									}
										echo $block;
								?>	
									<div class = 'links'>
										 <a href = 'edit.php?id=<?=$row['id']?> ' style = 'display:block; background:#6495ED; color:white;'> EDIT </a><a href = 'delete.php?id=<?=$row['id']?> ' style = 'display:block; background:grey; color:white;' onclick = "return confirm('Are you sure you want to delete?');" > DELETE </a> <a href = 'view.php' style = 'display:block; background:#000000; color:white;' > GO BACK </a> 
									</div>
							<?php	
								}
						}
					}
							?>
			</div>
		</div>
	</body>
</html>