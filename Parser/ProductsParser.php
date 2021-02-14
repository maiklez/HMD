<?php

namespace Parser;

use Error, SimpleXMLElement;
use Logger\InfoLogger;
use Logger\ErrorLogger;
use Parser\FeedParserBase;
use Model\Product;
use Builder\ItemXmlBuilder;
use Validator\Validation;

class ProductsParser extends FeedParserBase implements ItemXmlBuilder, Validation
{

    public function __construct($strFeedUrl)
    {
      parent::__construct($strFeedUrl);
      $this->addObserver(new InfoLogger(), $this::EVENT_FEED_INFO);
      $this->addObserver(new ErrorLogger(), $this::EVENT_FEED_ERROR);
    }

    public function parse()
    {
      try
      {
        $this->fireEvent($this::EVENT_FEED_INFO, 'Start parsing...');

        $xmlArr = $this->validate();

        $products = array_map(function($xmlProduct) {
          return $this->getItem($xmlProduct);
        }, $xmlArr['item']);

        $this->fireEvent($this::EVENT_FEED_INFO, 'End parsing!');
        return $products;
      }
      catch(Error $ex)
      {
        $this->fireEvent($this::EVENT_FEED_ERROR, $ex->getMessage());
      }
    }

    public function validate()
    {
      $xml=simplexml_load_file($this->getFeedUrl());

      if(!$xml)
      {
        throw new Error("feed not found");
      }
      $xmlArr = (array)$xml;
      if($xmlArr['item'] === null)
      {
        throw new Error("empty feed");
      }

      return $xmlArr;
    }

    public function getItem(SimpleXMLElement $xmlProduct) : Product
    {
      $product = new Product();
      $name = $xmlProduct->title->__toString();
      $url = $xmlProduct->link->__toString();

      $product->setName($name);
      $product->setUrl($url);
      
      $pubDate = $xmlProduct->pubDate->__toString();
      $pubDateNoDay = substr($pubDate, 5);
      $product->setDate(date_create_from_format("d M Y H:i:s O", $pubDateNoDay)->format("Y-m-d H:i:s"));

      $product->setId(pathinfo(parse_url($this->url, PHP_URL_PATH), PATHINFO_FILENAME));

      $product->validate();

      $this->fireEvent($this::EVENT_FEED_INFO, 'item added' . PHP_EOL . $product);

      return $product;
    }
}
