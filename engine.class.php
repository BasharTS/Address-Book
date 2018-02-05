<?php
include('definitions.php');

class Engine {

	//Define private variables.
	private $mysqli;

	//Constructor
	function __construct() {
		$this->mysqli = new mysqli('localhost', 'root', '', 'crudoop');
	}

	//Destructor
	function __destruct() {
		$this->mysqli->close();
	}
	//METHOD 1: To login admin
	function loginAdmin($username, $password) {
		//Security Measure: Avoid SQL Injections.
		$username = $this->mysqli->real_escape_string($username);
		$password = $this->mysqli->real_escape_string($password);
		//Encryt the password with MD5
		$password = md5($password);
		//Done.

		$query = "SELECT * FROM `admins` WHERE `username`='$username' AND `password`='$password'";
		$result = $this->mysqli->query($query);

		if ($result->num_rows > 0) {
			$feedback['feedback'] = 1;
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$feedback['details'] = $row;
		} else { //Invalid login.
			$feedback['feedback'] = 0;
			$feedback['message'] = "Invalid login credentials";
		}
		return $feedback;
	}
	
	// Login time
	function logtime($adminId, $loginTime){
		$query = "update admins set `last_login` = '$loginTime' where `admin_id` = '$adminId' ";
		$result = $this->mysqli->query($query);
	}

	//METHOD 2: TO Insert i.e CREATE!
	function insertData($userpic, $firstName, $lastName, $nickName, $gender, $phoneNumber, $emailAddress, $state, $department){
		$userpic = $this->mysqli->real_escape_string($userpic);
		$firstName = $this->mysqli->real_escape_string($firstName);
		$lastName = $this->mysqli->real_escape_string($lastName);
		$nickName = $this->mysqli->real_escape_string($nickName);
		$gender = $this->mysqli->real_escape_string($gender);
		$phoneNumber = $this->mysqli->real_escape_string($phoneNumber);
		$emailAddress = $this->mysqli->real_escape_string($emailAddress);
		$state = $this->mysqli->real_escape_string($state);
		$department = $this->mysqli->real_escape_string($department);
		
		$query = "INSERT INTO `crud_tab` (`passport`,`first_name`,`last_name`,`nickname`,`gender`,`phone_number`,`email_address`,`state`,`department`) VALUES ('$userpic','$firstName','$lastName','$nickName', '$gender','$phoneNumber','$emailAddress','$state','$department')";
		
		$result = $this->mysqli->query($query); 
		if ($result != ''){
			$feedback['feedback'] = 1;
			$feedback['message'] = '<Span style = "color:green; font-weight:bold;" >Record Inserted Successfully! </span>'; 
		}else{
			$feedback['feedback'] = 0;
			$feedback['message'] = 'Unable to insert record!' .$this->mysqli->error ; 
		}
		return $feedback;
	}
	
	//To add admin.
	function insertData2($fullname, $username, $password){
		$fullname = $this->mysqli->real_escape_string($fullname);
		$username = $this->mysqli->real_escape_string($username);
		$password = $this->mysqli->real_escape_string($password);
		$password = md5($password);
		
		$query = "INSERT INTO `admins` (`fullname`,`username`,`password`) VALUES ('$fullname','$username','$password')";
		
		$result = $this->mysqli->query($query); 
		if ($result != ''){
			$feedback['feedback'] = 1;
			$feedback['message'] = '<Span style = "color:green; font-weight:bold;" >Admin Added Successfully! </span>'; 
		}else{
			$feedback['feedback'] = 0;
			$feedback['message'] = 'Unable to add admin!' .$this->mysqli->error ; 
		}
		return $feedback;
	}
	
