<?php
declare(strict_types=1);

use Database\MyPdo;
use Entity\Collection\CastCollection;
use Entity\Movie;
use Html\AppWebPage;
use Entity\Collection\MovieCollection;
use Entity\Collection\ImageCollection;
use Entity\Collection\PeopleCollection;

if(isset($_GET['peopleId']) && ctype_digit($_GET['peopleId'])) {
    $peopleId=$_GET['peopleId'];
} elseif(isset($_GET['peopleId'])) {
    header('Location: index.php');
    exit();
}

$webpage = new AppWebPage();
$PeopleCollection = new PeopleCollection();
$movieCollection = new MovieCollection();
$imageCollection = new ImageCollection();
$CastCollection = new CastCollection();

$actor = $PeopleCollection->findById(intval($peopleId));

$content = "<div class='principal_content'>";
if ($actor->getAvatarId() !== null){
    $content .="<img src='image.php?imageId={$actor->getAvatarId()}'>";
}else{
    $content .="<img src='Image/people_not_found.png' alt='dere'>";
}
$content .= "</div>";


$movies = $movieCollection->findByPeopleId($actor->getId());

foreach ($movies as $movie){
    $image = $imageCollection->findById($movie->getPosterId());
    $content .="<a href='Movie.php?id={$movie->getId()}";
    $content .= "<div class='film'>";
    if ($image !== null){
        $content.= "<img class='poster_film' src='image.php?imageId={$image->getId()}'>";
    }else{
        $content .= "<img class='poster_film' src='Image/movie_not_found.png' alt='{$movie->getName()}'>";
    }
    $content.= "<div class='ligne1'>";
    $content.= "<div class='titre'>{$movie->getTitle()}</div>";
    #$content.= "<div class='date'>{$movie->getReleasedate()}</div>";
    $content.="</div>";

    $cast = $CastCollection->findByMovieIdAndPeopleId($movie->getId(), $actor->getId());
    $content .= "<div class='role'>{$cast->getRole()}</div>";
    $content.="</a></div>";
}

$webpage->appendContent($content);
echo $webpage->toHtml();