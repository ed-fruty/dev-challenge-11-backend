<?php
namespace App\Common\Vote\Contracts\Classificators;

interface ConvocationRepositoryInterface 
{
    /**
     * @param string $name
     * @return ConvocationInterface
     */
    public function findByNameOrCreate(string $name) : ConvocationInterface;
}