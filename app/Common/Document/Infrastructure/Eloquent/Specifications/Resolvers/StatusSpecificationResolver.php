<?php

namespace App\Common\Document\Infrastructure\Eloquent\Specifications\Resolvers;


use App\Common\Document\Concern\Specifications\StatusSpecification;
use App\Common\Specifications\Contracts\SpecificationInterface;
use App\Common\Specifications\Contracts\SpecificationResolverInterface;
use App\Common\Specifications\SpecificationSearch;
use Illuminate\Database\Eloquent\Builder;

class StatusSpecificationResolver implements SpecificationResolverInterface
{

    /**
     * @param SpecificationInterface $specification
     * @return bool
     */
    public function supports(SpecificationInterface $specification): bool
    {
        return $specification instanceof StatusSpecification;
    }

    /**
     * @param SpecificationInterface $specification
     * @param Builder $query
     * @param SpecificationSearch $search
     * @return mixed
     */
    public function resolve(SpecificationInterface $specification, $query, SpecificationSearch $search)
    {
        /** @var StatusSpecification $specification */

        $query->where('status', $specification->getStatus());

        return null;
    }
}