	//To view all records
	function view(){	
		$query = 'SELECT * FROM `crud_tab` ORDER BY `first_name` ASC';
		
		$result = $this->mysqli->query($query);
		if($result->num_rows > 0){
			$feedback['feedback'] = 1;
			$c = 0;
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$feedback['details'][$c] = $row;
			$c++;
			}
		}else{
			$feedback['feedback'] = 0;
			$feedback['message'] = 'No Record Yet!'; 
		}
		return $feedback;
	}
	
	//To view individual record
	function viewIndividual($id){
		$id = $this->mysqli->real_escape_string($id);
		
		$query = "SELECT * FROM `crud_tab` WHERE id = '$id'";
		$result = $this->mysqli->query($query);
		if ($result->num_rows > 0){
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$feedback['feedback'] = 1;
			$feedback['details'] = $row; 
		}else{
			$feedback['feedback'] = 0;
			$feedback['message'] = 'Unable to fetch record!' .$this->mysqli->error; 
		}
		return $feedback;
	}
	
	//To seach database
	function search($searchVar){
		$searchVar = $this->mysqli->real_escape_string($searchVar);
		
		$query = "SELECT * from `crud_tab` WHERE `nickname` = '$searchVar' OR `phone_number` = '$searchVar' OR `email_address` ='$searchVar'";	
		
		$result = $this->mysqli->query($query);
		if($result->num_rows >0){
			$feedback['feedback'] = 1;
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$feedback['details'] = $row;
		}else{
			$feedback['feedback'] = 0;
			$feedback['message'] = 'No Record Found. Please try again!'; 
		}
		return $feedback;
	}
	
	//To Edit individual record
	function edit($id){
		$id = $this->mysqli->real_escape_string($id);
		
		$query = "SELECT * FROM `crud_tab` WHERE id = '$id'";
		$result = $this->mysqli->query($query);
		if ($result->num_rows > 0){
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$feedback['feedback'] = 1;
			$feedback['details'] = $row; 
		}else{
			$feedback['feedback'] = 0;
			$feedback['message'] = 'Unable to fetch record!' .$this->mysqli->error; 
		}
		return $feedback;
	}
	//METHOD 2: TO Insert i.e CREATE!
	function insertUpdate($id,$userpic, $firstName, $lastName, $nickName, $gender, $phoneNumber, $emailAddress, $state, $department){
		$id = $this->mysqli->real_escape_string($id);
		$userpic = $this->mysqli->real_escape_string($userpic);
		$firstName = $this->mysqli->real_escape_string($firstName);
		$lastName = $this->mysqli->real_escape_string($lastName);
		$nickName = $this->mysqli->real_escape_string($nickName);
		$gender = $this->mysqli->real_escape_string($gender);
		$phoneNumber = $this->mysqli->real_escape_string($phoneNumber);
		$emailAddress = $this->mysqli->real_escape_string($emailAddress);
		$state = $this->mysqli->real_escape_string($state);
		$department = $this->mysqli->real_escape_string($department);
		
		$query = "UPDATE `crud_tab` SET `passport`='$userpic',`first_name`='$firstName',`last_name`='$lastName',`nickname`='$nickName',`gender`='$gender',`phone_number`='$phoneNumber',`email_address`='$emailAddress',`state`='$state',`department`='$department' WHERE `id` = '$id' ";
		
		$result = $this->mysqli->query($query); 
		if ($result != ''){
			$feedback['feedback'] = 1;
			$feedback['message'] = '<Span style = "color:green; font-weight:bold;" >Record Updated Successfully! </span>'; 
		}else{
			$feedback['feedback'] = 0;
			$feedback['message'] = 'Unable to Update record! ' .$this->mysqli->error; 
		}
		return $feedback;
	}
	
	//To delete individual record
	function delete($id){
		$id = $this->mysqli->real_escape_string($id);
		$query = "DELETE FROM `crud_tab` WHERE id = '$id'";
		$this->mysqli->query($query);
		$result = $this->mysqli->affected_rows;
		if ($result > 0){
			$feedback['feedback'] = 1;
			$feedback['message'] = 'Record deleted successfully'; 
		}else{
			$feedback['feedback'] = 0;
			$feedback['message'] = 'Unable to delete record!' .$this->mysqli->error; 
		}
		return $feedback;
	}

	//METHOD 16: To get the number of contacts
	function getTotalcontactCount() {
		$countContact = $this->mysqli->query("SELECT COUNT(*) AS num FROM `crud_tab`");
		$numOfContact = 0;
		if ($countContact->num_rows > 0) {
			$numOfContact = $countContact->fetch_array(MYSQLI_ASSOC)['num'];
		}
		return $numOfContact;
	}
	
}
















		
?>