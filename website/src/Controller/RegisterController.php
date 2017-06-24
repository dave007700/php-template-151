<?php

namespace dave007700\Controller;

use dave007700\SimpleTemplateEngine;
use dave007700\Service\Register\RegisterService;

class RegisterController
{
  /**
   * @var ihrname\SimpleTemplateEngine Template engines to render output
   */
  private $template;

  private $registerService;

  private $mailer;

  /**
   * @param ihrname\SimpleTemplateEngine
   */
  public function __construct(SimpleTemplateEngine $template, RegisterService $registerService, \Swift_Mailer $mailer)
  {
     $this->template = $template;
     $this->registerService = $registerService;
     $this->mailer = $mailer;
  }

  public function showRegister()
  {
  	echo $this->template->render("register.html.php");
  }

  private function sendUserMailRegister($username, $email, $securityKey)
  {
    $message = (new \Swift_Message('Registrierung'))
                ->setFrom(['security@losdostacos.com' => 'noreply'])
                ->setTo([$email])
                ->setBody("Welcome " . $username . "!!! Open this link to activate your account: https://localhost/activate=" . $securityKey);

                $this->mailer->send($message);
  }

  private function sendUserMailPassword($username, $email, $securityKey)
  {
    $message = (new \Swift_Message('Password Reset'))
                ->setFrom(['security@losdostacos.com' => 'noreply'])
                ->setTo([$email])
                ->setBody(
                  "Good day " . $username . "!!!
                   Open this link to set a new Password for your account: https://localhost/Password/Reset/Verify=" . $securityKey . "
                  If you didn't request this Password-Reset or this isn't your E-Mail... Don't worry just ignore this mail and the Resetlink will
                  expire at your next login :)

                  Best wishes
                  LosDosTacos-Security Team
                  ");

                $this->mailer->send($message);
  }

  private function generateKey($email)
  {
    return sha1(mt_rand(10000,99999).time().$email);
  }

  public function register(array $data)
  {
  	if(!array_key_exists("username", $data) OR !array_key_exists("email", $data) OR !array_key_exists("password", $data))
  	{
  		$this->showRegister();
  		return;
  	}

    $securityKey = $this->generateKey($data['email']);

  	if($this->registerService->registerUser($data["username"], $data["email"], $data["password"], $securityKey))
  	{

      $this->sendUserMailRegister($data["username"], $data["email"], $securityKey);

  		header('Location: /login');
  	}
  	else
  	{
  		echo $this->template->render("register.html.php", ["username" => $data["username"],"email" => $data["email"]]);
  	}

  }

  public function showForgetPassword1()
  {
    echo $this->template->render("PasswordForgot/passwordforget1.html.php");
  }

  public function forgetPassword_Send($restKey, array $data)
  {
    //TODO Send Message for Password

    session_reset();

    if(!array_key_exists("userData", $data))
  	{
  		$this->showRegister();
  		return;
  	}

    $useData = $this->registerService->getPasswordSendDataFromUser($data["userData"]);

    if($useData != null)
    {

      //TODO Insert Password data

      $securityKey = $this->generateKey($useData['ID']);

      $this->registerService->setUserStatus($useData['EMail'], $securityKey);

      $this->sendUserMailPassword($useData['Username'], $useData['EMail'], $securityKey);

      echo $this->showForgetPassword1();

      echo "<center> Please Check your Mail </center>";
      return;
    }
    else
    {
      session_destroy();

      echo $this->showForgetPassword1();

      echo "<center>Unknown User</center>";
      return;
    }
  }

  public function forgetPassword_Verify(array $data)
  {
    //TODO Verify Message for Password
    session_reset();



  }


}
