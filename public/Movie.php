<?php
declare(strict_types=1);

use Database\MyPdo;
use Entity\Collection\CastCollection;
use Entity\Movie;
use Html\AppWebPage;
use Entity\Collection\MovieCollection;
use Entity\Collection\ImageCollection;
use Entity\Collection\PeopleCollection;


if(isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $movieId=$_GET['id'];
} elseif(isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}


$webpage = new AppWebPage();
$imageCollection = new ImageCollection();
$PeopleCollection = new PeopleCollection();
$CastCollection = new CastCollection();


$stmt = MyPDO::getInstance()->prepare(
    <<<SQL
    SELECT *
    FROM movie
    WHERE id=:artistId
SQL
);

$stmt->setFetchMode(MyPdo::FETCH_CLASS,movie::class);
$stmt->execute(["artistId" => $movieId]);
$movie = $stmt->fetch();


$webpage->setTitle("{$movie->getTitle()}");


$content = "<div class='content'>";

$image = $imageCollection->findById($movie->getPosterId());
$content.= "<img class='poster' src='image.php?imageId={$image->getId()}'>";

$content.= "<div class = 'principal_content'>";

# Premiere ligne
$content.="<div class='firstLine'>";
$content.="<div class = 'title'>{$movie->getTitle()}</div>";
#$content.="<div class ='date'>{$movie->getReleasedate()}</div>";
$content.="</div>";

$content.="<div class='OriginalTitle'>{$movie->getOriginalTitle()}</div>";
$content.="<div class='Tagline'>{$movie->getTagline()}</div>";
$content.="<div class='resumer'>{$movie->getOverview()}</div>";

$content.="</div>";



# partie avec touts les acteurs d'un film

$peoples = $PeopleCollection->findByMovieId($movie->getId());

foreach ($peoples as $people) {
    $content .="<div class='acteur'>";
    $content .= "<a href='./people.php?peopleId={$people->getId()}'>
    <div class= 'image'><img src='image.php?imageId={$imageCollection->findById($movie->getPosterId())->getId()}'></div>";
    foreach ($CastCollection->findByMovieIdAndPeopleId($movie->getId(), $people->getId()) as $cast) {
        $content .= "<div class='role'>{$cast->getRole()}</div>";
    }
    $content .= "<div class='name'>{$people->getName()}</div></a>";
    $content .= "</div>";
}


$webpage->appendContent($content);
echo $webpage->toHtml();