<?php

namespace Logger;

use Observer\IObservable;
use Observer\IObserver;
use Parser\FeedParserBase;

class InfoLogger implements IObserver
{
    public function notify(IObservable $objSource, $strMessage)
    {
        if ($objSource instanceof FeedParserBase) {
            printf('INFO -> %s.' . PHP_EOL, $strMessage);
        }
    }
}
