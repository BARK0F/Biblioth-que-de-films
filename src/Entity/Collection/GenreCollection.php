<?php
declare(strict_types=1);

namespace Entity\Collection;
use Database\MyPdo;
use Entity\Genre;
use PDO;
class GenreCollection
{
    /** Cette fonction permet de trouver tous les genres d'un film en fonction de son ID.
     * @param int $movieId L'id du film voulue
     * @return array tout les genre du film
     */
    public static function findByMovieId (int $movieId):array{
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT g.*
            FROM genre g
                JOIN movie_genre mg ON mg.genreId = g.id
            WHERE mg.movieId = :id
SQL
        );
        $stmt->execute(["id"=>$movieId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, genre::class);
    }

    /** Cette fonction permet de trouver tous les genres de films disponibles dans la base de données, en les renvoyant sous forme de tableau.
     * @return array Touts les genres
     */
    public static function findAll():array{
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT *
            FROM genre 
            ORDER BY name
SQL
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, genre::class);
    }
}