<?php

namespace dave007700\Controller;

use dave007700\SimpleTemplateEngine;
use dave007700\Service\Register\RegisterService;

class LoginController 
{
  /**
   * @var ihrname\SimpleTemplateEngine Template engines to render output
   */
  private $template;
  
  private $RegisterService;
  
  /**
   * @param ihrname\SimpleTemplateEngine
   */
  public function __construct(SimpleTemplateEngine $template, LoginService $registerService)
  {
     $this->template = $template;
     $this->registerService = $RegisterService;
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
