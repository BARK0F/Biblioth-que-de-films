<?php
declare(strict_types=1);
use Database\MyPdo;
use Entity\Movie;
use Html\AppWebPage;


$webpage = new AppWebPage();



$content = "
<div class='dropdown'>
    <button class='dropbtn'>redirection</button>
    <div class='dropdown-content'>
      <a href='index.php'>Menu principal</a>
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

# Les sécurités
if (isset($_GET['id'])){
    $stmt = MyPdo::getInstance()->prepare(
        <<<SQL
                SELECT id
                FROM movie
    SQL
    );
    $stmt->execute();
    $movies = $stmt->fetchAll(PDO::FETCH_CLASS, movie::class);

    $idMovie = array();

    foreach ($movies as $movie) {
        $idMovie[] = $movie->getId();
    }

    if (ctype_digit($_GET['id']) && in_array($_GET['id'], $idMovie)) {
        $movieId = $_GET['id'];
    } else {
        header('Location: index.php');
        exit();
    }
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    # Création d'un nouveau film
    if ($action === 'create') {
        $content .= "
        <form>
            <label for='title'>Title:</label>
            <input type='text' name='title' id='title' required>
            <br>
            
            <label for='release_date'>Release Date:</label>
            <input type='date' name='release_date' id='release_date' required>
            <br>
            
            <label for='overview'>Overview:</label>
            <textarea name='overview' id='overview' rows='4' required></textarea>
            <br>
            
            <label for='originalTitle'>originalTitle:</label>
            <textarea name='originalTitle' id='originalTitle' rows='4' required></textarea>
            <br>
            
            <label for='originalLanguage'>originalLanguage:</label>
            <textarea name='originalLanguage' id='originalLanguage' rows='4' required></textarea>
            <br>
            
            <label for='runtime'>runtime:</label>
            <input type='number' name='runtime' id='runtime' required>
            <br>
            
            <label for='tagline'>tagline:</label>
            <textarea name='tagline' id='tagline' rows='4' required></textarea>
            <br>
            
            <input type='submit' value='Submit'>
        </form>";
    }

    // Édition du film actuel
    elseif ($action === 'edit') {
        $content .= "
        <form>
            <label for='mod_title'>Title:</label>
            <input type='text' name='mod_title' id='mod_title' >
            <br>
            
            <label for='mod_release_date'>Release Date:</label>
            <input type='date' name='mod_release_date' id='mod_release_date' >
            <br>
            
            <label for='mod_overview'>Overview:</label>
            <textarea name='mod_overview' id='mod_overview' rows='4' ></textarea>
            <br>
            
            <label for='mod_originalTitle'>originalTitle:</label>
            <textarea name='mod_originalTitle' id='mod_originalTitle' rows='4' ></textarea>
            <br>
            
            <label for='mod_originalLanguage'>originalLanguage:</label>
            <textarea name='mod_originalLanguage' id='mod_originalLanguage' rows='4' ></textarea>
            <br>
            
            <label for='mod_runtime'>runtime:</label>
            <input type='number' name='mod_runtime' id='mod_runtime' >
            <br>
            
            <label for='mod_tagline'>tagline:</label>
            <textarea name='mod_tagline' id='mod_tagline' rows='4' ></textarea>
            <br>
            
            <label for='mod_id'>Id:</label>
            <input type='number' name='mod_id' id='mod_id' value='{$movieId}' readonly>
            <br>
            
            <input type='submit' value='Submit'>
        </form>
        ";
    }

    // Suppression du film actuel
    elseif ($action === 'delete') {
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            DELETE c
            FROM cast c
                JOIN movie m ON m.id = c.movieId
            WHERE c.movieId = :id
SQL
        );
        $stmt->execute(["id"=>$movieId]);

        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            DELETE 
            FROM movie 
            WHERE id = :id
SQL
        );
        $stmt->execute(["id"=>$movieId]);
        header('Location: index.php');
        exit();
    }
}
if (isset($_GET['title'])) {
    $title = $webpage->escapeString($_GET['title']);
    $release_date = $_GET['release_date'];
    $overview = $webpage->escapeString($_GET['overview']);
    $originalTitle = $webpage->escapeString($_GET['originalTitle']);
    $originalLanguage = $webpage->escapeString($_GET['originalLanguage']);
    $runtime = $_GET['runtime'];
    $tagLine = $webpage->escapeString($_GET['tagline']);
    $id=  MyPdo::getInstance()->lastInsertId();

    $stmt = MyPdo::getInstance()->prepare(
        <<<SQL
            INSERT INTO movie (id,originalLanguage,originalTitle,overview,releaseDate,runtime,tagline,title)
            VALUES (:id,:originalLanguage,:originalTitle,:overview,:releaseDate,:runtime,:tagline,:title)
SQL
    );
    $stmt->execute(["id"=>$id,"originalLanguage"=>$originalLanguage,"originalTitle"=>$originalTitle,"overview"=>$overview,"releaseDate"=>$release_date,"runtime"=>$runtime,"tagline"=>$tagLine,"title"=>$title]);

    $webpage->appendContent($content);
    echo $webpage->toHtml();
    header("Location: Movie.php?id={$id}");
    exit();
}

