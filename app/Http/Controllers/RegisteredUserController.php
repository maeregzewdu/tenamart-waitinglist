<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class RegisteredUserController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function admins()
    {
        $admins = User::all();

        return response()->json([
            'total_admins' => $admins->count(),
            'admins' => $admins
        ]);
    }

    public function update(User $user, Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
        ]);

        $user->update($validated);

        $message = 'Information updated successfully';

        if($request->wantsJson()) {
            return response()->json([
                'message' => $message,
                'user' => $user->fresh()
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors([
                'current_password' => 'The current password is incorrect.'
            ]);
        }

        $user->update([
            'password' => Hash::make($validated['new_password'])
        ]);

        $message = 'Password updated successfully.';

        if ($request->wantsJson()) {
            return response()->json(['message' => $message]);
        }

        return redirect()->back()->with('success', $message);
    }

    public function createAdmin(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Admin created successfully!',
                'user' => $user
            ]);
        }

        return redirect()->back()->with('success', 'User created successfully!');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            if ($request->wantsJson()) {
                return response()->json(['message' => 'Login successful']);
            }

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function deleteAccount(Request $request)
    {
        $user = Auth::user();
        $user->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Account deleted successfully']);
        }

        return redirect('/login')->with('success', 'Account deleted successfully');
    }
}
