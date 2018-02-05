<?PHP
	session_start();
	include ('engine.class.php');
	$Engine = new Engine();
	$msg = null;
	
	if (!isset($_SESSION['admin_id'],$_SESSION['username'])) {
		header('location: login.php');
	}
?>
<html>
	<head>
		<title> Address Book </title>
		<link rel="stylesheet" type="text/css" href="styles/stysheet.css" />
	</head>
	<body>
	<div id = 'header'> 
		<div id = 'headerChild' >
			<div id = 'logo1' > <img src = 'images/AddressBook.png' alt = 'Logo' /> </div>
			<div id = 'logo2' > <img src = 'images/myAddressBook.gif' alt = 'Logo' /> </div>
		</div>
		<div id = 'date' > <?PHP echo date("l"). "&nbsp " . date("Y/m/d") . "&nbsp &nbsp"; ?> </div>
		<div class = 'navigation'>
			<div class = 'menuDiv'>
				<div class = 'menu'>
					<ul>
						<li> <a href ='index.php'> HOME </a> </li>
						<li> <a href ='register.php'> ADD </a> </li>
						<li> <a href ='view.php'> VIEW </a> </li>
						<li> <a href ='search.php'> SEARCH </a> </li>
						<li> <a href ='logout.php'> LOGOUT </a> </li>
					</ul>
				</div>
			</div>
		</div>