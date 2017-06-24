<?php

namespace dave007700\Entity;

class Movie
{
  private $ID;
  private $Name;
  private $Content;
  private $RealesDate;
  private $TrailerURL;
  private $HasImage;
  private $MoviePoster;
  private $Tags;
  private $PG;

  public function __construct($ID, $Name, $Content, $RealesDate, $TrailerURL, $HasImage, $MoviePoster, $Tags, $PG)
  {
    $this->$ID = $ID;
    $this->$Name = $Name;
    $this->$Content = $Content;
    $this->$RealesDate = $RealesDate;
    $this->$TrailerURL = $TrailerURL;
    $this->$HasImage = $HasImage;
    $this->$MoviePoster = $MoviePoster;
    $this->$Tags = $Tags;
    $this->$PG = $PG;
  }

  public function getID()
  {
    return $ID;
  }

  public function getName()
  {
    return $Name;
  }

  public function getContent()
  {
    return $Content;
  }

  public function getRealesDate()
  {
    return $RealesDate;
  }

  public function getTrailerURL()
  {
    return $TrailerURL;
  }

  public function getHasImage()
  {
    return $HasImage;
  }

  public function getMoviePoster()
  {
    return $MoviePoster;
  }

  public function getTags()
  {
    return $Tags;
  }

  public function getPG()
  {
    return $PG;
  }



  public function setID($ID)
  {
    $this->$ID = $ID;
  }

  public function setName($Name)
  {
    $this->$Name = $Name;
  }

  public function setContent($Content)
  {
    $this->$Content = $Content;
  }

  public function setRealesDate($RealesDate)
  {
    $this->$RealesDate = $RealesDate;
  }

  public function setTrailerURL($TrailerURL)
  {
    $this->$TrailerURL = $TrailerURL;
  }

  public function setHasImage($HasImage)
  {
    $this->$HasImage = $HasImage;
  }

  public function setMoviePoster($MoviePoster)
  {
    $this->$MoviePoster = $MoviePoster;
  }

  public function setTags($Tags)
  {
    $this->$Tags = $Tags;
  }

  public function setPG($PG)
  {
    $this->$PG = $PG;
  }


}
