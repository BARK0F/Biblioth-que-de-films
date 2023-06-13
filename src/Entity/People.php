<?php
declare(strict_types=1);

namespace Entity;

class People
{
    private int $id;
    private ?int $avatarId;
    private ?string $birthday;
    private ?string $deathday;
    private string $name;
    private string $biography;
    private string $placeOfBirth;

    /** Ce getter renvoie l'id de l'acteur
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /** Ce getter renvoie la date de naissance de l'acteur
     * @return string
     */
    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    /** Ce getter renvoie la date de mort de l'acteur
     * @return string
     */
    public function getDeathday(): ?string
    {
        return $this->deathday;
    }

    /** Ce getter renvoie le nom de l'acteur
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /** Ce getter renvoie la biographie de l'acteur
     * @return string
     */
    public function getBiography(): string
    {
        return $this->biography;
    }

    /** Ce getter renvoie le lieu de naissance de l'acteur
     * @return string
     */
    public function getPlaceOfBirth(): string
    {
        return $this->placeOfBirth;
    }


    /** Ce getter renvoie l'id de l'avatar de l'acteur
     * @return int
     */
    public function getAvatarId(): ?int
    {
        return $this->avatarId;
    }
}