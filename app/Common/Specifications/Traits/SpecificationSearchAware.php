<?php

namespace App\Common\Specifications\Traits;


use App\Common\Specifications\SpecificationSearch;

trait SpecificationSearchAware
{
    /**
     * @var SpecificationSearch
     */
    protected $specificationSearch;

    /**
     * @param SpecificationSearch $search
     */
    public function setSpecificationSearch(SpecificationSearch $search)
    {
        $this->specificationSearch = $search;
    }
}