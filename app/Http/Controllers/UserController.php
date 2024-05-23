<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{


    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:20'],
            'password' => ['required', 'min:8', 'max:30']
        ]);

        if (auth()->attempt(['name' => $incomingFields['name'], 'password' => $incomingFields['password']])) {
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:20', Rule::unique('users', 'name')],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'max:30'],
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        $user = User::create($incomingFields);
        auth()->login($user);

        return redirect('/');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
