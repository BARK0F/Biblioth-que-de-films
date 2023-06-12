<?php
declare(strict_types=1);


use Html\AppWebPage;
use Entity\Collection\MovieCollection;
use Entity\Collection\ImageCollection;
use Entity\Collection\PeopleCollection;


$webpage = new AppWebPage();
$webpage->setTitle("Films");

$imageCollection = new ImageCollection();
$movieCollection = new MovieCollection();
$movies = $movieCollection->findAll();

$content = "<div class='content'>";
$content .= "<ul class='list'>";


foreach ($movies as $movie) {
    $movieName = $webpage->escapeString($movie->getTitle());
    $content .= "<li class='list-item'>{$movieName}</li>";

    $image = $imageCollection->findById($movie->getPosterId());
    $content.= "<img src='image.php?imageId={$image->getId()}'>";
}


$content .= "</ul>";
$content .= "</div>";

$webpage->appendContent($content);

echo $webpage->toHtml();