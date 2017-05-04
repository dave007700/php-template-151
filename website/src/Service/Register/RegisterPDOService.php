<?php 

	namespace dave007700\Service\Register;
	
	class RegisterPDOService implements RegisteService
	{
		private $pdo;
		
		public function __construct(\PDO $pdo)
		{
			$this->pdo = $pdo;
		}
		
		private function available($username)
		{
			$stmt = $this->pdo->prepare("SELECT * FROM user WHERE email=?");
			$stmt->bindValue(1, $username);
			$stmt->execute();
			
			if($stmt->rowCount() === 1)
			{
				return false;
			}
			else
			{
				return true;
			}
			
		}
		
		public function registerUser($username, $password)
		{
			if(filter_var($username, FILTER_VALIDATE_EMAIL))
			{
				if(available($username))
				{
					$stmt = $this->pdo->prepare("INSERT INTO user ('email', 'password') VALUES (?,?)");
					$stmt->bindValue(1, $username);
					$stmt->bindValue(2, $password);
					$stmt->execute();
					
					return true;
				}
				else
				{
					echo "Diese E-Mail ist berreits Registriert";
					return false;
				}
			}
			else
			{
				echo "Diese E-Mail ist ungültig";
				return false;
			}
		}
		
	}

?>

