<?php


namespace App\Controller\Main;

use App\Http\Request;
use App\Config\Config;
use App\Http\Routing\Route;
use App\Http\Response\Response;
use App\Repository\DiseaseRepository;
use App\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', requestMethods: ['get'])]
    public function main(): Response
    {
        return $this->render('main.html.twig');
    }

    #[Route('/about', requestMethods: ['get'])]
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }

    #[Route('/contact', requestMethods: ['get'])]
    public function contact(): Response
    {
        return $this->render('contact.html.twig');
    }
}