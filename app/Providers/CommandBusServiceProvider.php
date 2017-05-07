<?php

namespace App\Providers;

use App\Common\Document\Concern\Commands\CreateDocumentCommand;
use App\Common\Document\Concern\Commands\MarkDocumentAsProcessedCommand;
use App\Common\Document\Concern\Commands\ProcessDocumentCommand;
use App\Common\Document\Concern\Handlers\CreateDocumentHandler;
use App\Common\Document\Concern\Handlers\MarkDocumentAsProcessedHandler;
use App\Common\Document\Concern\Handlers\ProcessDocumentHandler;
use App\Common\Vote\Concern\Commands\CreateVoteBlankCommand;
use App\Common\Vote\Concern\Commands\CreateVoteCommand;
use App\Common\Vote\Concern\Handlers\CreateVoteBlankHandler;
use App\Common\Vote\Concern\Handlers\CreateVoteHandler;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\ServiceProvider;

class CommandBusServiceProvider extends ServiceProvider
{
    protected $map = [
        CreateDocumentCommand::class            => CreateDocumentHandler::class,
        MarkDocumentAsProcessedCommand::class   => MarkDocumentAsProcessedHandler::class,
        ProcessDocumentCommand::class           => ProcessDocumentHandler::class,
        CreateVoteCommand::class                => CreateVoteHandler::class,
        CreateVoteBlankCommand::class           => CreateVoteBlankHandler::class
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->afterResolving(Dispatcher::class, function(Dispatcher $commandBus) {
            /** @var \Illuminate\Bus\Dispatcher $commandBus */
            $commandBus->map($this->map);
        });
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
