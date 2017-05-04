<?php
namespace App\Common\Vote\Concern\Traits;

use App\Common\Vote\Contracts\Classificators\ConvocationRepositoryInterface;
use App\Common\Vote\Contracts\Classificators\CouncilRepositoryInterface;
use App\Common\Vote\Contracts\Classificators\SessionRepositoryInterface;
use App\Common\Vote\Contracts\Classificators\VoterRepositoryInterface;
use App\Common\Vote\Contracts\Classificators\VoteTypeRepositoryInterface;

trait ClassificatorRepositoriesAware
{
    /**
     * @var ConvocationRepositoryInterface
     */
    protected $convocationRepository;

    /**
     * @var CouncilRepositoryInterface
     */
    protected $councilRepository;

    /**
     * @var SessionRepositoryInterface
     */
    protected $sessionRepository;

    /**
     * @var VoterRepositoryInterface
     */
    protected $voterRepository;

    /**
     * @var VoteTypeRepositoryInterface
     */
    protected $voteTypeRepository;

    /**
     * @param ConvocationRepositoryInterface $convocationRepository
     */
    public function setConvocationRepository(ConvocationRepositoryInterface $convocationRepository)
    {
        $this->convocationRepository = $convocationRepository;
    }

    /**
     * @param CouncilRepositoryInterface $councilRepository
     */
    public function setCouncilRepository(CouncilRepositoryInterface $councilRepository)
    {
        $this->councilRepository = $councilRepository;
    }

    /**
     * @param SessionRepositoryInterface $sessionRepository
     */
    public function setSessionRepository(SessionRepositoryInterface $sessionRepository)
    {
        $this->sessionRepository = $sessionRepository;
    }

    /**
     * @param VoterRepositoryInterface $voterRepository
     */
    public function setVoterRepository(VoterRepositoryInterface $voterRepository)
    {
        $this->voterRepository = $voterRepository;
    }

    /**
     * @param VoteTypeRepositoryInterface $voteTypeRepository
     */
    public function setVoteTypeRepository(VoteTypeRepositoryInterface $voteTypeRepository)
    {
        $this->voteTypeRepository = $voteTypeRepository;
    }
}