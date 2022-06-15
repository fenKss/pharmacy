<?php
namespace App\Repository;

use App\Entity\PopulationType;

class PopulationTypeRepository extends AbstractRepository
{
    const TABLE = "population_type";
    const ENTITY_CLASS = PopulationType::class;
    
}