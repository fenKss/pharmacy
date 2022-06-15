<?php

use App\Http\Request;
use App\Http\IRequest;
use App\Config\Config;
use App\Http\Routing\Router;
use App\Config\DotenvConfig;
use App\Http\Routing\IRouter;

return [
    'singletons' => [
        DotenvConfig::class,
        Config::class,
    ],
    'interfaceMapping' => [
        IRequest::class => Request::class,
        IRouter::class => Router::class,
    ],
];