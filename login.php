<?PHP
	session_start();
	include ('engine.class.php');
	$Engine = new Engine();
	$msg = null;
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="styles/stysheet.css" />
		<title> Address Book - Login </title>
	</head>
    <body>
        <h1> ADDRESS BOOK </h1>
		<h2> WELCOME TO MY ADDRESS BOOK </h2>
        <?php
			if (isset($_SESSION['admin_id'],$_SESSION['username'])) {
				header('location: index.php');
			}

			if (isset($_POST['login'])) {
				$username = $_POST['username'];
				$password = $_POST['password'];
				
				if (!empty($username) && !empty($password)) {
					$result = $Engine->loginAdmin($username, $password);
					if ($result['feedback'] == 1) {
						$details = $result['details'];
						
						print_r($details);
						$adminId = $details['admin_id'];
						$username = $details['username'];
						$fullname = $details['fullname'];
						
						//get the value in the last login column
						$lastLogin = $details['last_login'];
						
						//current login time
						$loginTime =  date("l")."&nbsp".date("Y/m/d")."&nbsp".date("h:i:sa");
						
						$count=$Engine->getTotalcontactCount();
						//STORE LOGIN DETAILS FOR A PERIOD OF ADMIN ACTIVITIES.
						$_SESSION['username'] = $username;
						$_SESSION['admin_id'] = $adminId;
						$_SESSION['fullname'] = $fullname;
						$_SESSION['last_Login'] = $lastLogin;
						$_SESSION['number_of_contact'] = $count;
						
						$Engine->logTime($adminId, $loginTime);
						
						//REDIRECT THE USER INTO HIS DASHBOARD
						header('location: index.php');

					} else {
						$msg = $result['message'];
					}
				} else {
					$msg = "All fields are required";
				}
			}
		?>
<div class='register'>
	<div class='title'>Input Your Credentials</div>
	<div class='message'><?=$msg;?></div>
	<div class='content'>
		<form method='post' action=''>
			<input type='text' name='username' id='username' placeholder='Enter Username' /><br />
			<input type='password' name='password' id='password' placeholder='Password' /><br />
			<input type='submit' name='login' id='login' value='Login' /><br />
		</form>
	</div>
</div>
</body>
</html>