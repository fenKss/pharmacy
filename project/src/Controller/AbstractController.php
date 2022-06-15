<?php


namespace App\Controller;


use App\Twig;
use App\Di\Container;
use App\Http\Response\JsonResponse;
use App\Http\Response\Response;
use App\Http\Response\RedirectResponse;

abstract class AbstractController implements IController
{
    private Container $container;
    private Twig      $twig;

    public function __construct(Container $container, Twig $twig)
    {
        $this->container = $container;
        $this->twig = $twig;
    }

    public function redirect(string $url): RedirectResponse
    {
        return new RedirectResponse($url);
    }

    public function render(
        string $template_name, array $params = []
    ): Response {
        return new Response($this->twig->render($template_name, $params));
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