<?php
namespace App\Common\Vote\Contracts\Classificators;

interface ClassificatorRepositoriesAwareInterface 
{
    /**
     * @param ConvocationRepositoryInterface $convocationRepository
     */
    public function setConvocationRepository(ConvocationRepositoryInterface $convocationRepository);

    /**
     * @param CouncilRepositoryInterface $councilRepository
     */
    public function setCouncilRepository(CouncilRepositoryInterface $councilRepository);

    /**
     * @param SessionRepositoryInterface $sessionRepository
     */
    public function setSessionRepository(SessionRepositoryInterface $sessionRepository);

    /**
     * @param VoterRepositoryInterface $voterRepository
     */
    public function setVoterRepository(VoterRepositoryInterface $voterRepository);

    /**
     * @param VoteTypeRepositoryInterface $voteTypeRepository
     */
    public function setVoteTypeRepository(VoteTypeRepositoryInterface $voteTypeRepository);
}