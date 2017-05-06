<?php

namespace App\Common\Vote\Concern\ValueObjects;


class Voice
{
    private $value;

    /**
     * Voice constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return (string) $this->value;
    }
}