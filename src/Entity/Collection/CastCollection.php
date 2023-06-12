<?php
declare(strict_types=1);

namespace Entity\Collection;
use Database\MyPdo;
use Entity\Cast;
use PDO;
class CastCollection
{
    public static function findByMovieIdAndPeopleId(int $movieId, int $peopleId): Cast
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
        SELECT m.*, c.role
        FROM movie m
        JOIN cast c ON m.id = c.movieId
        WHERE c.movieId = :movieId AND c.peopleId = :peopleId
SQL
        );
        $stmt->execute(["movieId" => $movieId, "peopleId" => $peopleId]);
        return $stmt->fetchObject(Cast::class);
    }
}