<?php


namespace App\Controller;


use App\Http\Response\Response;
use App\Http\Response\RedirectResponse;

interface IController
{
    public function render(string $body, array $params): Response;

    public function redirect(string $url): RedirectResponse;

}