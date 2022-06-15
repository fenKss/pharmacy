<?php


namespace App;
use App\Http\Request;
use \Twig\Environment;
use App\Config\Config;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use \Twig\Loader\FilesystemLoader;
use \Twig\TwigFunction;

class Twig
{
    private Environment $twig;

    public function __construct(Config $config, Request $request)
    {
        $twig_config = $config->get('twig')->toArray();
        $loader = new FilesystemLoader(BASE_DIR.$twig_config["templates_dir"]);
        $this->twig = new Environment($loader, [
            'debug' => (bool)$twig_config["debug"],
            'cache' => BASE_DIR.$twig_config["cache"],
            'auto_reload' => $twig_config["auto_reload"]
        ]);
        $function = new TwigFunction('assets', function ($path) {
            return "/".$path;
        });
        $this->twig->addFunction($function);
        $function = new TwigFunction('json_decode', function ($string) {
            return json_decode($string, true);
        });
        $this->twig->addFunction($function);
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
        $this->twig->addGlobal('request', $request);
    }
    public function render(string $template_name, array $params = []): string
    {
        return $this->twig->render($template_name, $params);
    }
}