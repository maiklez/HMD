<?php

require_once __DIR__.'/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaceFallback(__DIR__);
$loader->register();