<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TitanController extends Controller
{
    public function index() {

        $features = [
            'Users & Roles'   =>  [
                'icon'  =>  'fal fa-user-lock',
                'name'  =>  'Users & Roles',
                'description'   =>  'User authentication, registering and access control levels are built in'
            ],
            'Extensions'   =>  [
                'icon'  =>  'fal fa-puzzle-piece',
                'name'  =>  'Extensions',
                'description'   =>  'Easily extend capabilities with extensions, both third and first party'
            ],
            'Menus' =>  [
                'icon'  =>  'fal fa-bars',
                'name'  =>  'Menu Manager',
                'description'   =>  'Manage your menus from the comfort of your dashboard'
            ],
            'Cronjobs'  =>  [
                'icon'  =>  'fal fa-clock',
                'name'  =>  'Cronjobs',
                'description'   =>  'Built in management for handling cron jobs and scheduled tasks'
            ],
            'Laravel'   =>  [
                'icon'  =>  'fab fa-laravel',
                'name'  =>  'ACL',
                'description'   =>  'Built upon Laravel, a modern framework for development, we stand on a strong foundation'
            ],
            'Bootstrap'   =>  [
                'icon'  =>  'fab fa-bootstrap',
                'name'  =>  'ACL',
                'description'   =>  'No messing around with new frameworks, we use the tried and true bootstrap ui framework'
            ],
            'Blade'   =>  [
                'icon'  =>  'fal fa-eye',
                'name'  =>  'Blade',
                'description'   =>  'Utilising blade templating we separate the logic from the views'
            ],
        ];

        return view('titan.index', compact('features'));
    }
}
