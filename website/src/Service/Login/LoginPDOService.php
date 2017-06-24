<?php

	namespace dave007700\Service\Login;

	class LoginPDOService implements LoginService
	{
		/**
		 *
		 * @var \PDO
		 */

		private $pdo;

		public function __construct(\PDO $pdo)
		{
			$this->pdo = $pdo;
		}

		public function authenticate($username, $password)
		{
			$stmt = $this->pdo->prepare("SELECT * FROM user WHERE email=? OR Username=? AND IsActivated>=1");
			$stmt->bindValue(1, $username);
			$stmt->bindValue(2, $username);
			$stmt->execute();

			$sqlReturnValues = $stmt->fetch();

			if($stmt->rowCount() === 1 && password_verify($password, $sqlReturnValues['Password']))
			{

				session_reset();

				$_SESSION["email"] = $sqlReturnValues['EMail'];
				$_SESSION["Username"] = $sqlReturnValues['Username'];
				$_SESSION["UserRights"] = $sqlReturnValues['FK_Rights'];
				$_SESSION['UserID'] = $sqlReturnValues['ID'];
				$_SESSION["LogedIN"] = true;

				if($sqlReturnValues['IsActivated'] == 1)
				{
					$stmt = $this->pdo->prepare("UPDATE user SET IsActivated=2 WHERE ID = ?");
					$stmt->bindValue(1, $sqlReturnValues['ID']);
					$stmt->execute();
				}

				return true;


			}else{
				session_destroy();
				return false;
			}
		}
	}

?>
