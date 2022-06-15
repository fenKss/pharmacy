<?php

namespace App\Service;

use App\Entity\Disease;
use App\Database\Database;

class PaginationService
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getDiseases(
        ?int $population_type_id = null,
        ?int $current_page = null,
        int $results_per_page = 7
    ): array {
        if (!$current_page) {
            $current_page = 1;
        }
        $query = "SELECT %s from disease d ";
        if ($population_type_id) {
            $query .= "LEFT JOIN population_type pt on d.population_type_id = pt.id
WHERE pt.id = $population_type_id ";
        }

        $count = $this->database->fetch(
            sprintf($query, "count(d.id) as count")
        )['count'];
        $query .= "ORDER BY d.id ";
        $page_first_result = ($current_page - 1) * $results_per_page;
        $number_of_page = ceil($count / $results_per_page);
        $query .= sprintf(
            " OFFSET %d ROWS FETCH NEXT %d ROWS ONLY",
            $page_first_result,
            $results_per_page
        );
        $query = sprintf($query, "d.*");
        $objects = $this->database->fetchObjectsArray(
            $query,
            Disease::class
        );

        return [$objects, $number_of_page];
    }
}