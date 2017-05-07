<?php

namespace App\Common\Specifications\Contracts;


use App\Common\Specifications\SpecificationSearch;

interface SpecificationSearchAwareInterface
{
    /**
     * @param SpecificationSearch $search
     */
    public function setSpecificationSearch(SpecificationSearch $search);
}