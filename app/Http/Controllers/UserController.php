<?php
namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\AgentMessageRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\UserService;
use App\Models\User;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
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
        $userData = $request->validated();
        $user = $this->userService->register($userData);
        Auth::guard('user')->login($user);
        return redirect()->route('myProfile');
    }

    public function login(LoginUserRequest $request)
    {
        $credentials = $request->only('username', 'password');

        if ($this->userService->login($credentials)) {
            return redirect()->route('myProfile');
        } else {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function logout()
    {
        $this->userService->logout();$this->userService->logout();
        return redirect()->route('loginView');
    }


    public function updateInfo(UpdateUserRequest $request)
    {
        $validatedData = $request->validated();
        $user = Auth::guard('user')->user();

        $user = $this->userService->updateInfo($user, $validatedData);

        return redirect()->route('myProfile')->with([
            'success' => 'Profile updated successfully',
            'user' => $user
        ]);
    }

    public function changePasswordView()
    {
        return view('user.changePass');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::guard('user')->user();
        $currentPassword = $request->current_password;
        $newPassword = $request->new_password;
        $confirmPassword = $request->confirm_password;

        $result = $this->userService->changePassword($user, $currentPassword, $newPassword, $confirmPassword);

        if ($result['success']) {
            return redirect()->back()->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }

    public function messageAgent(AgentMessageRequest $request, string $id)
    {
        $agentDetails = User::findOrFail($id);
        $this->userService->messageToAgent($request->email, $request->phone, $request->message, $agentDetails);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
