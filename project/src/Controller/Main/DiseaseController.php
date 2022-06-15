<?php

namespace App\Controller\Main;

use App\Http\Request;
use App\Entity\Disease;
use App\Http\Routing\Route;
use App\Http\Response\Response;
use App\Service\PaginationService;
use App\Repository\DrugRepository;
use App\Repository\DiseaseRepository;
use App\Controller\AbstractController;
use App\Repository\PopulationTypeRepository;

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
        PopulationTypeRepository $populationTypeRepository,
        DrugRepository $drugRepository,
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
        $drugs            = $drugRepository->fetchAllHash();
        $populationsTypes = $populationTypeRepository->fetchAllHash();
        $drugsRelations   = $diseasesRepository->getRelations(
            array_keys($diseases)
        );
        $diseasesA        = [];
        /** @var Disease $disease */
        foreach ($diseases as $disease) {
            $diseasesA[$disease->getId()] = [
                'entity' => $disease,
                'drugs' => [],
                "population_type" => $populationsTypes[$disease->getPopulationTypeId()]
            ];
        }
        foreach ($drugsRelations as $drugsRelation) {
            $drug_id                                 = $drugsRelation['drug_id'];
            $disease_id                              = $drugsRelation['disease_id'];
            $diseasesA[$disease_id]['drugs'][$drug_id] = $drugs[$drug_id];
        }
        return $this->render('shop.html.twig', [
            'diseases' => $diseases,
            "page_numbers" => $number_of_page,
        ]);
    }
}