<?php

namespace App\Entity;

class PopulationType
{
    private int    $id;
    private string $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param  int  $id
     *
     * @return PopulationType
     */
    public function setId(int $id): PopulationType
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param  string  $name
     *
     * @return PopulationType
     */
    public function setName(string $name): PopulationType
    {
        $this->name = $name;
        return $this;
    }

}