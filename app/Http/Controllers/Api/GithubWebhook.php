<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;

class GithubWebhook extends Controller
{
    private $data;

    public function release(Request $request)
    {
        $rv = Setting::firstOrNew([
            'key' => 'latest_version'
        ]);

        $signature = $request->server('HTTP_X_HUB_SIGNATURE');

        $payload = $request->all();

        if (!$this->validateSignature($signature, $payload)) {
            abort(404, 'Invalid Signature');
        }

        $rv->value = 'dev';

        if (isset($payload['release']['tag_name'])) {
            $rv->value = str_replace('v', '', $payload['release']['tag_name']);
        }

        $rv->save();
    }

    protected function validateSignature($gitHubSignatureHeader, $payload)
    {
        [$algo, $hash] = explode('=', request()->header('X-Hub-Signature', 'sha1=PlaceHolderHash'), 2);
        return hash_equals($hash, hash_hmac($algo, file_get_contents('php://input'), env('GITHUB_SECRET')));
    }
}
