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
			$stmt = $this->pdo->prepare("SELECT * FROM user WHERE email=? OR Username=? AND password=? AND IsActivated=2");
			$stmt->bindValue(1, $username);
			$stmt->bindValue(2, $username);
			$stmt->bindValue(3, $password);
			$stmt->execute();

			if($stmt->rowCount() === 1)
			{

				session_reset();

				$returnSQL = $stmt->fetch();

				$_SESSION["email"] = $returnSQL['EMail'];
				$_SESSION["Username"] = $returnSQL['Username'];
				$_SESSION["UserRights"] = $returnSQL['FK_Rights'];
				$_SESSION["LogedIN"] = true;

				return true;


			}else{
				session_destroy();
				return false;
			}
		}
	}

?>
