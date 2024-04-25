<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAdminRequest;
use App\Services\AdminService;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }
    public function login(LoginAdminRequest $request)
    {
        $credentials = $request->only('name', 'password');

        if ($this->adminService->login($credentials)) {
            return redirect()->route("properties.index");
        } else {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function logout()
    {
        $this->adminService->logout();
        return redirect()->route('loginView');
    }
}
