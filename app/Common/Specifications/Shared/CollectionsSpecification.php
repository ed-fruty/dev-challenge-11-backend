<?php

namespace App\Common\Specifications\Shared;


use App\Common\Specifications\Contracts\SpecificationInterface;

class CollectionsSpecification implements SpecificationInterface
{
    /**
     * @var SpecificationInterface[]
     */
    protected $specifications = [];

    /**
     * @param SpecificationInterface $specification
     */
    public function push(SpecificationInterface $specification)
    {
        $this->specifications[] = $specification;
    }

    /**
     * @return SpecificationInterface[]
     */
    public function all(): array
    {
        return $this->specifications;
    }
}