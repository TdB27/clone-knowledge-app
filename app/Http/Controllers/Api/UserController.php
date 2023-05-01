<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return response()->json(['users' => $users]);
    }

    public function store(UserRequest $request)
    {
        $user = $request->all();

        if (!isset($user['admin']))
            $user['admin'] = false;

        $user['password'] = Hash::make($user['password']);
        unset($user['confirmPassword']);

        User::create($user);

        return Redirect::back()->with('message', [
            'type' => 'success',
            'text' => "Salvo com sucesso",
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        $data = $request->all();

        if (isset($data['password'])) {
            $data['password'] = Hash::make($user['password']);
            unset($data['confirmPassword']);
        }

        $user->update($data);

        return Redirect::back()->with('message', [
            'type' => 'success',
            'text' => "Salvo com sucesso",
        ]);
    }

    public function destroy($user)
    {
        $user = User::find($user);

        if ($user === null)
            return Redirect::back()->withErrors(["Erro ao remover o usuário!"]);

        $article = Article::where('user_id', $user->id)->first();
        if ($article !== null)
            return Redirect::back()->withErrors(["Usuário possui artigos!"]);

        $user->delete();
        return Redirect::back()->with('message', [
            'type' => 'success',
            'text' => "Removido com sucesso",
        ]);
    }
}
