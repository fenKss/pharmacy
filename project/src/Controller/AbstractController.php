<?php


namespace App\Controller;


use App\Di\Container;
use App\Http\Response\JsonResponse;
use App\Http\Response\Response;
use App\Http\Response\RedirectResponse;

abstract class AbstractController implements IController
{
    private Container $container;

    public function redirect(string $url): RedirectResponse
    {
        return new RedirectResponse($url);
    }

    public function render(
        string $body = '', array $params = []
    ): Response {
        return new Response($body);
    }

    public function json(array $body): JsonResponse
    {
        return new JsonResponse($body);
    }

    protected function getContainer(): Container
    {
        return $this->container;
    }
}