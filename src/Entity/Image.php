<?php
declare(strict_types=1);
namespace Entity;

class Image{
    private int $id;
    private string $jpeg;

    /** Ce getter renvoie l'id de l'image
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /** Ce getter renvoie le Jpeg de l'image
     * @return string
     */
    public function getJpeg(): string
    {
        return $this->jpeg;
    }
}