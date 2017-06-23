<?php

error_reporting(E_ALL);

session_start();

require_once("../vendor/autoload.php");

$config = parse_ini_file(__DIR__ . "/../config.ini", true);

$factory = new dave007700\Factory($config);

switch($_SERVER["REQUEST_URI"]) {
	case "/testroute":
		echo "Test blabla";
	break;

	case "/":
		$factory->getIndexController()->homepage();
		break;

	case"/login":
		$ctr = $factory->getLoginController();
		if($_SERVER["REQUEST_METHOD"] == "GET")
		{
			$ctr->showLogin();
			session_destroy();
		}
		else
		{
			$ctr->login($_POST);
		}
		break;

	case "/Error-404":
		{
			$factory->getIndexController()->getError404();
			break;
		}

	case "/New-Entry":
		{
			$ctr = $factory->getIndexController();

			if($_SERVER["REQUEST_METHOD"] == "GET")
			{
				$ctr->showcreateNewEntry();
			}
			else
			{
				$ctr->createNewEntry($_POST);
			}

			break;
		}

	case"/register":
		$ctr = $factory->getRegisterController();
		if($_SERVER["REQUEST_METHOD"] == "GET")
		{
			$ctr->showRegister();
		}
		else
		{
			$ctr->register($_POST);
		}
		break;

	default:
		$matches = [];
		if(preg_match("|^/hello/(.+)$|", $_SERVER["REQUEST_URI"], $matches)) {
			$factory->getIndexController()->greet($matches[1]);
			break;
		}
		else if(preg_match("|^/movie=(.+)$|", $_SERVER["REQUEST_URI"], $matches)) {

			$ctr = $factory->getIndexController();

			if($_SERVER["REQUEST_METHOD"] == "GET")
			{
				$ctr->showMovieData($matches[1]);
			}
			else
			{
				$ctr->createComment($matches[1], $_POST);
			}

			break;
		}
		else if(preg_match("|^/activate=(.+)$|", $_SERVER["REQUEST_URI"], $matches)) {
			$factory->getIndexController()->ActivateUser($matches[1]);
			break;
		}
		else if(preg_match("|^/Edit-Movie=(.+)$|", $_SERVER["REQUEST_URI"], $matches)) {

			$ctr = $factory->getIndexController();

			if($_SERVER["REQUEST_METHOD"] == "GET")
			{
				$ctr->showeditEntry($matches[1]);
			}
			else
			{
				//$ctr->createNewEntry($_POST);
			}

			break;
		}
		else if(preg_match("|^/DeleteComment=(.+)$|", $_SERVER["REQUEST_URI"], $matches)) {

			$factory->getIndexController()->deleteComment($matches[1]);

			break;
		}


		$factory->getIndexController()->getError404();
		//echo "Not Found";
}
