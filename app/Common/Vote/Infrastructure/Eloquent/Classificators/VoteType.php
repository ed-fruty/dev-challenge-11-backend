<?php

namespace App\Common\Vote\Infrastructure\Eloquent\Classificators;


use App\Common\Vote\Concern\ValueObjects\ClassificatorId;
use App\Common\Vote\Contracts\Classificators\VoteTypeInterface;
use Illuminate\Database\Eloquent\Model;

class VoteType extends Model implements VoteTypeInterface
{
    /**
     * @var string
     */
    protected $table = 'vote_types';

    /**
     * @var array
     */
    protected $fillable = ['name'];

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