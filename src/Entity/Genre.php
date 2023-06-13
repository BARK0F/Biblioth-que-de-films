<?php
declare(strict_types=1);

namespace Entity;

class Genre
{
    private int $id;
    private string $name;

    /** Ce getter renvoie l'id du genre
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /** Ce getter renvoie le nom du genre
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}