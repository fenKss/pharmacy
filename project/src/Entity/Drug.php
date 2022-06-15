<?php

namespace App\Entity;

class Drug
{
    private int $id;

    private string $code_ATX;

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
     * @return Drug
     */
    public function setId(int $id): Drug
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCodeATX(): string
    {
        return $this->code_ATX;
    }

    /**
     * @param  string  $code_ATX
     *
     * @return Drug
     */
    public function setCodeATX(string $code_ATX): Drug
    {
        $this->code_ATX = $code_ATX;
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
     * @return Drug
     */
    public function setName(string $name): Drug
    {
        $this->name = $name;
        return $this;
    }

}