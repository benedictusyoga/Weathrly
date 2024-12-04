<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


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
        return redirect()->route('login');
    }

    public function login(Request $request)
    {
        $data = $request->only('username', 'password');

        // Log the attempt for debugging purposes
        Log::info('Login attempt for: ', $data);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            Log::info('Login successful for: ', $data);
            Log::info('Redirecting to landing page.');
            //return redirect('/landing'); // Try using the full URL to the landing page// Regenerate session for security
            return redirect()->route('landing'); // Redirect to the landing page
        }

        // If login fails, return back with an error message
        return redirect()->back()->with('gagal', 'Username atau password salah.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
