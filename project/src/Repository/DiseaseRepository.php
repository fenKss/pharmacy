<?php

namespace App\Repository;

use App\Entity\Disease;

class DiseaseRepository extends AbstractRepository
{
    const TABLE        = "disease";
    const ENTITY_CLASS = Disease::class;

    public function getRelations(array $disease_ids): array
    {
        $query = sprintf(
            "SELECT * FROM disease_has_drug dhd 
                    WHERE dhd.disease_id in (%s)",
            implode(",", $disease_ids)
        );
        return $this->database->fetchArray($query);
    }
}