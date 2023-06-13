<?php
declare(strict_types=1);


use Html\AppWebPage;
use Entity\Collection\MovieCollection;
use Entity\Collection\ImageCollection;
use Entity\Collection\PeopleCollection;


$webpage = new AppWebPage();
$webpage->setTitle("Films");
$webpage->appendCssUrl("css/index.css");

$imageCollection = new ImageCollection();
$movieCollection = new MovieCollection();
$movies = $movieCollection->findAll();

$content = "
<div class='dropdown'>
    <button class='dropbtn'>redirection</button>
    <div class='dropdown-content'>
      <a href='form.php?action=create'>Menu de création</a>
    </div>
  </div>
";

$webpage->appendCss("
.dropdown {
      position: relative;
      display: inline-block;
    }
    
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 120px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }
    
    .dropdown:hover .dropdown-content {
      display: block;
    }
    
    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }
    
    .dropdown-content a:hover {
      background-color: #f1f1f1;
    }
");
$content .= "<ul class='list'>";


foreach ($movies as $movie) {

    $movieName = $webpage->escapeString($movie->getTitle());

    $content .= "<li class='list-item'>";
    $content .= "<a href='Movie.php?id={$movie->getId()}'>";
    $content .= "<div class='movie-item'>";
    if($movie->getPosterId() !== null){
        $image = $imageCollection->findById($movie->getPosterId());
        if ($image !== null){
            $content .= "<img src='image.php?imageId={$image->getId()}' alt='{$movieName}'>";
        }
    }else{
        $content .= "<img src='Image/movie_not_found.png' alt='{$movieName}'>";
    }

    $content .= "<div class='movie-title'>{$movieName}</div>";
    $content .= "</div>";
    $content .= "</a>";
    $content .= "</li>";
}


$content .= "</ul>";
$content .= "</div>";

$webpage->appendContent($content);

echo $webpage->toHtml();