<?php
namespace App\Common\Document\Concern\ValueObjects;

final class DocumentId
{
    private $value;

    /**
     * DocumentId constructor.
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