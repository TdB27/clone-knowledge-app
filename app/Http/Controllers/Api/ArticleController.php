<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ArticleController extends Controller
{
    public function store(ArticleRequest $request)
    {

        Article::create($request->all());

        return Redirect::back()->with('message', [
            'type' => 'success',
            'text' => "Salvo com sucesso",
        ]);
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($request->all());

        return Redirect::back()->with('message', [
            'type' => 'success',
            'text' => "Atualizado com sucesso",
        ]);
    }

    public function destroy($article)
    {
        $article = Article::find($article);

        if ($article === null)
            return Redirect::back()->withErrors(["Erro ao remover o usuário!"]);

        $article->delete();

        return Redirect::back()->with('message', [
            'type' => 'success',
            'text' => "Excluído com sucesso",
        ]);
    }
}
