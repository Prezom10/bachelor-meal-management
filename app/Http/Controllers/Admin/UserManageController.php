<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApprovalMail;

class UserManageController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user_manage', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.user_manage_edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['required', 'string', 'max:20'],
            'role' => ['required', 'string', 'in:user,admin'],
        ]);

        $user->update($request->all());

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function approve(User $user)
    {
        $user->is_approved = true;
        $user->save();

        Mail::to($user->email)->send(new ApprovalMail($user));

        return redirect()->route('admin.users.index')->with('success', 'User approved successfully.');
    }

    public function reject(User $user)
    {
        $user->is_approved = false;
        $user->save();

        // Optionally send a rejection email

        return redirect()->route('admin.users.index')->with('success', 'User rejected successfully.');
    }
    public function updatePassword(Request $request, User $user)
{
    $request->validate([
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $user->password = Hash::make($request->password); // <-- Hash used
    $user->save();

    return redirect()->back()->with('success', 'Password updated successfully.');
}

}