<?php
namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Property;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function myProfile()
    {
        $user = Auth::guard('user')->user();
        return view('user.profile', compact('user'));
    }

    public function loginRegView()
    {
        return view('loginRegister');
    }

    public function register(RegisterUserRequest $request)
    {
        $user = User::create([
            'username' => $request->validated()['username_reg'],
            'email' => $request->validated()['email_reg'],
            'password' => Hash::make($request->validated()['password_reg']),
        ]);

        Auth::guard('user')->login($user);
        return redirect()->route('myProfile');
    }

    public function login(LoginUserRequest $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('user')->attempt($credentials)) {
            return redirect()->route('myProfile');
        } else {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('loginView');
    }


    public function updateInfo(UpdateUserRequest $request)
    {
        $validatedData = $request->validated();
        $user = Auth::guard('user')->user();

        if ($user->email !== $validatedData['email']) {
            $request->validate([
                'email' => 'required|string|email|unique:users,email,' . $user->id,
            ]);
        }

        $user->update($validatedData);
        $user->save();

        return redirect()->route('myProfile')->with([
            'success' => 'Profile updated successfully',
            'user' => $user
        ]);
    }


    public function changePassword(Request $request)
    {
        if (!$request->isMethod('post')) {
            return view('user.changePass');
        }

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:12|different:current_password',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = Auth::guard('user')->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'The current password is incorrect.');
        }

        if ($request->new_password != $request->confirm_password) {
            return redirect()->back()->with('error', 'Passwords dont\'t match.');
        }
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully.');

    }
}
