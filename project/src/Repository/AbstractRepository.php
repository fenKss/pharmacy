<?php

namespace App\Repository;

use App\Database\Database;

class AbstractRepository
{
    const TABLE = null;
    const ENTITY_CLASS = null;

    public Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function fetchAllHash(?int $limit = null, ?int $offset = null, string $hash = 'id'): array
    {
        $query = "SELECT * FROM ". $this::TABLE . " ORDER BY id ";
        if (!is_null($limit) && !is_null($offset)){
            $query .= sprintf("OFFSET %d ROWS FETCH NEXT %d ROWS ONLY", $offset, $limit);
        }
        $objects =  $this->database->fetchObjects(
            $query , $this::ENTITY_CLASS
        );
        $result = [];
        foreach ($objects as $object){
            $result[$object->getId()] = $object;
        }
        return $result;
    }

    public function count(): int
    {
        $query = "SELECT count(id) as count FROM " . $this::TABLE;
        return $this->database->fetch($query)['count'];
    }

}