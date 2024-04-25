<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;

class AdminService {
    public function login(array $credentials): bool
    {
        return Auth::guard('admin')->attempt($credentials);
    }

    public function logout(): void
    {
        Auth::guard('admin')->logout();
    }
}
