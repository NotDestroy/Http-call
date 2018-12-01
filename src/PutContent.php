<?php

namespace HttpCall\Project;

class PutContent
{

    public function saveData($path, $genre, array $authors)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $content = '';
        foreach ($authors as $author){
            $content .= $author . "\r\n";
        }
        $pathFile = $path . '\\' . $genre . '.txt';
        $fileOpen = fopen($pathFile, 'a');
        fwrite($fileOpen, $content);
        fclose($fileOpen);
    }
}
