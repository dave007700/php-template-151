<?php

	namespace dave007700\Service\Index;

	use dave007700\Entity;

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

			/*$movies = [];
	    while($row = $stmt->fetchObject()) {
	        $movie = new \Movie
					(
						$row->ID,
						$row->Name,
						$row->Content,
						$row->RealesDate,
						$row->TrailerURL,
						$row->HasImage,
						$this->getPictureByID($row->ID),
						$row->MoviePoster,
						$row->Tags,
						$row->PG
					);

					$movies[] .= $movie;
	    }

			return $movies;*/

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


		private function changeActivateStatus($userID)
		{
			$stmt = $this->pdo->prepare("UPDATE user SET IsActivated = 2 WHERE ID = ?");
			$stmt->bindValue(1, $userID);
			return $stmt->execute();
		}

		public function tryActivate($securityKey)
		{
			$stmt = $this->pdo->prepare("SELECT ID FROM user WHERE securitykey = ? AND IsActivated = 0");
			$stmt->bindValue(1, $securityKey);
			$stmt->execute();

			if($stmt->rowCount() === 1)
			{
				$variable = $stmt->fetch();
				return $this->changeActivateStatus($variable['ID']);
			}
			else
			{
				return false;
			}

		}

		public function createNewEntry($Name, $Content, $ReleaseDate, $TrailerURL, $Tags, $PG)
		{
			$stmt = $this->pdo->prepare(
				"INSERT INTO `movie` (`Name`, `Content`, `ReleaseDate`, `TrailerURL`, `Tags`, `PG`, `FK_Category`)
				VALUES (?, ?, ?, ?, ?, ?, 0);"
			);
			$stmt->bindValue(1, $Name);
			$stmt->bindValue(2, $Content);
			$stmt->bindValue(3, $ReleaseDate);
			$stmt->bindValue(4, $TrailerURL);
			$stmt->bindValue(5, $Tags);
			$stmt->bindValue(6, $PG);

			$stmt->execute();

			$lastID = $this->pdo->lastInsertId();

			if($this->uploadImageReturnStatus($lastID))
			{
				$stmt = $this->pdo->prepare(
					"UPDATE movie SET ImageURL = ? WHERE ID = ?");

					$stmt->bindValue(1, $lastID.".jpg");
					$stmt->bindValue(2, $lastID);

					$stmt->execute();

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

		public function uploadImageReturnStatus($id)
	  {
			if($_FILES["Entry_picture"]["error"] == \UPLOAD_ERR_NO_FILE) {
				return 0;
			}
			else
			{ #/../../web/MoviePoster/
				die("Die Feature with Picture not added yet");
				die(var_dump(__DIR__ . "/../../web/MoviePoster/"));
				move_uploaded_file($_FILES["Entry_picture"]["tmp_name"], __DIR__ . "/../../web/MoviePoster/" . $id . ".jpg");
				return 1;
			}
	  }

	}

?>
