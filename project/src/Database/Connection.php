<?php

namespace App\Database;


use App\Config\DotenvConfig;

class Connection
{
    private DotenvConfig $config;
    /**
     * @var false|resource
     */
    private $connection = null;

    public function __construct(DotenvConfig $config)
    {
        $this->config = $config;
    }

    public function connect(): void
    {
        $this->connection = sqlsrv_connect(
            $this->config->get("DB_HOST")->getData(), [
                "Database" => $this->config->get("DB_NAME")->getData(),
                "TrustServerCertificate" => true,
                "PWD" => $this->config->get("DB_PASSWORD")->getData(),
                "UID" => $this->config->get("DB_USER")->getData(),
            ]
        );

        if (!$this->connection || sqlsrv_errors(SQLSRV_ERR_ERRORS)) {
            throw new \RuntimeException("Can't connect to DB");
        }
    }

    public function getConnection()
    {
        if (!$this->connection){
            $this->connect();
        }
        return $this->connection;
    }
}