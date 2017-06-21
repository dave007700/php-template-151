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

  private function sendUserMail($username, $email, $securityKey)
  {
    $message = (new \Swift_Message('Registrierung'))
                ->setFrom(['security@losdostacos.com' => 'noreply'])
                ->setTo([$email])
                ->setBody("Welcome " . $username . "!!! Open this link to activate your account: https://localhost/activate=" . $securityKey);

                $this->mailer->send($message);
  }

  public function register(array $data)
  {
  	if(!array_key_exists("username", $data) OR !array_key_exists("email", $data) OR !array_key_exists("password", $data))
  	{
  		$this->showRegister();
  		return;
  	}

    $securityKey = sha1(mt_rand(10000,99999).time().$data["email"]);

  	if($this->registerService->registerUser($data["username"], $data["email"], $data["password"], $securityKey))
  	{

      $this->sendUserMail($data["username"], $data["email"], $securityKey);

  		header('Location: /login');
  	}
  	else
  	{
  		echo $this->template->render("register.html.php", ["username" => $data["username"],"email" => $data["email"]]);
  	}


  }


}
