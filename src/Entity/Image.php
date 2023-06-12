<?php
declare(strict_types=1);
namespace Entity;

class Image{
    public int $id;
    public string $jpeg;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getJpeg(): string
    {
        return $this->jpeg;
    }
}