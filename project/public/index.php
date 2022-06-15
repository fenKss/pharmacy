<?php

use App\Kernel;

const BASE_DIR = __DIR__.'/../';
include_once BASE_DIR . "/vendor/autoload.php";
(new \App\Config\DotenvConfig())->init();
(new Kernel())->run();