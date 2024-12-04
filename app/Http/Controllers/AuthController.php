<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Loginform()
    {
        return view('login');
    }

    public function Registerform()
    {
        return view('register');
    }

    public function landing()
    {
        return view('landing');
    }

    public function registerSubmit(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->age = $request->age;
        $customer->username = $request->username;
        $customer->password = bcrypt($request->password);
        $customer->save();
        Auth::login($customer);
        return redirect('/');
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['username' => $validate['username'], 'password' => $validate['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/landing');
        } else {
            return back()->withErrors(['username' => 'Username/password invalid']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
