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
			return '
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
	            <li><a href="/">Dashboard</a></li>
	            <li><a href="/Settings">Settings</a></li>
	            <li><a href="/login">Login</a></li>
	            <li><a href="https://www.google.com">Help</a></li>
	          </ul>
	          <form class="navbar-form navbar-right">
	            <input type="text" class="form-control" placeholder="Search...">
	          </form>
	        </div>
	      </div>
	    </nav>
			';
		}
	}

?>
