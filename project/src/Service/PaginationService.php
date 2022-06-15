<?php

namespace App\Service;

class PaginationService
{
    public function getObjects(
        \App\Repository\AbstractRepository $repository,
        ?int $current_page = null,
        ?string $base_query = null,
        int $results_per_page = 10
    ): array {
        if (!$current_page) {
            $current_page = 1;
        }
        $count             = $repository->count();
        $page_first_result = ($current_page - 1) * $results_per_page;
        $number_of_page    = ceil($count / $results_per_page);
        if ($base_query) {
            $query = $base_query.sprintf(" OFFSET %d ROWS FETCH NEXT %d ROWS ONLY", $page_first_result, $results_per_page);
            $objects = $repository->database->fetchObjectsArray($query, $repository::ENTITY_CLASS);

        } else {
            $objects = $repository->fetchAllHash(
                $results_per_page,
                $page_first_result
            );
        }

        return [$objects, $number_of_page];
    }
}