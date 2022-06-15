<?php

namespace App\Database;

class Database
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function query(string $query): bool
    {
        sqlsrv_query(
            $this->connection->getConnection(),
            $query
        );
        return empty(sqlsrv_errors());

    }

    public function fetchArray(string $query): array
    {
        $resource = $this->execute($query);

        $result = [];
        while ($row = sqlsrv_fetch_array($resource, SQLSRV_FETCH_ASSOC)){
            $result[] = $row;
        }
        return $result;
    }

    public function fetch(string $query): array
    {
        $resource = $this->execute($query);
        return sqlsrv_fetch_array($resource, SQLSRV_FETCH_ASSOC);
    }

    public function fetchObjects(string $query, string $objectClass): array
    {
        $resource = $this->execute($query);

        $result = [];
        while ($row = sqlsrv_fetch_object($resource, $objectClass)){
            $result[] = $row;
        }
        return $result;
    }

    /**
     * @param  string  $query
     *
     * @return resource
     */
    private function prepare(string $query)
    {
        $prepared =  sqlsrv_prepare(
            $this->connection->getConnection(),
            $query
        );
        if (!$prepared){
            throw new \RuntimeException("Can't prepare query");
        }
        return $prepared;
    }

    public function execute(string $query)
    {
        $resource = $this->prepare($query);
        $query = sqlsrv_execute($resource);
        if (!$query) {
            dd(sqlsrv_errors());
            throw new \RuntimeException("Can't execute query");
        }
        return $resource;
    }
}