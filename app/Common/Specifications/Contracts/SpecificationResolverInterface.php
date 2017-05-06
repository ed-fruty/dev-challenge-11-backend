<?php

namespace App\Common\Specifications\Contracts;


use App\Common\Specifications\SpecificationSearch;
use Illuminate\Database\Eloquent\Builder;

interface SpecificationResolverInterface
{
    /**
     * @param SpecificationInterface $specification
     * @return bool
     */
    public function supports(SpecificationInterface $specification): bool;

    /**
     * @param SpecificationInterface $specification
     * @param Builder $query
     * @param SpecificationSearch $search
     * @return mixed
     */
    public function resolve(SpecificationInterface $specification, $query, SpecificationSearch $search);
}