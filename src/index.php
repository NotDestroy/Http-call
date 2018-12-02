<?php

include_once '../vendor/autoload.php';

$e = new \HttpCall\Project\PhpErorr\UncaughtExceptions();
set_exception_handler([$e, 'exceptionHandler']);

$path    = 'D:\OpenServer\domains\Http-call\archive';
$obBody1 = new \HttpCall\Project\RequestContent('https://www.litmir.me/all_genre');

$obGenre  = new \HttpCall\Project\Genre($obBody1->getBody());
$arrGenre = $obGenre->getGenre();
foreach ($arrGenre as $key => $value) {

    $obBody2 = new \HttpCall\Project\RequestContent($value);

    try {
        $obAuthor = new \HttpCall\Project\Author($obBody2->getBody(), -1);
    } catch
    (\HttpCall\Project\PhpErorr\WrongLimitSpecified $e) {
        return false;
    }
    $obPutContent = new \HttpCall\Project\PutContent();
    $obPutContent->saveData($path, $key, $obAuthor->getAuthor());
}

