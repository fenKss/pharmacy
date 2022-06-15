<?php

namespace App\Controller\Main;

use App\Http\Request;
use App\Http\Routing\Route;
use App\Repository\DiseaseRepository;
use App\Controller\AbstractController;

#[Route('/diseases')]
class DiseaseController extends AbstractController
{
    public function add(Request $request)
    {
    }

    public function all(DiseaseRepository $repository)
    {
        $diseases = $repository->findAll(1,1);
    }
}