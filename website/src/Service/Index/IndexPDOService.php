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

			return $stmt->fetch();
		}
	}

?>
