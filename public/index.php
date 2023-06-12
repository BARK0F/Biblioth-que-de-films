<?php
declare(strict_types=1);


use Html\AppWebPage;
use Entity\Collection\MovieCollection;


$webpage = new AppWebPage();
$webpage->setTitle("Films");


$movieCollection = new MovieCollection();
$movies = $movieCollection->findAll();

$content = "<div class='content'>";
$content .= "<ul class='list'>";
foreach ($movies as $movie) {
    $movieName = $webpage->escapeString($movie->getOriginalTitle());
    $content .= "<li class='list-item'>{$movieName}</li>";
}
$content .= "</ul>";
$content .= "</div>";

$webpage->appendContent($content);

echo $webpage->toHtml();