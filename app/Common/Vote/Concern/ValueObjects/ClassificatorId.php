<?php

namespace App\Common\Vote\Concern\ValueObjects;


class ClassificatorId
{
    private $value;

    /**
     * ClassificatorId constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return (string) $this->value;
    }
}