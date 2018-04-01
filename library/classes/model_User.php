<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/includes.php';
class User {

	public $id        = null;
	public $email     = "";
	public $password  = "";
	public $name      = "";
	public $firstname = null;
	public $lastname  = null;
	public $userStatus= "user";
	public $errStatus = null;

  	public function __construct($status, $infoArr) {
		switch($status) {

			case "register":
				if( empty($infoArr['email']) ||
					empty($infoArr['password']) ||
					empty($infoArr['name'])) {

					// needs error handling
					$this->errStatus = ["status"=>"error", "message"=>"Please Provide ALL Required Informaiton Before Submitting"];

					break;
				}

				$sanEmail = filter_var($infoArr['email'], FILTER_SANITIZE_EMAIL);
				$sanEmail = filter_var($sanEmail, FILTER_VALIDATE_EMAIL);
				$passHash = password_hash($infoArr['password'], PASSWORD_DEFAULT);

				// verify email
				// verify username
				$userSubService = new User_Service();
				$emailResult = $userSubService->verifyEmail($sanEmail);
				$nameResult = $userSubService->verifyName($infoArr["name"]);
				if ($emailResult) {

					$this->errStatus = ["status"=>"error", "message"=>"That email is already registered"];

					break;
				} 

				if ($nameResult) {

					$this->errStatus = ["status"=>"error", "message"=>"That UserName is already being used"];

					break;
				}

				$this->email    = $sanEmail;
				$this->password = $passHash;
				$this->name     = $infoArr['name'];
				$this->firstname= $infoArr['firstname'];
				$this->lastname = $infoArr['lastname'];
				break;
				
			case "edit":
				if( empty($infoArr['id']) ||
					empty($infoArr['email']) ||
					empty($infoArr['password']) ||
					empty($infoArr['name'])) {

					// needs error handling
					$this->errStatus = ["status"=>"error", "message"=>"Please Provide ALL Required Informaiton Before Submitting"];

					break;
				}

				$sanEmail = filter_var($infoArr['email'], FILTER_SANITIZE_EMAIL);
				$sanEmail = filter_var($sanEmail, FILTER_VALIDATE_EMAIL);

				$this->id       = $infoArr['id'];
				$this->email    = $sanEmail;
				$this->password = $infoArr['password'];
				$this->name     = $infoArr['name'];
				$this->firstname= $infoArr['firstname'];
				$this->lastname = $infoArr['lastname'];
				break;
		}
  	}

	public function register() {
		$db = linkLocal();
		$sql = "INSERT INTO user (email, name, firstname, lastname, password) VALUES (:email, :name, :firstname, :lastname, :password)";
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':email',      $this->email);
		$stmt->bindValue(':name',       $this->name);
		$stmt->bindValue(':firstname',  $this->firstname);
		$stmt->bindValue(':lastname',   $this->lastname);
		$stmt->bindValue(':password',    $this->password);
		$stmt->execute();
		$rowsChanged = $stmt->rowCount();
		$stmt->closecursor();
		return $rowsChanged;
	}

	// Impliment the edit function later

	public function edit() {

	}
}

class User_Service {

	public function __construct(){}

	public function login($infoArr) {

		// Check password validity

		if (empty($infoArr['password'])) { 

			// No password given
			return ["status"=> "error", "message" => "Please Enter A Password"];
		}

		// Check email or username validity

		if (!empty($infoArr['userIdentity'])) {

			// Filter for email and username
			$name 			= filter_var($infoArr['userIdentity'], FILTER_SANITIZE_STRING);
			$email 			= filter_var($infoArr['userIdentity'], FILTER_SANITIZE_EMAIL);
			$vEmail 		= filter_var($email, 				   FILTER_VALIDATE_EMAIL);
			$nameResult 	= $this->verifyName($name);
			$emailResult	= $this->verifyEmail($vEmail);

			// Check name
			if ($nameResult) {

				$userData = $this->getByName($name);

			// Check email
			} else if ($emailResult) {

				$userData = $this->getByEmail($vEmail);

			} else {
				
				// Email or Username incorrect
				return ["status" => "error", "message" => "Your Username Or Email Is Incorrect"];
			}

			$hashCheck = password_verify($infoArr['password'], $userData['password']);

			if(!$hashCheck) {

				// Entered wrong password error
				return ["status"=>"error", "message"=> "Password Incorrect, please try again"];
			}
		
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['userData'] = $userData;
			return $_SESSION['userData'];
		} else {

			// Did not enter username or password
			return ["status"=>"error", "message"=> "Please Enter A Username Or Email"];
		}
	}

	public function verifyEmail($email) {
		$db = linkLocal();
		$sql = "SELECT email from user WHERE email = :email";
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		$matchEmail = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if(empty($matchEmail)){
			return 0;
		} else {
			return 1;
		}
	}

	public function verifyName($name) {
		$db = linkLocal();
		$sql = "SELECT name from user WHERE name = :name";
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':name', $name, PDO::PARAM_STR);
		$stmt->execute();
		$matchName = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if(empty($matchName)){
			return 0;
		} else {
			return 1;
		}
	}

	public function getById($id) {
		$db = linkLocal();
		$sql = "SELECT * FROM user WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$postData = $stmt->fetch(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		return $userData;
	}

	public function getByEmail($email) {
		$db = linkLocal();
		$sql = "SELECT * FROM user WHERE email = :email";
		$stmt = $db->prepare($sql);
		$stmt->bindValue(":email", $email, PDO::PARAM_STR);
		$stmt->execute();
		$userData = $stmt->fetch(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		return $userData;
	}

	public function getByName($name) {
		$db = linkLocal();
		$sql = "SELECT * FROM user WHERE name = :name";
		$stmt = $db->prepare($sql);
		$stmt->bindValue(":name", $name, PDO::PARAM_STR);
		$stmt->execute();
		$userData = $stmt->fetch(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		return $userData;
	}
}