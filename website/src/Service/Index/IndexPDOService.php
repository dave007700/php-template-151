<?php

	namespace dave007700\Service\Index;

	class IndexPDOService implements IndexService
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

		#region Login Data Check Component

		public function CheckLogin()
		{
			if(!(isset($_SESSION['LogedIN'])))
			{
				$_SESSION['LogedIN'] = false;
			}

			return $_SESSION['LogedIN'];

		}

		public function GetUsername()
		{
			if(!(isset($_SESSION['Username'])))
			{
				$_SESSION['Username'] = "";
			}

			return $_SESSION['Username'];

		}

		public function GetRights()
		{
			if(!(isset($_SESSION['UserRights'])))
			{
				$_SESSION['UserRights'] = 0;
			}

			return $_SESSION['UserRights'];
		}
		#endregion

		public function getAllMovies()
		{
			$stmt = $this->pdo->prepare("SELECT * FROM movie");
			$stmt->execute();

			return $stmt->fetchAll();
		}

		public function getMoveByID($MovieID)
		{
			$stmt = $this->pdo->prepare("SELECT * FROM movie WHERE ID = ?");
			$stmt->bindValue(1, $MovieID);
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

		public function getTaskBar()
		{

			$returnValue = '
			<nav class="navbar navbar-inverse navbar-fixed-top">
	      <div class="container-fluid">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="/">Movie Review DB </a>
	        </div>
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
						';

			if($this->CheckLogin())
			{
				$returnValue .= '
				<li><a href="/">Dashboard</a></li>
				<li><a href="/Settings">Settings</a></li>';

				if($this->GetRights() > 1)
				{
					$returnValue .= '<li><a href="/New-Entry">Eintrag Erstellen</a></li>';
				}

				$returnValue .= '
				<li><a href="/login">Logout</a></li>
				<li><a href="https://www.google.com">Help</a></li>
				';
			}
			else
			{
				$returnValue .= '
				<li><a href="/">Dashboard</a></li>
				<li><a href="/register">Register</a></li>
				<li><a href="/login">Login</a></li>
				<li><a href="https://www.google.com">Help</a></li>
				';
			}

			$returnValue .= '
						</ul>
						<form class="navbar-form navbar-right">
							<input type="text" class="form-control" placeholder="Search...">
						</form>
					</div>
				</div>
			</nav>
			';

			return $returnValue;
		}
	}

?>
