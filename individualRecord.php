<?PHP
	include('header.php');
	$smg = null;
	
?> 
		<div id = 'mainContent_reg' >
			<div id = 'heading' > Individual Record </div>
			<div id = 'tableSection' >
				<?php 
					if(isset($_GET['id'])){
						$id = htmlentities($_GET['id']);
						$record = $Engine->viewIndividual($id);
						//echo '<pre>';
						$result = $record['details']; 
						//echo '<pre>';
						if (!empty($result)){
							if(!empty($result['passport'])){
								$imgholder = '<img src = "uploads/'.$result['passport'].'" height= 120 width= 120 alt = "No Passport" />';
							}else{
								$imgholder = '<img src = "images/noImage.jpeg" height= 120 width= 120 alt = "No Passport" />';
							}
							$block = "<table> 
							<thead>  </thead>
							<tbody> 
							<tr> 
								<td> &nbsp </td> 
								<td> ".$imgholder." </td>
							</tr>
							<tr> 
								<td> First Name</td> <td>".$result['first_name']." </td>
							</tr>
							<tr> 
								<td> Last Name </td> <td>".$result['last_name']." </td>
							</tr>
							<tr> 
								<td> Nickname</td> <td>".$result['nickname']." </td>
							</tr>
							<tr> 
								<td> Gender</td> <td>".$result['gender']." </td>
							</tr>
							<tr> 
								<td> Phone Number</td> <td>".$result['phone_number']." </td>
							</tr>
							<tr> 
								<td> Email</td> <td>".$result['email_address']." </td>
							</tr>
							<tr> 
								<td> State/Hometown</td> <td>".$result['state']." </td>
							</tr>
							<tr> 
								<td> Department/Unit</td> <td>".$result['department']." </td>
							</tr>
							</tbody> 
							</table>";
						}
						echo $block;
				?>	<div class = 'links'>
						 <a href = 'edit.php?id=<?=$result['id']?> ' style = 'display:block; background:#6495ED; color:white;'> EDIT </a><a href = 'delete.php?id=<?=$result['id']?> ' style = 'display:block; background:grey; color:white;' onclick = "return confirm('Are you sure you want to delete?');" > DELETE </a> <a href = 'view.php' style = 'display:block; background:#000000; color:white;' > GO BACK </a> 
					</div>
				<?php	
					}
				?>
			</div>
		</div>
	</body>
</html>