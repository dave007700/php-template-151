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
		return new Controller\IndexController($this->getTemplateEngine(), $this->getIndexService());
	}

	public function getLoginController()
	{
		return new Controller\LoginController($this->getTemplateEngine(), $this->getLoginService());
	}

	public function getRegisterController()
	{
		return new Controller\RegisterController($this->getTemplateEngine(), $this->getRegisterService(), $this->getMailer());
	}

	public function getMailer()
    {
        return \Swift_Mailer::newInstance(
                \Swift_SmtpTransport::newInstance($this->config['mailer']['host'], $this->config['mailer']['port'], $this->config['mailer']['security'])
                ->setUsername($this->config['mailer']['user'])
                ->setPassword($this->config['mailer']['password'])
                );
    }

	public function getPdo()
	{
		return new \PDO(

				"mysql:host=mariadb;dbname=filmreviewdb;charset=utf8",
				$this->config['database']['user'],
				"my-secret-pw",
				[\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]

				);
	}

	public function getLoginService()
	{
		return new Service\Login\LoginPDOService($this->getPdo());
	}

	public function getRegisterService()
	{
		return new Service\Register\RegisterPDOService($this->getPdo());
	}

	public function getIndexService()
	{
		return new Service\Index\IndexPDOService($this->getPdo());
	}
}
