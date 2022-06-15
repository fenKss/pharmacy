<?php
namespace App\Repository;

use App\Entity\Drug;

class DrugRepository extends AbstractRepository
{
    const TABLE = "drug";
    const ENTITY_CLASS = Drug::class;
    
}