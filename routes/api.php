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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('idlescape/{name}', function() {
        $name = request()->route('name');
        $user = \App\IdleScapeUsers::firstOrNew([
            'username'  =>  $name
        ]);
        $user->save();
});

Route::get('/version', 'Api\VersionController@index');

Route::post('/github/webhook/release', 'Api\GithubWebhook@release');

Route::get('/extensions', function() {
    return \App\Extensions::all();
});
