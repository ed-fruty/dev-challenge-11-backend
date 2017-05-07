<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/** @var \Illuminate\Routing\Router $router */

$router->post('documents/upload')
    ->uses(\App\Common\Document\App\Http\Actions\CreateDocumentAction::class)
    ->name('documents.upload');

$router->get('documents')
    ->uses(\App\Common\Document\App\Http\Actions\GetDocumentListAction::class)
    ->name('documents.list');

$router->get('documents/{document}/votes')
    ->uses(\App\Common\Document\App\Http\Requests\GetDocumentVotesAction::class)
    ->name('documents.votes');

$router->get('documents/{document}')
    ->uses(\App\Common\Document\App\Http\Requests\GetDocumentAction::class)
    ->name('documents.show');

$router->get('votes/{vote}')
    ->uses(\App\Common\Vote\App\Http\Actions\GetVoteAction::class)
    ->name('votes.show');

$router->get('votes/{vote}/blanks')
    ->uses(\App\Common\Vote\App\Http\Actions\GetVoteBlanksAction::class)
    ->name('votes.blanks');

$router->get('votes/{vote}/voters')
    ->uses(\App\Common\Vote\App\Http\Actions\GetVoteVotersAction::class)
    ->name('votes.voters');


$router->get('voters')
    ->uses(\App\Common\Vote\App\Http\Actions\GetVotersAction::class)
    ->name('voters.list');

$router->get('voters/{voter}')
    ->uses(\App\Common\Vote\App\Http\Actions\GetVoterAction::class)
    ->name('voter.show');

$router->get('voters/{voter}/blanks')
    ->uses(\App\Common\Vote\App\Http\Actions\GetVotersBlanks::class)
    ->name('voters.blanks');

$router->get('voters/{voter}/votes')
    ->uses(\App\Common\Vote\App\Http\Actions\GetVotersVotesAction::class)
    ->name('voters.votes');

$router->get('voters/{voter}/similar')
    ->uses(\App\Common\Vote\App\Http\Actions\GetVotersSimilarAction::class)
    ->name('voters.similar');