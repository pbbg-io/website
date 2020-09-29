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

Route::post('/github', function () {

    $pass = false;

    if (request()->get('action', 'open') === 'closed') {
        $pass = true;
    } else {
        $pass = false;
    }


    if ($pr = request()->get('pull_request')) {
        if (isset($pr['merged']) && $pr['merged'] === true) {
            $pass = true;
            echo "Merged is true\n";
        }
    } else {
        $pass = false;
    }

    if ($pass) {
        $client = new \GuzzleHttp\Client([
            'headers' => [
                'api-key' => env('LETSBUILD_API')
            ],
            'base_uri' => 'https://letsbuild.gg/api/'
        ]);

        $readme = file_get_contents("https://raw.githubusercontent.com/1e4/awesome-letsbuild/master/README.md");

        $post = $readme;

        $time = new \Carbon\Carbon();
        $post .= "\n\n\nLast synced at {$time} from [Github](https://github.com/1e4/awesome-letsbuild)\n";
        $post .= "To contribute to the list, open a pull request and if accepted it will get merged and this post will be automatically updated";

        $client->put('articles/16', [
            'json' => [
                'article' => [
                    'body_markdown' => $post
                ]
            ]
        ]);

    }
});

Route::get('/extensions', function() {
    return \App\Extensions::all();
});
