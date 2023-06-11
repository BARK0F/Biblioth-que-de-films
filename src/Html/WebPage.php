<?php

namespace Html;

class WebPage
{
    private string $head = "";
    private string $title = "";
    private string $body = "";

    /** Constructeur
     * @param string $title Titre de la page
     */
    public function __construct(string $title="")
    {
        $this->head="";
        $this->title=$title;
        $this->body="";
    }

    /** Retourner le contenu de $this->head
     * @return string
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /** Retourner le contenu de $this->title
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /** Affecter le titre de la page
     * @param string $title Le titre
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /** Retourner le contenu de $this->body
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /** Ajouter un contenu dans $this->head
     * @param string $content Le contenu à ajouter
     * @return void
     */
    public function appendToHead(string $content): void
    {
        $this->head .= $content;
    }

    /** Ajouter un contenu CSS dans $this->head
     * @param string $css Le contenu CSS à ajouter
     * @return void
     */
    public function appendCss(string $css): void
    {
        $this->appendToHead("<style> {$css} </style>");
    }

    /** Ajouter l'URL d'un script CSS dans $this->head
     * @param string $url L'URL du script CSS
     * @return void
     */
    public function appendCssUrl(string $url): void
    {
        $this->appendToHead("<link rel='stylesheet' href='{$url}'>") ;
    }

    /** Ajouter un contenu JavaScript dans $this->head
     * @param string $js Le contenu JavaScript à ajouter
     * @return void
     */
    public function appendJs(string $js): void
    {
        $this->appendToHead("<script> {$js} </script>") ;
    }

    /** Ajouter l'URL d'un script JavaScript dans $this->head
     * @param string $url L'URL du script JavaScript
     * @return void
     */
    public function appendJsUrl(string $url): void
    {
        $this->head .= "<script src='{$url}'></script>";
    }

    /** Ajouter un contenu dans $this->body
     * @param string $content Le contenu à ajouter
     * @return void
     */
    public function appendContent(string $content): void
    {
        $this->body .= $content;
    }

    /** Produire la page Web complète
     * @return string
     */
    public function toHTML(): string
    {
        return <<<HTML
                <!DOCTYPE html>
                <html lang="fr">
                    <head>
                        <title> {$this->getTitle()} </title>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=500, initial-scale=1">
                        {$this->getHead()}
                    </head>
                    <body>
                        {$this->getBody()}
                    </body>
                </html>
 HTML;
    }

    /** Donner la date et l'heure de la dernière modification du script principal
     * @return string
     */
    public function getLastModification(): string
    {
        $lastModif = getlastmod();
        $formatDate = date('d/m/Y - H:i:s', $lastModif);
        return $formatDate;
    }

    /** Protéger les caractères spéciaux pouvant dégrader la page Web
     * @param string $string La chaîne à protéger
     * @return string La chaîne protéger
     */
    public static function escapeString(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, 'UTF-8', false);
    }
}
