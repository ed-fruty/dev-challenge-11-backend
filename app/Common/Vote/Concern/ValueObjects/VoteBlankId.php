<?php

namespace App\Common\Vote\Concern\ValueObjects;


final class VoteBlankId
{
    private $value;

    /**
     * VoteBlankId constructor.
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