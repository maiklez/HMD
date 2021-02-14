<?php

namespace Parser;

use Observer\IObserver;
use Observer\IObservable;

abstract class FeedParserBase implements IObservable
{
    const EVENT_FEED_INFO = 1;
    const EVENT_FEED_ERROR = 2;

    protected $_strFeedUrl;
    protected $_aObservers = array();

    public function __construct($strFeedUrl)
    {
        $this->_strFeedUrl = $strFeedUrl;
    }

    public function getFeedUrl()
    {
        return $this->_strFeedUrl;
    }

    public function addObserver(IObserver $objLogger, $iEventType)
    {
        $this->_aObservers[$iEventType][] = $objLogger;
    }

    public function fireEvent($iEventType, $strMessage)
    {
        if (isset($this->_aObservers[$iEventType]) && is_array($this->_aObservers[$iEventType])) {
            foreach ($this->_aObservers[$iEventType] as $objObserver) {
                $objObserver->notify($this, $strMessage);
            }
        }
    }

    abstract function parse();
}
