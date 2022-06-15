<?php

namespace App\Controller\Main;

use App\Http\Request;
use App\Http\Routing\Route;
use App\Http\Response\Response;
use App\Service\PaginationService;
use App\Repository\DiseaseRepository;
use App\Controller\AbstractController;

#[Route('/diseases')]
class DiseaseController extends AbstractController
{
    public function add(Request $request)
    {
    }

    #[Route('/', requestMethods: ['get'])]
    public function index(
        PaginationService $paginationService,
        DiseaseRepository $diseasesRepository,
        Request $request
    ): Response {
        $page = $request->get('p');
        [
            $diseases,
            $number_of_page,
        ] = $paginationService->getObjects(
            $diseasesRepository,
            $page,
            2
        );

        return $this->render('shop.html.twig', [
            'diseases' => $diseases,
            "page_numbers" => $number_of_page,
        ]);
    }
}