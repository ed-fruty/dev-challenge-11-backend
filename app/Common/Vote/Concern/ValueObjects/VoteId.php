<?php

namespace App\Common\Vote\Concern\ValueObjects;

final class VoteId
{
    private $value;

    /**
     * VoteId constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue() : string
    {
        return (string) $this->value;
    }

}
