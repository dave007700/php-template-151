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
    echo $this->template->render("homepage.html.php", [
      "taskbar" => $this->indexService->getTaskBar(),
      "Movies" => $this->indexService->getAllMovies(),
    ]);

    $products = []; //TODO <--- <---
    while($row = $stmt->fetchObject()) {
        $product = new Product();
        $product->setId($row->id);
        $products[] = $product;
    }

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

  public function createNewEntry(array $data)
  {
    if($this->indexService->GetRights() > 1)
    {
      if(!array_key_exists("Entry_Name", $data) OR !array_key_exists("Entry_Date", $data))
    	{
    		$this->showcreateNewEntry();
    		return;
    	}

      $this->indexService->createNewEntry(
        $data["Entry_Name"],
        $data["Entry_Content"],
        $data["Entry_Date"],
        $data["Entry_Trailer"],
        $this->indexService->uploadImageReturnName($data["Entry_Name"]),
        $data["Entry_Tags"],
        $data["Entry_PG"]
      );

      $this->homepage();

    }
    else
    {
      $this->getError404();
    }

  }

  public function showeditEntry($movieID)
  {
    if($this->indexService->GetRights() > 1)
    {
      $MovieData = $this->indexService->getMoveByID($movieID);

      if($MovieData !== null)
      {
        echo $this->template->render("editEntry.html.php", [
          "taskbar" => $this->indexService->getTaskBar(),
          "UserRights" => $this->indexService->GetRights(),
          "MovieData" => $MovieData
        ]);
        return;
      }
      else
      {
        $this->getError404();
      }

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
