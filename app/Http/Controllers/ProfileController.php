<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($name) {
        $user = User::whereName($name)->firstOrFail();
        return view('profile.index', compact('user'));
    }
}
