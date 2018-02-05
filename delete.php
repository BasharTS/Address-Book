<?PHP
	include('header.php');
	$smg = null;
?> 
		<div id = 'mainContent_reg' >
			<div id = 'heading' > All Records </div>
			<div id = 'tableSection' >
				<?php 
				if (isset($_GET['id'])){
					$id = $_GET['id'];
					$record = $Engine->delete($id);
					if ($record['feedback']==1){
						header("Location: view.php"); 
					}
				}
				
				?>
			</div>
		</div>
	</body>
</html>