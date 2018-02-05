<?PHP
	include('header.php');
	$smg = null;
?> 
		<div id = 'mainContent_reg' >
			<div id = 'heading' > All Records </div>
			<div id = 'tableSection' >
				<?php 
				
				$record = $Engine->view();
				if (!empty($record)){
					$block = "<table> <thead> <th> FULLNAME </th> <th> PHONE NUMBER </th> </thead><tbody> ";
					foreach($record['details'] as $row){
						$block .=  "<tr><td>".$row['first_name']."  ".$row['last_name']." </td> <td>".$row['phone_number']."</td> <td> <a href = 'individualRecord.php?id=".$row['id']." ' style = 'display:block; background:#6495ED; color:white;'> Full Details </a> </td> </tr>";
					}
					$block .= "</tbody> </table>";
				}	echo $block;
				
				?>
			</div>
		</div>
	</body>
</html>