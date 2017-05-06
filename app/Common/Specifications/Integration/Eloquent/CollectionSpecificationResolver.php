<?php

namespace App\Common\Specifications\Integration\Eloquent;

use App\Common\Specifications\Contracts\SpecificationInterface;
use App\Common\Specifications\Contracts\SpecificationResolverInterface;
use App\Common\Specifications\Shared\CollectionsSpecification;
use App\Common\Specifications\SpecificationSearch;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class CollectionSpecificationResolver
 * @package App\Common\Specifications\Integration\Eloquent
 */
class CollectionSpecificationResolver implements SpecificationResolverInterface
{

    /**
     * @param SpecificationInterface $specification
     * @return bool
     */
    public function supports(SpecificationInterface $specification): bool
    {
        return $specification instanceof CollectionsSpecification;
    }

    /**
     * @param SpecificationInterface $specification
     * @param Builder $query
     * @param SpecificationSearch $search
     * @return mixed
     */
    public function resolve(SpecificationInterface $specification, $query, SpecificationSearch $search)
    {
        /** @var CollectionsSpecification $specification */
        foreach ($specification->all() as $item) {
            $result = $search->getResolver($item)->resolve($item, $query, $search);

            if ($result) {
                return $result;
            }
        }

        return null;
    }
}