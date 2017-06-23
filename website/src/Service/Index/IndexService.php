<?php

	namespace dave007700\Service\Index;

	interface IndexService
	{
		public  function getAllMovies();
		public  function getMoveByID($MovieID);
		public  function existsMovieByID($movieID);

		public  function checkIfUserComment($commentID, $userID);
		public  function createComment($movieID, $titel, $message);
		public  function getCommentsFromMovie($movieID);

		public  function getTaskBar();

		public  function CheckLogin();
		public  function GetUsername();
		public  function GetRights();
		public  function GetUserID();

		public  function tryActivate($securityKey);
		public  function createNewEntry($Name, $Content, $ReleaseDate, $TrailerURL, $Tags, $PG);

		public  function uploadImageReturnStatus($id);
		//public  function getPictureByID($id);
	}

?>
