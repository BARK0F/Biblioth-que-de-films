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
        SELECT c.*
        FROM movie m
        JOIN cast c ON m.id = c.movieId
        WHERE c.movieId = :movieId AND c.peopleId = :peopleId
SQL
        );
        $stmt->setFetchMode(MyPdo::FETCH_CLASS,cast::class);
        $stmt->execute(["movieId" => $movieId, "peopleId" => $peopleId]);
        return $stmt->fetch();
    }
}