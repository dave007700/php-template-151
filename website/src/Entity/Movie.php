<?php

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
  private $FK_Category;

  public function __construct()
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

  public function getID($ID)
  {
    return $ID;
  }

  public function getName($Name)
  {
    return $Name;
  }

  public function getContent($Content)
  {
    return $Content;
  }

  public function getRealesDate($RealesDate)
  {
    return $RealesDate;
  }

  public function getTrailerURL($TrailerURL)
  {
    return $TrailerURL;
  }

  public function getHasImage($HasImage)
  {
    return $HasImage;
  }

  public function getMoviePoster($MoviePoster)
  {
    return $MoviePoster;
  }

  public function getTags($Tags)
  {
    return $Tags;
  }

  public function getPG($PG)
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
