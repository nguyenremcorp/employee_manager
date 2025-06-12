<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Summary of showLogin
     * @return \Illuminate\Contracts\View\View
     */
    public function showLogin()
    {
       return view('auth.login');
    }

    /**
     * Summary of login
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('welcome');
        }

        return back()->withErrors([
            'login_error' => __('messages.auth.login_error')
        ]);
    }

    /**
     * Logout user
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        return redirect()->route('login');
    }
}
