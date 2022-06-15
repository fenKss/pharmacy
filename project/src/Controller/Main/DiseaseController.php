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
        $drug_id = intval($request->get('drug_id'));
        $population_type_id = intval($request->get('population_type_id'));
        $query = "SELECT d.* from disease d ";
        if ($population_type_id){
            $query .= "LEFT JOIN population_type pt on d.population_type_id = pt.id
WHERE pt.id = $population_type_id ";
        }
        $query.= "ORDER BY d.id ";
        [
            $diseases,
            $number_of_page,
        ] = $paginationService->getObjects(
            $diseasesRepository,
            $page,
            $query
        );
        $drugs            = $drugRepository->fetchAllHash();
        $populationsTypes = $populationTypeRepository->fetchAllHash();
        $drugsRelations   = $diseases ? $diseasesRepository->getRelations(
            array_keys($diseases)
        ) : [];
        $diseasesA        = [];
        /** @var Disease $disease */
        foreach ($diseases as $disease) {
            $diseasesA[$disease->getId()] = [
                'entity' => $disease,
                'drugs' => [],
                "population_type" => $populationsTypes[$disease->getPopulationTypeId(
                )],
            ];
        }
        foreach ($drugsRelations as $drugsRelation) {
            $rDrug_id                                   = $drugsRelation['drug_id'];
            $rDisease_id                                = $drugsRelation['disease_id'];
            if (!$drug_id || $rDrug_id === $drug_id) {
                $diseasesA[$rDisease_id]['drugs'][$rDrug_id] = $drugs[$rDrug_id];
            }
        }
        return $this->render('diseases/list.html.twig', [
            'diseases' => $diseasesA,
            "page_numbers" => $number_of_page,
            "drugs" => $drugs,
            "population_types" => $populationsTypes,
        ]);
    }
}