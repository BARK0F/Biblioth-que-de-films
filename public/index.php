<?php
declare(strict_types=1);


use Entity\Collection\GenreCollection;
use Html\AppWebPage;
use Entity\Collection\MovieCollection;
use Entity\Collection\ImageCollection;
use Entity\Collection\PeopleCollection;


$webpage = new AppWebPage();
$webpage->setTitle("Films");
$webpage->appendCssUrl("css/index.css");

$imageCollection = new ImageCollection();
$movieCollection = new MovieCollection();
$genreCollection = new GenreCollection();


$content = "
<div class='dropdown'>
    <button class='dropbtn'>Redirection</button>
    <div class='dropdown-content'>
      <a href='form.php?action=create'>Création d'un nouveau film</a>
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

$content .= "
<div class='dropdown'>
    <button class='dropbtn'>Genres</button>
    <div class='dropdown-content'>
    <form>";
$genres = $genreCollection->findAll();

foreach ($genres as $genre) {
    $content .="<input type='checkbox' name='genres[]' value='{$genre->getName()}'>{$genre->getName()}<br>";
}

$content .="
            <input type='submit' value='Submit'>
        </form>
    </div>
  </div>
";
$content .= "
<div class='dropdown'>
    <button id='mode-toggle'>Light Mode</button>

</div>
";
$content .= "<ul class='list'>";

$selectGenres = $_GET['genres'] ?? [];
$filterMovie = array();
$listeAntiDoublons=array();
if (!empty($selectGenres)){
    foreach ($selectGenres as $selectGenre){
        $movies = $movieCollection->findByGenreName($selectGenre);
        foreach ($movies as $movie){
            if (!in_array($movie,$filterMovie)){
                $filterMovie[] =$movie;
            }
        }
    }
}else{
    $filterMovie = $movieCollection->findAll();
}
foreach ($filterMovie as $movie) {

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

$webpage->appendJsUrl("JavaScript/Light_Dark_mode.js");

echo $webpage->toHtml();