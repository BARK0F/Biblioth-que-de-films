<?php

declare(strict_types=1);

namespace Html;

class AppWebPage extends WebPage
{
    public function __construct(string $title = "")
    {
        parent::__construct($title);
    }

    public function toHtml(): string
    {
        $lastModification = $this->getLastModification();

        return <<<HTML
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>{$this->getTitle()}</title>
        {$this->getHead()}
    </head>
    <body>
        <div class="header">
            <h1 class="title">{$this->getTitle()}</h1>
        </div>
        <div class="content">
            {$this->getBody()}
        </div>
        <div class="footer">
            <p>Dernière modification : {$lastModification}</p>
        </div>
    </body>
</html>
HTML;
    }
}
