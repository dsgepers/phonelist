<?php

//Show errors!
ini_set ('display_errors', -1);

//Define root path
define ('ROOT', dirname(__FILE__));

//Path to layout file
define ('LAYOUT_PATH', ROOT . '/views/_layout.phtml');

define ('STORAGE_PATH', ROOT . '/storage');

//Inluce Composer Autoloader
require(ROOT . '/vendor/autoload.php');

//Define routes
include(ROOT . '/router.php');

//Route the application
\Panda\Router::execute();
 