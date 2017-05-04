<?php
namespace App\Common\Vote\Contracts\Classificators;

interface ClassificatorInterface 
{
    /**
     * @return ClassificatorId
     */
    public function getId() : ClassificatorId;

    /**
     * @return string
     */
    public function getName() : string;
}