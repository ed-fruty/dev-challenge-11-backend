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

Route::get('/user', function (Request $request) {
    return $request;
});

/** @var \Illuminate\Routing\Router $router */

$router->post('document/upload')
    ->uses(\App\Common\Document\App\Http\Actions\CreateDocumentAction::class)
    ->name('document.upload');