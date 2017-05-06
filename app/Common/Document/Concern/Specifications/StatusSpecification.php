<?php

namespace App\Common\Document\Concern\Specifications;


use App\Common\Specifications\Contracts\SpecificationInterface;

class StatusSpecification implements SpecificationInterface
{
    /**
     * @var
     */
    private $status;

    /**
     * StatusSpecification constructor.
     * @param $status
     */
    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }
}