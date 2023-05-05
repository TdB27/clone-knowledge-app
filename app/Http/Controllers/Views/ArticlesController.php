<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ArticlesController extends Controller
{
    public function getByCategories($category)
    {
        $category = Category::find($category);
        $categories = Category::where('id', $category->id)->orWhere('parent_id', $category->id)->get()->toArray();

        $categories_ids = array_map(function ($category) {
            return $category['id'];
        }, $categories);

        $articles = Article::with('user')->whereIn('category_id', $categories_ids)->get();

        return Inertia::render('Article/ArticleByCategory', ['category' => $category, 'articles' => $articles]);
    }

    public function getByArticle($article)
    {
        $article = Article::find($article);

        if ($article === null)
            return Redirect::route('home')->withErrors(["Erro ao acessar o artigo!"]);

        return Inertia::render('Article/ArticleById', ['article' => $article]);
    }
}
