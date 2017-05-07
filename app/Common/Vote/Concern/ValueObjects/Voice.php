<?php

namespace App\Common\Vote\Concern\ValueObjects;


class Voice
{
    public const VOICE_APPROVED = 1;
    public const VOICE_DECLINED = 2;
    public const VOICE_ABSTAINED = 3;
    public const VOICE_NOT_VOTED = 4;
    public const VOICE_MISSED = 5;

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