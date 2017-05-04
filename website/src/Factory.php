<?php 

namespace dave007700;

class Factory
{
	private $config;
	public function __construct(array $config)
	{
		$this->config = $config;
	}
	
	public function getTemplateEngine()
	{
		return new SimpleTemplateEngine(__DIR__ . "/../templates/");
	}
	
	public function getIndexController()
	{
		return new Controller\IndexController($this->getTemplateEngine());
	}
	
	public function getLoginController()
	{
		return new Controller\LoginController($this->getTemplateEngine(), $this->getLoginService());
	}

	public function getPdo()
	{
		return new \PDO(
		
				"mysql:host=mariadb;dbname=app;charset=utf8",
				$this->config['database']['user'],
				"my-secret-pw",
				[\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
		
				);
	}
	
	public function getLoginService()
	{
		return new Service\Login\LoginPDOService($this->getPdo());
	}
}