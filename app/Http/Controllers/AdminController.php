<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route("properties.index");
        } else {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('loginView');
    }
}
