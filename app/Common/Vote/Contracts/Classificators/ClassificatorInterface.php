<?php
namespace App\Common\Vote\Contracts\Classificators;

use App\Common\Vote\Concern\ValueObjects\ClassificatorId;

interface ClassificatorInterface
{
    /**
     * @return ClassificatorId
     */
    public function getId(): ClassificatorId;

    /**
     * @return string
     */
    public function getName() : string;
}