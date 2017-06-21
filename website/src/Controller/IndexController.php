<?php

namespace dave007700\Controller;

use dave007700\SimpleTemplateEngine;
use dave007700\Service\Index\IndexService;

class IndexController
{
  /**
   * @var ihrname\SimpleTemplateEngine Template engines to render output
   */
  private $template;
  private $IndexService;

  /**
   * @param ihrname\SimpleTemplateEngine
   */
  public function __construct(SimpleTemplateEngine $template, IndexService $indexService)
  {
     $this->template = $template;
     $this->indexService = $indexService;
  }

  public function homepage() {
    echo $this->template->render("homepage.html.php", ["taskbar" => $this->indexService->getTaskBar(), "Movies" => $this->indexService->getAllMovies()]);
  }

  public function getError404(){
    echo $this->template->render("error404.html.php", ["taskbar" => $this->indexService->getTaskBar()]);
  }

  public function showcreateNewEntry(){
    if($this->indexService->GetRights() > 1)
    {
      echo $this->template->render("createEntry.html.php", [
        "taskbar" => $this->indexService->getTaskBar(),
        "UserRights" => $this->indexService->GetRights()
      ]);
    }
    else
    {
      $this->getError404();
    }
  }

  public function greet($name) {
  	echo $this->template->render("hello.html.php", ["name" => $name]);
  }

  public function movieData($MovieID)
  {
    $MovieData = $this->indexService->getMoveByID($MovieID);

    if($MovieData !== null)
    {
      echo $this->template->render("movie.html.php", [
        "taskbar" => $this->indexService->getTaskBar(),
        "MovieData" => $MovieData,
        "Username" => $this->indexService->GetUsername(),
        "UserRights" => $this->indexService->GetRights()
      ]);
    }
    else
    {
      header('Location: /Error-404');
    }

  }

  public function ActivateUser($securityKey)
  {
    if($this->indexService->tryActivate($securityKey))
    {
      echo $this->template->render("activate.html.php", ["taskbar" => $this->indexService->getTaskBar()]);
    }
    else
    {
      $this->getError404();
    }
  }

}
