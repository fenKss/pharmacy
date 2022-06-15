<?php

namespace App\Http\Routing;


use App\Http\IRequest;

interface IRouter
{
    public function getRoute(IRequest $request): ?Route;
}