<?php
declare(strict_types=1);

namespace Entity\Collection;
use Database\MyPdo;
use Entity\Movie;
use PDO;

class MovieCollection{
    public static function findAll():array{
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT m.*
            FROM movie m
            ORDER BY m.title
SQL
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, Movie::class);
    }

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
        return $stmt->fetchAll(PDO::FETCH_CLASS, Movie::class);
    }
}