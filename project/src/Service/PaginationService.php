<?php

namespace App\Service;

class PaginationService
{
    public function getObjects(
        \App\Repository\AbstractRepository $repository,
        ?int $current_page = null,
        int $results_per_page = 10
    ): array {
        if (!$current_page) {
            $current_page = 1;
        }
        $count = $repository->count();
        $page_first_result = ($current_page - 1) * $results_per_page;
        $number_of_page = ceil($count / $results_per_page);
        $objects = $repository->fetchAllHash(
            $results_per_page,
            $page_first_result
        );
        return [$objects, $number_of_page];
    }
}