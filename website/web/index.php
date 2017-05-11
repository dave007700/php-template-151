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
		}
		else
		{
			$ctr->login($_POST);
		}
		break;
	
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
		echo "Not Found";
}

