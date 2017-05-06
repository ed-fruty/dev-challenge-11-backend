<?php

namespace App\Common\Specifications\Integration\Eloquent;


use App\Common\Specifications\Contracts\SpecificationInterface;
use App\Common\Specifications\Contracts\SpecificationResolverInterface;
use App\Common\Specifications\Shared\PaginatedSpecification;
use App\Common\Specifications\SpecificationSearch;
use Illuminate\Database\Eloquent\Builder;

class PaginatedSpecificationResolver implements SpecificationResolverInterface
{

    /**
     * @param SpecificationInterface $specification
     * @return bool
     */
    public function supports(SpecificationInterface $specification): bool
    {
        return $specification instanceof PaginatedSpecification;
    }

    /**
     * @param SpecificationInterface $specification
     * @param Builder $query
     * @param SpecificationSearch $search
     * @return mixed
     */
    public function resolve(SpecificationInterface $specification, $query, SpecificationSearch $search)
    {
        /** @var PaginatedSpecification $specification */

        return $query->paginate();
    }
}