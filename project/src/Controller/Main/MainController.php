<?php


namespace App\Controller\Main;

use App\Http\Request;
use App\Config\Config;
use App\Http\Routing\Route;
use App\Http\Response\Response;
use App\Repository\DiseaseRepository;
use App\Controller\AbstractController;

#[Route('/')]
class MainController extends AbstractController
{
    #[Route('/test/{test_id}/123', requestMethods: ['get'])]
    public function main(?int $test_id, int $some_id = 0): Response
    {
        return $this->render("You suck $test_id");
    }
}