<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $user = [
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'admin' => auth()->user()->admin == 1 ? true : false,
        ];

        return Inertia::render('Index', ['user' => $user]);
    }
}
