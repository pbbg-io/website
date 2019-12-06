<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    public function index() {
        $data = [];
        $data['version'] = Setting::where('key', 'latest_version')->first()->value ?? 0;

        return response()->json($data);
    }
}
