<?php

namespace App\Entity;

class Disease implements \JsonSerializable
{
    private int $id;

    private string $name;

    private ?int $population_type_id = null;

    private ?string $code_mkb10 = null;

    public function getCodeMkb10(): ?string
    {
        return $this->code_mkb10;
    }

    public function setCodeMkb10(string $code_mkb10): Disease
    {
        $this->code_mkb10 = $code_mkb10;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     * @return Disease
     */
    public function setName(string $name): Disease
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getPopulationTypeId(): int
    {
        return $this->population_type_id;
    }

    /**
     * @param  int  $population_type_id
     *
     * @return Disease
     */
    public function setPopulationTypeId(int $population_type_id): Disease
    {
        $this->population_type_id = $population_type_id;
        return $this;
    }


    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}