<?php

namespace App\Providers;

use App\Common\Document\Contracts\DocumentRepositoryInterface;
use App\Common\Document\Contracts\FilenameGeneratorInterface;
use App\Common\Document\Infrastructure\Eloquent\DocumentRepository;
use App\Common\Document\Infrastructure\Generators\RandomFilenameGenerator;
use App\Common\Vote\Contracts\Classificators\ConvocationRepositoryInterface;
use App\Common\Vote\Contracts\Classificators\CouncilRepositoryInterface;
use App\Common\Vote\Contracts\Classificators\SessionRepositoryInterface;
use App\Common\Vote\Contracts\Classificators\VoterRepositoryInterface;
use App\Common\Vote\Contracts\Classificators\VoteTypeRepositoryInterface;
use App\Common\Vote\Contracts\Vote\VoteRepositoryInterface;
use App\Common\Vote\Contracts\VoteBlank\VoteBlankRepositoryInterface;
use App\Common\Vote\Infrastructure\Eloquent\Classificators\ConvocationRepository;
use App\Common\Vote\Infrastructure\Eloquent\Classificators\CouncilRepository;
use App\Common\Vote\Infrastructure\Eloquent\Classificators\SessionRepository;
use App\Common\Vote\Infrastructure\Eloquent\Classificators\VoterRepository;
use App\Common\Vote\Infrastructure\Eloquent\Classificators\VoteTypeRepository;
use App\Common\Vote\Infrastructure\Eloquent\Vote\VoteRepository;
use App\Common\Vote\Infrastructure\Eloquent\VoteBlank\VoteBlankRepository;
use Illuminate\Support\ServiceProvider;

class InfrastructureServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;

    /**
     * @var array
     */
    protected $services = [
        DocumentRepositoryInterface::class      => DocumentRepository::class,
        FilenameGeneratorInterface::class       => RandomFilenameGenerator::class,
        ConvocationRepositoryInterface::class   => ConvocationRepository::class,
        CouncilRepositoryInterface::class       => CouncilRepository::class,
        SessionRepositoryInterface::class       => SessionRepository::class,
        VoterRepositoryInterface::class         => VoterRepository::class,
        VoteTypeRepositoryInterface::class      => VoteTypeRepository::class,
        VoteRepositoryInterface::class          => VoteRepository::class,
        VoteBlankRepositoryInterface::class     => VoteBlankRepository::class
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->services as $abstract => $concrete) {
            $this->app->singleton($abstract, $concrete);
        }
    }

    /**
     * @return array
     */
    public function provides()
    {
        return array_keys($this->services);
    }
}
