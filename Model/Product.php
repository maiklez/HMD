<?php

namespace Model;

use Error;
use Validator\Validation;

class Product implements Validation
{
    protected $name, $url, $id, $date;

    public function __construct()
    {
    }

    public function validate()
    {
      if(empty($this->name) || empty($this->url))
      {
        throw new Error('incorrect item');
      }
    }

    public function setName($name)
    {
      $this->name = $name;
    }

    public function setUrl($url)
    {
      $this->url = $url;
    }

    public function setDate($date)
    {
      $this->date = $date;
    }

    public function setId($id)
    {
      $this->id = $id;
    }
    
    public function __toString()
    {
      return 
        'name: ' . $this->name . PHP_EOL .
        'id: ' . $this->id . PHP_EOL .
        'date: ' . $this->date . PHP_EOL .
        'url: ' . $this->url;
    }
}
