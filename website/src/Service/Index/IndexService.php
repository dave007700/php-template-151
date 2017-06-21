<?php

	namespace dave007700\Service\Index;

	interface IndexService
	{
		public  function getAllMovies();
		public  function getMoveByID($MovieID);

		public  function getTaskBar();

		public  function CheckLogin();
		public  function GetUsername();
		public  function GetRights();

		public  function tryActivate($securityKey);
		public  function createNewEntry($Name, $Content, $ReleaseDate, $TrailerURL, $BackGroundImgURL, $Tags, $PG);
	}

?>
