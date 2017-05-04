<?php

require_once 'dbconfig.php';

class USER {		

	private $conn;	
		
	public function __construct() {		
		$database = new Database();		
		$db = $database->dbConnection();		
		$this->conn = $db;   
	}	
		
	public function runQuery($sql) {		
		$stmt = $this->conn->prepare($sql);		
		return $stmt;	
	}		
	
	public function lasdID() {		
		$stmt = $this->conn->lastInsertId();		
		return $stmt;	
	}		
	
	public function register($uname,$email,$upass,$code) {		
		try {										
			$password = md5($upass);			
			$stmt = $this->conn->prepare("INSERT INTO user_creds4(username,email,password,tokenCode) 			                                             
			VALUES(:user_name, :user_mail, :user_pass, :active_code)");			
			$stmt->bindparam(":user_name",$uname);			
			$stmt->bindparam(":user_mail",$email);			
			$stmt->bindparam(":user_pass",$password);			
			$stmt->bindparam(":active_code",$code);			
			$stmt->execute();				
			return $stmt;		
		}		
		catch(PDOException $ex) {			
			echo $ex->getMessage();		
		}	
	}		
	
	public function login($email,$upass) {		
		try {			
			$stmt = $this->conn->prepare("SELECT * FROM user_creds4 WHERE email=:email_id");			
			$stmt->execute(array(":email_id"=>$email));			
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);						
			if($stmt->rowCount() == 1) {				
				if($userRow['status']=="Y") {					
					if($userRow['password']==md5($upass)) {						
						$_SESSION['userSession'] = $userRow['id'];						
						return true;					
					}					
					else {						
						header("Location: login_form5.php?error");						
						exit;					
					}				
				}				
				else {					
					header("Location: login_form5.php?inactive");					
					exit;				
				}				
			}			
			else {				
				header("Location: login_form5.php?error");				
				exit;			
			}				
		}		
		catch(PDOException $ex) {			
			echo $ex->getMessage();		
		}	
	}	
			
	public function is_logged_in() {		
		if(isset($_SESSION['userSession'])) {			
			return true;		
		}	
	}	
		
	public function redirect($url) {		
		header("Location: $url");	
	}	
		
	public function logout() {		
		session_destroy();		
		$_SESSION['userSession'] = false;	
	}	
		
	function send_mail($email,$message,$subject) {								
		require_once('mailer/class.phpmailer.php');		
		$mail = new PHPMailer();		
		$mail->IsSMTP(); 		
		$mail->SMTPDebug  = 0;                     		
		$mail->SMTPAuth   = true;                  		
		$mail->SMTPSecure = "ssl";                 		
		$mail->Host       = "smtp.gmail.com";      		
		$mail->Port       = 465;             		
		$mail->AddAddress($email);		
		$mail->Username="jotasprout@gmail.com";  		
		$mail->Password="WedOct71987";            		
		$mail->SetFrom('jotasprout@gmail.com','Jay Sprout');		
		$mail->AddReplyTo("jotasprout@gmail.com","Jay Sprout");		
		$mail->Subject    = $subject;		
		$mail->MsgHTML($message);		
		$mail->Send();	
	}	
	
}