<?php

declare(strict_types=1);

namespace Html;

class AppWebPage extends WebPage
{
    public function __construct(string $title = "")
    {
        parent::__construct($title);
        $this->appendCssUrl("/css/style.css");
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
        <link rel="stylesheet" href="/css/style.css">
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
