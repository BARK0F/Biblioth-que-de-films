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

$content = "<div class='content'>";
$content .= "<ul class='list'>";


foreach ($movies as $movie) {
    $image = $imageCollection->findById($movie->getPosterId());
    $movieName = $webpage->escapeString($movie->getTitle());

    $content .= "<li class='list-item'>";
    $content .= "<a href='Movie.php?id={$movie->getId()}'>";
    $content .= "<div class='movie-item'>";
    if ($image !== null){
        $content .= "<img src='image.php?imageId={$image->getId()}' alt='{$movieName}'>";
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