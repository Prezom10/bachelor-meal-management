<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationMail;
use App\Notifications\NewRegistrationAlert;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;


class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterUserRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('profile_photo')) {
            $data['profile_photo'] = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'profile_photo' => $data['profile_photo'] ?? null,
            'password' => Hash::make($data['password']),
            'is_approved' => false,
            'role' => 'user',
        ]);

        Mail::to($user->email)->send(new RegistrationMail($user));

        // Notify admins
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new NewRegistrationAlert($user));

        return redirect()->route('login')->with('status', 'Registration successful! Please wait for admin approval.');
    }
}