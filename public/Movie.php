<?php
declare(strict_types=1);

use Database\MyPdo;
use Entity\Collection\CastCollection;
use Entity\Movie;
use Html\AppWebPage;
use Entity\Collection\MovieCollection;
use Entity\Collection\ImageCollection;
use Entity\Collection\PeopleCollection;


if(isset($_GET['id'])) {
    $movieId=$_GET['id'];
} elseif(isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}


$webpage = new AppWebPage();
$imageCollection = new ImageCollection();
$PeopleCollection = new PeopleCollection();
$CastCollection = new CastCollection();
$webpage->appendCssUrl("css/movie.css");


# récuperer le film : movie
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



$image = $imageCollection->findById($movie->getPosterId());


$content ="<div class = 'principal_content'>";
$content.="<img class='poster' src='image.php?imageId={$image->getId()}'>";
$content.="<div class='movie_info'>";
# Premiere ligne
$content.="<div class='firstLine'>";
$content.="<div class = 'title'>{$movie->getTitle()}</div>";

$content.="<div class ='date'>{$movie->getReleasedate()}</div>";

$content.="</div>";

$content.="<div class='OriginalTitle'>{$movie->getOriginalTitle()}</div>";
$content.="<div class='Tagline'>{$movie->getTagline()}</div>";
$content.="<div class='resumer'>{$movie->getOverview()}</div>";
$content.="</div>";
$content.="</div>";



# partie avec touts les acteurs d'un film

$peoples = $PeopleCollection->findByMovieId($movie->getId());

foreach ($peoples as $people) {
    $content .="<div class='acteur'>";
    $content .= "<a href='./people.php?peopleId={$people->getId()}'>";
    $content .="<div class= 'image'>";
    if ($people->getAvatarId() !== null){
        $content .="<img src='image.php?imageId={$people->getAvatarId()}'>";
    }else{
        $content .="<img src='Image/people_not_found.png' alt='dere'>";
    }
    $content.="</div>";

    $cast = $CastCollection->findByMovieIdAndPeopleId($movie->getId(), $people->getId());
    $content .= "<div class='actor_info'>";
    $content .= "<div class='role'>{$cast->getRole()}</div>";
    $content .= "<div class='name'>{$people->getName()}</div></a>";
    $content .= "</div>";
    $content .= "</div>";
}


$webpage->appendContent($content);
echo $webpage->toHtml();