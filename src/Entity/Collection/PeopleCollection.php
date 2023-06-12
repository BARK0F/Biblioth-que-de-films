<?php
declare(strict_types=1);

namespace Entity\Collection;
use Database\MyPdo;
use Entity\People;
use PDO;

class PeopleCollection{
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