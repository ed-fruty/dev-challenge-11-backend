<?php

namespace App\Common\Document\Concern\ValueObjects;


final class Status
{
    public const STATUS_UNPROCESSED = 0;
    public const STATUS_PROCESSED = 1;

    public const STATUS_NAME_UNPROCESSED = 'Unprocessed';
    public const STATUS_NAME_PROCESSED = 'Processed';

    private $value;

    /**
     * Status constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->value == self::STATUS_PROCESSED
            ?   self::STATUS_NAME_PROCESSED
            :   self::STATUS_NAME_UNPROCESSED;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function isProcessed()
    {
        return $this->value == self::STATUS_PROCESSED;
    }

}