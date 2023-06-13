<?php
declare(strict_types=1);
namespace Entity;

class Movie{
    private int $id;
    private ?int $posterId;
    private string $originalLanguage;
    private string $originalTitle;
    private string $overview;
    private string $releaseDate;
    private int $runtime;
    private string $tagline;
    private string $title;

    /** Ce getter renvoie l'id du Film
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /** Ce getter renvoie la langue original du Film
     * @return string
     */
    public function getOriginalLanguage(): string
    {
        return $this->originalLanguage;
    }

    /** Ce getter renvoie le titre original du Film
     * @return string
     */
    public function getOriginalTitle(): string
    {
        return $this->originalTitle;
    }

    /** Ce getter renvoie le résumer du Film
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
    }
    /** Ce getter renvoie la date de publication du Film
     * @return string
     */
    public function getReleasedate(): string
    {
        return $this->releaseDate;
    }

    /** Ce getter renvoie la durée du Film
     * @return int
     */
    public function getRuntime(): int
    {
        return $this->runtime;
    }

    /** Ce getter renvoie le slogan du Film
     * @return string
     */
    public function getTagline(): string
    {
        return $this->tagline;
    }

    /** Ce getter renvoie le titre du Film
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /** Ce getter renvoie l'id du poster du Film
     * @return int
     */
    public function getPosterId(): ?int
    {
        return $this->posterId;
    }

}