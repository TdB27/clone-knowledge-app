<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArticlesController extends Controller
{
    public function getByCategories($category)
    {
        $category = Category::find($category);
        $articles = Article::with('user')->where('category_id', $category->id)->get();

        return Inertia::render('Article/ArticleByCategory', ['category' => $category, 'articles' => $articles]);
    }
}
