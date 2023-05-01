<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function articles()
    {
        $articles = User::paginate(3);
        return Inertia::render('Admin/Index', ['title' => 'articles', 'data' => $articles]);
    }

    public function categories()
    {
        $categories = Category::paginate(10);
        return Inertia::render('Admin/Index', ['title' => 'categories', 'data' => $categories]);
    }

    public function users()
    {
        $users = User::paginate(3);
        return Inertia::render('Admin/Index', ['title' => 'users', 'data' => $users]);
    }
}
