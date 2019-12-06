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

        if (isset($payload->release->tag_name)) {
            $rv->value = $payload['release']['tag_name'];

            $rv->save();
        }
    }

    protected function validateSignature($gitHubSignatureHeader, $payload)
    {
        list ($algo, $gitHubSignature) = explode("=", $gitHubSignatureHeader);
        if ($algo !== 'sha1') {
            // see https://developer.github.com/webhooks/securing/
            return false;
        }
        $payload = json_encode($payload);
        $payloadHash = hash_hmac($algo, "{$payload}", env("GITHUB_SECRET"));

        dd($payload, $algo, $payloadHash, $gitHubSignature);

        return ($payloadHash === $gitHubSignature);
    }
}
