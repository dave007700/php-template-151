<?php 

	namespace dave007700\Service\Login;
	
	interface LoginService
	{
		public  function authenticate($username, $password);
	}

?>