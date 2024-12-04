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

    public function landing(Request $request)
    {

        $weatherController = new WeatherController();
        $data = $weatherController->showWeather($request); // No getData() needed

        return view('landing', [
            'rainData' => $data['rainData'] ?? [],
            'city' => $request->input('city', 'Jakarta'),
            'message' => $data['message'] ?? '',
        ]);
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

            // Check the user's role
            $user = Auth::user(); // Get the authenticated user
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard'); // Redirect to admin dashboard
            }

            // Redirect regular users to the landing page
            return redirect()->intended('/landing');
        }

        // If login fails, return back with an error
        return redirect()->back()->with(['gagal' => 'Username/password invalid']);
        // return redirect()->route('login')->with(['username' => 'Username/Password Invalid']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
