<?php
namespace App\Repository;

use App\Entity\Disease;

class DiseaseRepository extends AbstractRepository
{
    const TABLE = "disease";
    const ENTITY_CLASS = Disease::class;
    
}