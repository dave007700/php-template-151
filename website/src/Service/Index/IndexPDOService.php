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

		public function GetUserID()
		{
			if(!(isset($_SESSION['UserID'])))
			{
				$_SESSION['UserID'] = 0;
			}
			return $_SESSION['UserID'];
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
			$stmt = $this->pdo->prepare("SELECT m.*, Count(c.ID) as CommentCount FROM movie m INNER JOIN comments c ON c.MovieID = m.ID WHERE m.ID = ? AND c.IsDisplayed = 1");
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

		public function getCommentsFromMovie($movieID)
		{
			$stmt = $this->pdo->prepare("SELECT c.*, u.Username as Username, u.EMail as EMail FROM comments c INNER JOIN movie m ON c.MovieID = m.ID INNER JOIN user u ON c.FK_UserID = u.ID WHERE c.MovieID = ? AND c.IsDisplayed = 1 ORDER BY c.ID DESC");
			$stmt->bindValue(1, $movieID);
			$stmt->execute();

			return $stmt->fetchAll();
		}

		function checkIfUserComment($commentID, $userID)
		{
			$stmt = $this->pdo->prepare("SELECT ID FROM comments WHERE ID = ? AND FK_UserID = ? AND IsDisplayed = 1");
			$stmt->bindValue(1, $commentID);
			$stmt->bindValue(2, $userID);
			$stmt->execute();

			if($stmt->rowCount() === 1)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		function createComment($movieID, $titel, $message)
		{
			$userID = $this->GetUserID();

			if($userID != 0)
			{
				$stmt = $this->pdo->prepare(
					"INSERT INTO `comments` (`MovieID`, `FK_UserID`, `Titel`, `Content`, `Date`)
					VALUES (?, ?, ?, ?, now());"
				);
				$stmt->bindValue(1, $movieID);
				$stmt->bindValue(2, $userID);
				$stmt->bindValue(3, $titel);
				$stmt->bindValue(4, $message);
				$stmt->execute();
			}

		}

		function deleteComment($commentID, $userID)
		{
			$stmt = $this->pdo->prepare
			(
				"UPDATE comments SET IsDisplayed = 0 WHERE ID = ? AND FK_UserID = ? AND IsDisplayed = 1"
			);
			$stmt->bindValue(1, $commentID);
			$stmt->bindValue(2, $userID);
			$stmt->execute();
		}

		public function existsMovieByID($movieID)
		{
			$stmt = $this->pdo->prepare("SELECT ID FROM movie WHERE ID = ?");
			$stmt->bindValue(1, $movieID);
			$stmt->execute();

			if($stmt->rowCount() === 1)
			{
				return true;
			}
			else
			{
				return false;
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
				"INSERT INTO `movie` (`Name`, `Content`, `ReleaseDate`, `TrailerURL`, `Tags`, `PG`)
				VALUES (?, ?, ?, ?, ?, ?);"
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
					"UPDATE movie SET HasImage = 1 WHERE ID = ?");

					$stmt->bindValue(1, $lastID);

					$stmt->execute();

			}


		}

		public function updateMovieData($movieID, $UseOldPoster, $Name, $Content, $ReleaseDate, $TrailerURL, $Tags, $PG)
		{
			try
			{
				$this->pdo->beginTransaction();

				$stmt = $this->pdo->prepare(
					"UPDATE movie SET Name=?, Content=?, ReleaseDate=?, TrailerURL=?, Tags=?, PG=? WHERE ID=?"
				);
				$stmt->bindValue(1, $Name);
				$stmt->bindValue(2, $Content);
				$stmt->bindValue(3, $ReleaseDate);
				$stmt->bindValue(4, $TrailerURL);
				$stmt->bindValue(5, $Tags);
				$stmt->bindValue(6, $PG);

				$stmt->bindValue(7, $movieID);

				if (!$stmt->execute())
				{
					 throw new \PDOException();
				}

				if(!$UseOldPoster)
				{
					if($this->uploadImageReturnStatus($movieID))
					{
						$stmt = $this->pdo->prepare(
							"UPDATE movie SET HasImage = 1 WHERE ID = ?");

							$stmt->bindValue(1, $movieID);

							if (!$stmt->execute())
							{
									throw new \PDOException();
							}

					}
				}

				$this->pdo->commit();

			}
			catch(\PDOException $e)
      {
          $this->pdo->rollback();
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


	  public function getRealPoserURL($movieID, $HasImage)
	  {
	    if($HasImage)
	    {
	      return $movieID . ".jpg?v=" . uniqid();
	    }
	    else
	    {
	      return "default.jpg";
	    }
	  }

		public function uploadImageReturnStatus($id)
	  {
			if($_FILES["Entry_picture"]["error"] == \UPLOAD_ERR_NO_FILE) {
				return 0;
			}
			else
			{
				$filepath = __DIR__ . "/../../../web/MoviePoster/" . (int) $id . ".jpg";
				move_uploaded_file($_FILES["Entry_picture"]["tmp_name"], $filepath);
				return 1;
			}
	  }

	}

?>
