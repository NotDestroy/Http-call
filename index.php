<?php

include_once 'vendor/autoload.php';

$path    = 'D:\OpenServer\domains\Http-call\archive';
$obBody1 = new \HttpCall\Project\RequestContent('https://www.litmir.me/all_genre');

$obGenre  = new \HttpCall\Project\Genre($obBody1->getBody());
$arrGenre = $obGenre->getGenre();
foreach ($arrGenre as $key => $value) {

    $obBody2 = new \HttpCall\Project\RequestContent($value);

    try {
        $obAuthor = new \HttpCall\Project\Author('class="desc2"> <meta itemprop="name" content="" Sco""><a href="/a/?id=101645">"Sco"</a></span></div><div class="desc_box">', 3);
    } catch
    (\HttpCall\Project\Exceptions\WrongLimitSpecified $e) {
        exit ($e->getMessage());
    }
    $obPutContent = new \HttpCall\Project\PutContent();
    //file_put_contents($path . '\\' . $key . '.txt', $obAuthor->getAuthor());
    $obPutContent->saveData($path, $key, $obAuthor->getAuthor());
}
//mb_convert_encoding($filename, 'UTF-8','Windows-1251');
