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
  
  /**
   * @param ihrname\SimpleTemplateEngine
   */
  public function __construct(SimpleTemplateEngine $template, RegisterService $registerService)
  {
     $this->template = $template;
     $this->registerService = $registerService;
  }
  
  public function showRegister()
  {
  	echo $this->template->render("register.html.php");
  }
  
  public function register(array $data)
  {
  	if(!array_key_exists("email", $data) OR !array_key_exists("password", $data))
  	{
  		$this->showRegister();
  		return;
  	}
  	
  	
  	if($this->registerService->registerUser($data["email"], $data["password"]))
  	{
  		header('Location: /');
  	}
  	else
  	{
  		echo $this->template->render("register.html.php", ["email" => $data["email"]]);
  	}
  	
  	
  }
  
}
