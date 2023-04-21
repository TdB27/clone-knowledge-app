<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{
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
}
