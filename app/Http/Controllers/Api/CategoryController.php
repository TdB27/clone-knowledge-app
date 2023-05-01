<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return response()->json(['categories' => $categories]);
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->all());

        return Redirect::back()->with('message', [
            'type' => 'success',
            'text' => "Salvo com sucesso",
        ]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        return Redirect::back()->with('message', [
            'type' => 'success',
            'text' => "Atualizado com sucesso",
        ]);
    }

    public function destroy($category)
    {
        $category = Category::find($category);

        if ($category === null)
            return Redirect::back()->withErrors(["Erro ao remover o usuário!"]);

        $subCategory = Category::where('parent_id', $category->id)->first();
        if ($subCategory !== null)
            return Redirect::back()->withErrors(["Categoria possui subcategorias!"]);

        $category->delete();

        return Redirect::back()->with('message', [
            'type' => 'success',
            'text' => "Salvo com sucesso",
        ]);
    }
}
