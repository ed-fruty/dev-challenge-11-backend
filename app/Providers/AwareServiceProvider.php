<?php

namespace App\Providers;

use App\Common\Document\Contracts\DocumentRepositoryAwareInterface;
use App\Common\Document\Contracts\DocumentRepositoryInterface;
use App\Common\Laravel\CommandBus\Contracts\CommandBusAwareInterface;
use App\Common\Laravel\Events\Contracts\EventDispatcherAwareInterface;
use App\Common\Laravel\Filesystem\Contracts\FileSystemFactoryAwareInterface;
use App\Common\Vote\Contracts\Classificators\ClassificatorRepositoriesAwareInterface;
use App\Common\Vote\Contracts\Classificators\ConvocationRepositoryInterface;
use App\Common\Vote\Contracts\Classificators\CouncilRepositoryInterface;
use App\Common\Vote\Contracts\Classificators\SessionRepositoryInterface;
use App\Common\Vote\Contracts\Classificators\VoterRepositoryInterface;
use App\Common\Vote\Contracts\Classificators\VoteTypeRepositoryInterface;
use App\Common\Vote\Contracts\Vote\VoteRepositoryAwareInterface;
use App\Common\Vote\Contracts\Vote\VoteRepositoryInterface;
use App\Common\Vote\Contracts\VoteBlank\VoteBlankRepositoryAwareInterface;
use App\Common\Vote\Contracts\VoteBlank\VoteBlankRepositoryInterface;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Events\Dispatcher as EventDispatcher;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Support\ServiceProvider;

class AwareServiceProvider extends ServiceProvider
{
    protected $aware = [
        CommandBusAwareInterface::class => [
            'setCommandBus' => Dispatcher::class,
        ],
        EventDispatcherAwareInterface::class => [
            'setEventDispatcher'    => EventDispatcher::class,
        ],
        FileSystemFactoryAwareInterface::class => [
            'setFilesystemFactory'  => Factory::class,
        ],

        DocumentRepositoryAwareInterface::class => [
            'setDocumentRepository' => DocumentRepositoryInterface::class,
        ],

        ClassificatorRepositoriesAwareInterface::class => [
            'setConvocationRepository'  => ConvocationRepositoryInterface::class,
            'setCouncilRepository'      => CouncilRepositoryInterface::class,
            'setSessionRepository'      => SessionRepositoryInterface::class,
            'setVoterRepository'        => VoterRepositoryInterface::class,
            'setVoteTypeRepository'     => VoteTypeRepositoryInterface::class,
        ],

        VoteRepositoryAwareInterface::class => [
            'setVoteRepository' => VoteRepositoryInterface::class,
        ],

        VoteBlankRepositoryAwareInterface::class    => [
            'setVoteBlankRepository'    => VoteBlankRepositoryInterface::class
        ]
    ];


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->aware as $name => $calls) {
            $this->app->afterResolving($name, function($service) use ($calls) {
                 foreach ($calls as $method => $dependencies) {

                     $dependencies = array_map(function($dependency) {
                         return $this->app->make($dependency);
                     }, (array) $dependencies);

                     $service->{$method}(...$dependencies);
                 }
            });
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
