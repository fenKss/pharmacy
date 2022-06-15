<?php

namespace App\Repository;

use App\Database\Database;

class AbstractRepository
{
    public Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }
}