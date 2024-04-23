<?php

namespace App\Services;
use App\Http\Requests\LoginAdminRequest;
use Illuminate\Support\Facades\Auth;

class AdminService {
    public function login(array $credentials)
    {
        return Auth::guard('admin')->attempt($credentials);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
    }
}
