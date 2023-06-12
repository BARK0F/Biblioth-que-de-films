<?php
declare(strict_types=1);

namespace Entity\Collection;
use Database\MyPdo;
use Entity\Image;

class ImageCollection{
    public static function findById(int $id):Image{
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT *
            FROM image 
            WHERE id = :id
SQL
        );
        $stmt->setFetchMode(MyPdo::FETCH_CLASS,Image::class);
        $stmt->execute(["id"=>$id]);
        return $stmt->fetch();
    }
}