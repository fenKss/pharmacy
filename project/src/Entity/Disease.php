<?php

namespace App\Entity;

class Disease implements \JsonSerializable
{
    private int $id;

    private string $name;

    private int $type;

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
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param  int  $type
     *
     * @return Disease
     */
    public function setType(int $type): Disease
    {
        $this->type = $type;
        return $this;
    }


    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}