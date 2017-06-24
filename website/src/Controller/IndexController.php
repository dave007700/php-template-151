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
      "Movies" => $this->indexService->getAllMovies()
    ]);

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
        //$this->indexService->uploadImageReturnStatus($data["Entry_Name"]),
        $data["Entry_Tags"],
        $data["Entry_PG"]
      );

      header('location: /');

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
          "MovieData" => $MovieData,
          "MoviePosterURL" => $this->indexService->getRealPoserURL($MovieData['ID'], $MovieData['HasImage'])
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

  public function showMovieData($MovieID)
  {
    $MovieData = $this->indexService->getMoveByID($MovieID);
    $Comments = $this->indexService->getCommentsFromMovie($MovieID);

    if($MovieData !== null)
    {
      echo $this->template->render("movie.html.php", [
        "taskbar" => $this->indexService->getTaskBar(),
        "MovieData" => $MovieData,
        "Comments" => $Comments,
        "Username" => $this->indexService->GetUsername(),
        "UserRights" => $this->indexService->GetRights(),
        "MyUserID" => $this->indexService->GetUserID(),
        "MoviePosterURL" => $this->indexService->getRealPoserURL($MovieData["ID"], $MovieData["HasImage"])
      ]);
    }
    else
    {
      header('Location: /Error-404');
    }

  }

  public function updateMovieData($movieID, array $data)
  {

    if($this->indexService->GetRights() > 0)
    {
      if($this->indexService->existsMovieByID($movieID))
      {
        if(
          !array_key_exists("Entry_Name", $data)
            OR
          !array_key_exists("Entry_Content", $data)
            OR
          !array_key_exists("Entry_Date", $data)
            OR
          !array_key_exists("Entry_Trailer", $data)
            OR
          !array_key_exists("Entry_Tags", $data)
            OR
          !array_key_exists("Entry_PG", $data)
            OR
          !array_key_exists("Entry_UseImage", $data)
          )
      	{
      		header('Location: /Edit-Movie='.$movieID);
      		return;
      	}

        $this->indexService->updateMovieData
        (
          $movieID,
          $data["Entry_UseImage"],
          $data["Entry_Content"],
          $data["Entry_Date"],
          $data["Entry_Trailer"],
          $data["Entry_Tags"],
          $data["Entry_PG"]
        );

        header('Location: /movie='. $movieID);
        return;


      }
      else
      {
        header('Location: /Error-404');
        return;
      }
    }
    else
    {
      header('Location: /Error-404');
      return;
    }

  }

  public function createComment($movieID, array $data)
  {
    if($this->indexService->GetRights() > 0)
    {
      if($this->indexService->existsMovieByID($movieID))
      {
        if(!array_key_exists("commentWriteTitel", $data) OR !array_key_exists("commentWriteContent", $data))
      	{
      		$this->showMovieData($movieID);
      		return;
      	}

        if($data["commentWriteTitel"] != "" && $data["commentWriteContent"] != "")
        {
          $this->indexService->createComment($movieID, $data["commentWriteTitel"], $data["commentWriteContent"]);
          header('Location: /movie='. $movieID);
        }
        else
        {
          $this->showMovieData($movieID);
        }
      }
      else
      {
        $this->getError404();
        return;
      }
    }
    else
    {
      $this->showMovieData($movieID);
      return;
    }
  }

  public function deleteComment($commentID)
  {

    $userID = $this->indexService->GetUserID();

    if($this->indexService->GetRights() > 0)
    {
      if($this->indexService->checkIfUserComment($commentID, $userID))
      {
        $this->indexService->deleteComment($commentID, $userID);
        $this->homepage();
      }
      else
      {
        header('Location: /Error-404');
      }
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
