<?php

namespace App\Common\Specifications;


use App\Common\Specifications\Contracts\SpecificationInterface;
use App\Common\Specifications\Contracts\SpecificationResolverInterface;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SpecificationSearch
{
    /**
     * @var SpecificationResolverInterface[]
     */
    protected $resolvers = [];

    /**
     * @param SpecificationResolverInterface $resolver
     */
    public function registerResolver(SpecificationResolverInterface $resolver)
    {
        $this->resolvers[] = $resolver;
    }

    /**
     * @param Builder $query
     * @param SpecificationInterface $specification
     * @return Collection|Paginator|mixed
     */
    public function search($query, SpecificationInterface $specification)
    {
        return $this->getResolver($specification)->resolve($specification, $query, $this) ?: $query->get();
    }

    /**
     * @param SpecificationInterface $specification
     * @return SpecificationResolverInterface
     */
    public function getResolver(SpecificationInterface $specification): SpecificationResolverInterface
    {
        foreach ($this->resolvers as $resolver) {
            if ($resolver->supports($specification)) {
                return $resolver;
            }
        }

        throw new \InvalidArgumentException(sprintf(
            "No resolvers was found for specification %s",
            get_class($specification)
        ));
    }
}