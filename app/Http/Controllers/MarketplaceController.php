<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    public function search() {
        return view('marketplace.search');
    }

    public function show(\App\Extensions $extension) {
        return view('marketplace.show', compact('extension'));
    }
}
