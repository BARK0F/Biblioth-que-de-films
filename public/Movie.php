<?php
declare(strict_types=1);

use Database\MyPdo;
use Entity\Collection\CastCollection;
use Entity\Movie;
use Html\AppWebPage;
use Entity\Collection\MovieCollection;
use Entity\Collection\ImageCollection;
use Entity\Collection\PeopleCollection;

# Les sécurités
$stmt = MyPdo::getInstance()->prepare(
    <<<SQL
            SELECT id
            FROM movie
SQL
);
$stmt->execute();
$movies = $stmt->fetchAll(PDO::FETCH_CLASS, movie::class);

$idMovies = array();

foreach ($movies as $movie){
    $idMovies[] = $movie->getId();
}

if(isset($_GET['id']) && in_array($_GET['id'],$idMovies)) {
    $movieId=$_GET['id'];
} else {
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
    WHERE id=:movieId
SQL
);

$stmt->setFetchMode(MyPdo::FETCH_CLASS,movie::class);
$stmt->execute(["movieId" => $movieId]);
$movie = $stmt->fetch();


$webpage->setTitle("{$movie->getTitle()}");


$content = "
<div class='dropdown'>
    <button class='dropbtn'>redirection</button>
    <div class='dropdown-content'>
      <a href='index.php'>Menu principal</a>
      <a href='form.php?action=create'>Création d'un nouveau film</a>
      <a href='form.php?action=delete&id={$movie->getId()}'>Supprimer le film actuel</a>
      <a href='form.php?action=edit&id={$movie->getId()}'>Modifier le film actuel</a>
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



$content .="<div class = 'principal_content'>";
if($movie->getPosterId() !== null){
    $image = $imageCollection->findById($movie->getPosterId());
    if ($image !== null){
        $content .= "<img src='image.php?imageId={$image->getId()}' alt='{$movie->getTitle()}'>";
    }
}else{
    $content .= "<img src='Image/movie_not_found.png' alt='{$movie->getTitle()}'>";
}



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