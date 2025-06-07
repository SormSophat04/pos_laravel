<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController
{
    public function showRegister()
    {
        $users = User::all();
        return view('auth.register', compact('users'));
    }
    public function showLogin()
    {
        return view('auth.index');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'role' => 'required',
            'time' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);

        $user = User::create($validated);

        Auth::login($user);

        return redirect()->route('product.view')->with('success', 'You have been registered successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('show.register')->with('success', 'User deleted successfully.');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'password' => 'required|min:3',
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route(Auth::user()->role == 'admin' ? 'orders' : 'product.view')->with('success', 'You have been logged in successfully');
        }
        throw ValidationException::withMessages([
            'credentials' => 'These credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flash('success', 'You have been logged out successfully');
        return redirect()->route('show.login')->with('success', 'You have been logged out successfully');
    }
}
