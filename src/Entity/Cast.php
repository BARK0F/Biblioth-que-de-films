<?php
declare(strict_types=1);
namespace Entity;

class Cast{
    private int $id;
    private int $movieid;
    private int $peopleId;
    private string $role;
    private int $orderIndex;

    /** Ce getter renvoie l'id du casting
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /** Ce getter renvoie le movieId (l'id du film) du casting
     * @return int
     */
    public function getMovieid(): int
    {
        return $this->movieid;
    }

    /** Ce getter renvoie le peopleId (l'id de l'acteur) du casting
     * @return int
     */
    public function getPeopleId(): int
    {
        return $this->peopleId;
    }

    /** Ce getter renvoie le rôle du casting
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /** Ce getter renvoie l'OrderIndex du casting
     * @return int
     */
    public function getOrderIndex(): int
    {
        return $this->orderIndex;
    }
}