if (isset($_GET['mod_title'])){
    $id = $_GET['mod_id'];
    $mod_title = $webpage->escapeString($_GET['mod_title']);
    $mod_release_date = $_GET['mod_release_date'];
    $mod_overview = $webpage->escapeString($_GET['mod_overview']);
    $mod_originalTitle = $webpage->escapeString($_GET['mod_originalTitle']);
    $mod_originalLanguage = $webpage->escapeString($_GET['mod_originalLanguage']);
    $mod_runtime = intval($_GET['mod_runtime']);
    $mod_tagLine = $webpage->escapeString($_GET['mod_tagline']);

    if (!empty($mod_title)){
        $stmt = MyPDO::getInstance()->prepare(
            <<<SQL
            UPDATE movie
            SET title=:title
            WHERE id=:id
SQL
        );
        $stmt->execute(["id" => $id,"title"=>$mod_title]);
    }
    if (!empty($mod_release_date)){
        $stmt = MyPDO::getInstance()->prepare(
            <<<SQL
            UPDATE movie
            SET releaseDate=:release_date
            WHERE id=:id
SQL
        );
        $stmt->execute(["id" => $id,"release_date"=>$mod_release_date]);
    }
    if (!empty($mod_overview)){
        $stmt = MyPDO::getInstance()->prepare(
            <<<SQL
            UPDATE movie
            SET overview=:overview
            WHERE id=:id
SQL
        );
        $stmt->execute(["id" => $id,"overview"=>$mod_overview]);
    }
    if (!empty($mod_originalTitle)){
        $stmt = MyPDO::getInstance()->prepare(
            <<<SQL
            UPDATE movie
            SET originalTitle=:originalTitle
            WHERE id=:id
SQL
        );
        $stmt->execute(["id" => $id,"originalTitle"=>$mod_originalTitle]);
    }
    if (!empty($mod_originalLanguage)){
        $stmt = MyPDO::getInstance()->prepare(
            <<<SQL
            UPDATE movie
            SET originalLanguage=:originalLanguage
            WHERE id=:id
SQL
        );
        $stmt->execute(["id" => $id,"originalLanguage"=>$mod_originalLanguage]);
    }
    if (!empty($mod_runtime)){
        $stmt = MyPDO::getInstance()->prepare(
            <<<SQL
            UPDATE movie
            SET runtime=:runtime
            WHERE id=:id
SQL
        );
        $stmt->execute(["id" => $id,"runtime"=>$mod_runtime]);
    }
    if (!empty($mod_tagLine)){
        $stmt = MyPDO::getInstance()->prepare(
            <<<SQL
            UPDATE movie
            SET tagline=:tagline
            WHERE id=:id
SQL
        );
        $stmt->execute(["id" => $id,"tagline"=>$mod_tagLine]);
    }

    $content.="Le film a bien été modifier";
    $webpage->appendContent($content);
    echo $webpage->toHtml();
    sleep(3);
    header('Location: Movie.php?id='.$id);
    exit();
}
$webpage->appendContent($content);
echo $webpage->toHtml();

