<?php
declare(strict_types=1);

namespace Entity\Collection;
use Database\MyPdo;
use Entity\People;
use PDO;

class PeopleCollection{
    /** Cette fonction permet de trouver toutes les personnes qui ont joué un rôle dans un film spécifique.
     * @param int $movieId L'id du film.
     * @return array toutes les personnes ayant un rôle dans le film
     */
    public static function findByMovieId (int $movieId):array{
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT p.*
            FROM people p
                JOIN cast c ON c.peopleId = p.id
            WHERE c.movieId = :id
SQL
        );
        $stmt->execute(["id"=>$movieId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, people::class);
    }

    /** Cette fonction permet de trouver toutes les personnes disponibles dans la base de données.
     * @return array Toutes les personnes.
     */
    public static function findAll():array{
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT *
            FROM people 
            ORDER BY name
SQL
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, people::class);
    }

    /** Cette fonction permet de trouver une personne en fonction de son ID.
     * @param int $id Son id.
     * @return People La personne.
     */
    public static function findById(int $id) : people {
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
        SELECT *
        FROM people
        WHERE id = :id
SQL
        );
        $stmt->setFetchMode(MyPdo::FETCH_CLASS,people::class);
        $stmt->execute(["id" => $id]);
        return $stmt->fetch();
    }
}