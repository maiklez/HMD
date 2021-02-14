<?php

require_once 'index.php';

use Parser\ProductsParser;

$productsParser = new ProductsParser('products.xml');

$productsParser->parse();
