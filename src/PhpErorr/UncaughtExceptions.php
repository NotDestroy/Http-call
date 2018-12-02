<?php

namespace HttpCall\Project\PhpErorr;

class UncaughtExceptions
{
    function exceptionHandler(\Exception $exception)
    {
        $arrTrace = $exception->getTrace();
        $message = $exception->getMessage();
        $type = 'Error';
        $group = $arrTrace[0]['file'];
        $additionalData = [
            'Line' => $arrTrace[0]['line'],
            'function' => $arrTrace[0]['function'],
            'class' => $arrTrace[0]['class']
        ];
        $record = new Record($message, $type, $additionalData);
        $logger = new \Kinozal\Helper\Logger();
        $logger->writeLog($record, $group);
    }
}
