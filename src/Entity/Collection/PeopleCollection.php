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
            FROM People p
                JOIN Cast c ON c.peopleId = p.id
            WHERE c.movieId = :id
SQL
        );
        $stmt->execute(["id"=>$movieId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, People::class);
    }

    public static function findAll():array{
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT *
            FROM People 
            ORDER BY name
SQL
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, People::class);
    }
}