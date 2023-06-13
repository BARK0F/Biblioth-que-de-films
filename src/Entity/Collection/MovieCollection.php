<?php
declare(strict_types=1);

namespace Entity\Collection;
use Database\MyPdo;
use Entity\Movie;
use PDO;

class MovieCollection{
    /** Cette fonction permet de trouver tous les films disponibles dans la base de données.
     * @return array Les films triés par titre
     */
    public static function findAll():array{
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT m.*
            FROM movie m
            ORDER BY m.title
SQL
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, movie::class);
    }

    /** Cette fonction permet de trouver tous les films dans lesquels une personne spécifique a joué un rôle.
     * @param int $peopleId L'id de la personne
     * @return array Tout les films et son rôle dans le film.
     */
    public static function findByPeopleId(int $peopleId): array{
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT m.*, c.role
            FROM movie m
                JOIN cast c ON m.id = c.movieId
            WHERE c.peopleId = :id
            ORDER BY m.title
SQL
        );
        $stmt->execute(["id"=>$peopleId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, movie::class);
    }
}