<?php

namespace App\Services;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Jobs\SendAgentMailJob;
use App\Jobs\SendUserMailJob;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService {
    public function register(array $userData)
    {
        return User::create([
            'username' => $userData['username_reg'],
            'email' => $userData['email_reg'],
            'password' => Hash::make($userData['password_reg']),
        ]);
    }

    public function login(array $credentials)
    {
        return Auth::guard('user')->attempt($credentials);
    }

    public function logout()
    {
        Auth::guard('user')->logout();
    }

    public function updateInfo($user, array $validatedData)
    {
        $user->update($validatedData);
        return $user;
    }

    public function changePassword($user, $currentPassword, $newPassword, $confirmPassword)
    {
        if (!Hash::check($currentPassword, $user->password)) {
            return ['success' => false, 'message' => 'The current password is incorrect.'];
        }

        if ($newPassword != $confirmPassword) {
            return ['success' => false, 'message' => 'Passwords don\'t match.'];
        }

        $user->password = Hash::make($newPassword);
        $user->save();

        return ['success' => true, 'message' => 'Password changed successfully!'];
    }

    public function messageToAgent($email, $phone, $message, $agentDetails)
    {
        SendAgentMailJob::dispatch($email, $phone, $message, $agentDetails)->onQueue('emails');
    }
}
