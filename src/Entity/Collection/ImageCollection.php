<?php
declare(strict_types=1);

namespace Entity\Collection;
use Database\MyPdo;
use Entity\Image;
use PDO;

class ImageCollection{
    public static function findByMovieId(int $id):array{
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT i.*
            FROM Image i
                JOIN Movie m ON m.posterId = i.id
            WHERE m.id = :id
SQL
        );
        $stmt->execute(["id"=>$id]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Image::class);
    }
}