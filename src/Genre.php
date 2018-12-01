<?php

namespace HttpCall\Project;

class Genre
{
    private $bodyContent;
    private $startPointPathGenre = 0;
    private $url = 'https://www.litmir.me';
    private $limit = 0;

    /**
     * @param $body
     */
    public function __construct($body)
    {
        $this->bodyContent = $body;
    }

    /**
     * @param $startPoint
     *
     * @return string
     */
    private function getPathGenre(&$startPoint)
    {
        if (($startPathSextion = strpos($this->bodyContent, 'href="/bs/?g=g', $startPoint)) !== false) {
            $endPathSextion    = strpos($this->bodyContent, '"><p', $startPathSextion);
            $lengthPathSextion = $endPathSextion - $startPathSextion;
            $section           = substr($this->bodyContent, $startPathSextion, $lengthPathSextion);
            $path = $this->url . trim($section, 'href="');
            $startPoint        = $endPathSextion;
        }

        return $path;
    }

    /**
     * @return array
     */
    public function getGenre()
    {
        $genres     = [];
        $indexLimit = 1;
        $startPoint = 0;
        while (($startSection = strpos($this->bodyContent, 'genre_title">', $startPoint)) !== false) {
            $endPoint    = strpos($this->bodyContent, '</p>', $startSection);
            $lengthTitle = $endPoint - $startSection;
            $section     = substr($this->bodyContent, $startSection, $lengthTitle);
                $genres[trim($section, 'genre_title">')] = $this->getPathGenre($this->startPointPathGenre);
                $startPoint = &$endPoint;
                $indexLimit++;
        }

        return $genres;
    }
}
