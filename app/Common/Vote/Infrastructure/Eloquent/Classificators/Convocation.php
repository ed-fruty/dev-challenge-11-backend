<?php

namespace App\Common\Vote\Infrastructure\Eloquent\Classificators;


use App\Common\Vote\Concern\ValueObjects\ClassificatorId;
use App\Common\Vote\Contracts\Classificators\ConvocationInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Convocation
 * @package App\Common\Vote\Infrastructure\Eloquent\Classificators
 */
class Convocation extends Model implements ConvocationInterface
{

    /**
     * @return ClassificatorId
     */
    public function getId(): ClassificatorId
    {
        return new ClassificatorId($this->getKey());
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getAttribute('name');
    }
}