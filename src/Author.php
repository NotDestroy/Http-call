<?php

namespace HttpCall\Project;

class Author
{
    private $bodyContent;
    private $limit = 0;

    public function __construct($body, $limitOfAuthors)
    {
        $this->bodyContent = $body;
        if ($limitOfAuthors && $limitOfAuthors > 0) {
            $this->limit = $limitOfAuthors;
            return;
        }
        throw new \HttpCall\Project\Exceptions\WrongLimitSpecified('Ошибка указан неверный лимит');
    }

    private function isExsist($arr, $value)
    {
        foreach ($arr as $oneElement) {
            if ($oneElement === $value) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        $authors    = [];
        $indexLimit = 1;
        $startPoint = 0;
        while (($startSection = strpos($this->bodyContent, 'class="desc2"> <meta itemprop="name" content="',
                $startPoint)) !== false) {
            if ($indexLimit > $this->limit) {
                return $authors;
            }

            $endPoint    = strpos($this->bodyContent, '"><a href="', $startSection);
            $lengthTitle = $endPoint - $startSection;
            $section     = substr($this->bodyContent, $startSection, $lengthTitle);
            if ($this->isExsist($authors, trim($section, 'class="desc2"> <meta itemprop="name" content="'))) {
                continue;
            }
            $authors[]  = trim($section, 'class="desc2"> <meta itemprop="name" content="');
            $startPoint = &$endPoint;
            $indexLimit++;
        }

        return $authors;
    }
}
