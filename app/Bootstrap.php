<?php 

require_once __DIR__ . '/../vendor/autoload.php';

// load Configuration
require_once 'Config/config.php';

// load helpers
$blocks = glob(APPROOT . '/helpers/*.php');
foreach($blocks as $block){
  require_once $block;
};

//Load Libraries
use App\Libraries\Core;
use App\Libraries\Controller;


// Create an instance of the Core class
$core = new Core;
