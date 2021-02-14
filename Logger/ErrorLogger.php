<?php

namespace Logger;

use Observer\IObserver;
use Observer\IObservable;
use Parser\FeedParserBase;

class ErrorLogger implements IObserver
{
    public function notify(IObservable $objSource, $strMessage)
    {
        if ($objSource instanceof FeedParserBase) {
            printf('ERROR -> %s.' . PHP_EOL, $strMessage);
        }
    }
}
