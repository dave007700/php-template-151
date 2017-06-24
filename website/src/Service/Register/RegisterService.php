<?php

	namespace dave007700\Service\Register;

	interface RegisterService
	{
		public function registerUser($username, $email, $password, $securityKey);

		public function getPasswordSendDataFromUser($userData);

		public function updateUsePassword($newPassword, $UserID);
		public function getUserIDOverPasswordKey($passwordKey);
	}

?>
