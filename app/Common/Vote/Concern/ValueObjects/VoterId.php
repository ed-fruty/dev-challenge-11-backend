<?php

namespace App\Common\Vote\Concern\ValueObjects;


class VoterId
{

    private $value;

    /**
     * VoterId constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return (string) $this->value;
    }
}