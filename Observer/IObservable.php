<?php

namespace Observer;

interface IObservable
{
    public function addObserver(IObserver $objObserver, $iEventType);
    public function fireEvent($iEventType, $strMessage);
}
