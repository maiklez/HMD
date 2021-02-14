<?php

namespace Builder;

use SimpleXMLElement;

interface ItemXmlBuilder 
{ 
    public function getItem(SimpleXMLElement $xmlItem); 
}
