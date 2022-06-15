<?php
namespace App\Repository;

use App\Entity\Disease;

class DiseaseRepository extends AbstractRepository
{
    const TABLE = "disease";

    public function findAll(?int $limit = null, ?int $offset = null): array
    {
        $query = "SELECT * FROM ". self::TABLE . " ORDER BY id ";
        if (!is_null($limit) && !is_null($offset)){
            $query .= sprintf("OFFSET %d ROWS FETCH NEXT %d ROWS ONLY", $offset, $limit);
        }
        return $this->database->fetchObjects(
           $query , Disease::class
        );
    }

    public function count(): int
    {
        $query = "SELECT count(id) as count FROM disease";
        return $this->database->fetch($query)['count'];
    }
}