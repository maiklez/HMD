<?php

namespace Observer;

interface IObserver
{
    public function notify(IObservable $objSource, $strMessage);
}
