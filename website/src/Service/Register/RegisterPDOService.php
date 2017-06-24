<?php

	namespace dave007700\Service\Register;

	class RegisterPDOService implements RegisterService
	{
		private $pdo;

		public function __construct(\PDO $pdo)
		{
			$this->pdo = $pdo;
		}

		private function available_Mail($email)
		{
			$stmt = $this->pdo->prepare("SELECT * FROM user WHERE EMail=?");
			$stmt->bindValue(1, $email);
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

		private function available_Username($username)
		{
			$stmt = $this->pdo->prepare("SELECT * FROM user WHERE Username=?");
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

		public function getPasswordSendDataFromUser($userData)
		{
			$stmt = $this->pdo->prepare("SELECT * FROM user WHERE (Username=? OR EMail=?) AND IsActivated=2");
			$stmt->bindValue(1, $userData);
			$stmt->bindValue(2, $userData);
			$stmt->execute();

			if($stmt->rowCount() === 1)
			{
				return $stmt->fetch();
			}
			else
			{
				return null;
			}
		}

		public function getUserIDOverPasswordKey($passwordKey)
		{
			$stmt = $this->pdo->prepare("SELECT ID FROM user WHERE Resetkey=? AND IsActivated=1");
			$stmt->bindValue(1, $passwordKey);
			$stmt->execute();

			if($stmt->rowCount() === 1)
			{
				return $stmt->fetch();
			}
			else
			{
				return null;
			}
		}

		public function updateUsePassword($newPassword, $UserID)
		{
			$stmt = $this->pdo->prepare("UPDATE user SET Password=?, IsActivated=2 WHERE ID=? AND IsActivated=1");
			$stmt->bindValue(1, password_hash($newPassword, PASSWORD_DEFAULT));
			$stmt->bindValue(2, $UserID);
			$stmt->execute();
		}


		public function setUserStatus($userID, $securityKey)
		{
			$stmt = $this->pdo->prepare("UPDATE user SET Resetkey=?, IsActivated=1 WHERE ID=?");
			$stmt->bindValue(1, $securityKey);
			$stmt->bindValue(2, $userID);
			$stmt->execute();
		}

		public function registerUser($username, $email, $password, $securityKey)
		{
			if(filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				if($this->available_Mail($email))
				{
					if($this->available_Username($username))
					{

						try {

							$stmt = $this->pdo->prepare("INSERT INTO user (username, email, password, securitykey) VALUES (?,?,?,?)");
							$stmt->bindValue(1, $username);
							$stmt->bindValue(2, $email);
							$stmt->bindValue(3, password_hash($password, PASSWORD_DEFAULT));
							$stmt->bindValue(4, $securityKey);
							$stmt->execute();

							return true;
						} catch(\Exception $e) {
							var_dump($e);
						}
					}
					else
					{
						echo "Dieser Benutzername ist berreits Registriert";
						return false;
					}
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
