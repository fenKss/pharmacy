<?php


namespace App\Controller\Main;

use App\Config\Config;
use App\Entity\Disease;
use App\Database\Database;
use App\Http\Routing\Route;
use App\Database\Connection;
use App\Http\Response\Response;
use App\Controller\AbstractController;

#[Route('/')]
class MainController extends AbstractController
{
    #[Route('/test/{test_id}/123', requestMethods: ['get'])]
    public function main(?int $test_id, int $some_id = 0): Response
    {
        return $this->render("You suck $test_id");
    }

    #[Route('/', requestMethods: ['get'])]
    public function index(
        Config $config,
        Database $database,
        ?int $test_id,
        int $some_id = 0
    ): Response {
        $a = $config->get('test');
        $diseases = $database->fetchObjects("SELECT * FROM disease", Disease::class);

        return $this->render('base.html.twig', [
            'diseases' => $diseases
        ]);
    }
}