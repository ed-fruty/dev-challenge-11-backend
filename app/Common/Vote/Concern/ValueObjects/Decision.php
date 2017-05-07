<?php

namespace App\Common\Vote\Concern\ValueObjects;


final class Decision
{
    public const DECISION_APPROVED = 1;
    public const DECISION_DECLINED = 0;
    public const DECISION_NAME_APPROVED = 'Approved';
    public const DECISION_NAME_DECLINED = 'Declined';

    private $value;

    /**
     * Decision constructor.
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
        return $this->value;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->value == self::DECISION_APPROVED
            ?   self::DECISION_NAME_APPROVED
            :   self::DECISION_NAME_DECLINED;
    }

    /**
     * @return bool
     */
    public function isApproved(): bool
    {
        return $this->value == self::DECISION_APPROVED;
    }
}