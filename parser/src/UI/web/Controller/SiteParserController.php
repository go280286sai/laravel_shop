<?php

namespace web\Controllers;
use SiteParsingService;

class SiteParserController
{
    private $siteParsingService;

    public function __construct(SiteParsingService $siteParsingService)
    {
        $this->siteParsingService = $siteParsingService;
    }

    public function parseSiteAction($url)
    {
        // Обработка запроса на парсинг сайта
        $parsedData = $this->siteParsingService->parseSite($url);
        // Вернуть результат в пользовательский интерфейс
    }
}