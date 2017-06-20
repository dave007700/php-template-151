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

  public function greet($name) {
  	echo $this->template->render("hello.html.php", ["name" => $name]);
  }

  public function movieData($MovieID)
  {
    $MovieData = $this->indexService->getMoveByID($MovieID);

    if($MovieData !== null)
    {
      echo $this->template->render("movie.html.php", ["taskbar" => $this->indexService->getTaskBar(), "MovieData" => $this->indexService->getMoveByID($MovieID)]);
    }
    else
    {
      header('Location: /Error-404');
    }

  }
}
