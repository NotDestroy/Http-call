<?php

namespace HttpCall\Project;

class RequestContent
{
    private $url = '';

    public function __construct($url)
    {
        $this->url = $url;
    }

    private function getContentBody()
    {
        return \Requests::get($this->url);
    }

    /**
     * @return bool
     * @throws \HttpCall\Project\Exceptions\NotAppropriateCode
     */
    private function isAccept()
    {

        if ($this->getContentBody()->status_code !== 200) {
            throw new \HttpCall\Project\Exceptions\NotAppropriateCode();
        }

        return true;
    }

    /**
     * @return bool|string
     */
    public function getBody()
    {
        if ($this->isAccept()) {
            return $this->getContentBody()->body;
        }
        return false;
    }

}
