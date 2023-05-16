<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $stat = [
            'articles' => Article::count(),
            'categories' => Category::count(),
            'users' => User::count(),
        ];

        return Inertia::render('Home/Index', ['stat' => $stat]);
    }
}
