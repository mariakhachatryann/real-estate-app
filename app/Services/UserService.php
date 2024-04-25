<?php

namespace App\Services;
use App\Mail\AgentMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserService {
    public function register(array $userData): User
    {
        return User::create([
            'username' => $userData['username_reg'],
            'email' => $userData['email_reg'],
            'password' => Hash::make($userData['password_reg']),
        ]);
    }

    public function login(array $credentials): bool
    {
        return Auth::guard('user')->attempt($credentials);
    }

    public function logout(): void
    {
        Auth::guard('user')->logout();
    }

    public function updateInfo(User $user, array $validatedData): User
    {
        $user->update($validatedData);
        return $user;
    }

    public function changePassword(User $user, string $currentPassword, string $newPassword, string $confirmPassword): array
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

    public function messageToAgent(string $email, string $phone, string $message, User $agentDetails): void
    {
        Mail::to($agentDetails->email)->queue(new AgentMail($email, $phone, $message, $agentDetails));
    }
}
