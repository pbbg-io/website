<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index() {
        return view('account.index');
    }

    public function changePassword(ChangePasswordRequest $request) {
        $user = \Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        flash("Your password has been changed")->success();

        return redirect()->back();
    }
}
