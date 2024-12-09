<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'username' => 'required|string|unique:customer,username|max:255',
            'password' => 'required|string',
        ]);

        $usernameExists = Customer::where('username', $request->username)->exists();

        if ($usernameExists) {
            return redirect()->back()->withErrors(['username' => 'Username already taken. Please choose another.']);
        }

        // Set default profile picture path
        $defaultProfilePicturePath = 'profile_pictures/user(1).png';

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->age = $request->age;
        $customer->username = $request->username;
        $customer->password = bcrypt($request->password);
        $customer->profile_picture = $defaultProfilePicturePath;
        $customer->save();
        Auth::login($customer);
        // return redirect('/');
        return redirect('/landing')->with('success', 'Registration successful!');
    }

    public function login(Request $request)
    {

        $validate = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = Customer::where('username', $validate['username'])->first();

        if (!$user) {
            // If the username does not exist, return an error message
            return redirect()->back()->withErrors(['register' => 'Username not registered, please register.']);
        }


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
        return redirect()->back()->withErrors(['nama' => 'Username/password invalid']);
        // return redirect()->route('login')->with(['username' => 'Username/Password Invalid']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function editProfileForm()
    {
        if (!Auth::check()) {
            // Redirect to login if not authenticated
            return redirect()->route('login')->with('error', 'You must log in to access this page.');
        }
        $user = Auth::user();
        return view('edit-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $file = $request->file('profile_picture');

        $user = Auth::user();


        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        // Update profile picture if provided
        if ($request->hasFile('profile_picture')) {
            $defaultProfilePicturePath = 'profile_pictures/user(1).png';

            // Delete the previous profile picture from S3, if it's not the default picture
            if ($user->profile_picture && $user->profile_picture !== $defaultProfilePicturePath) {
                // Delete the previous profile picture from S3
                \Storage::disk('s3')->delete($user->profile_picture);
            }

            // Upload the new profile picture to S3
            $path = $file->store('profile_pictures', 's3');

            // Update the user's profile picture path
            $user->profile_picture = $path;
        }

        // Update other profile fields
        $user->name = $validated['name'];
        $user->age = $validated['age'];
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }

    public function deleteProfilePicture(Request $request)
    {
        $user = Auth::user();
        $defaultProfilePicturePath = 'profile_pictures/user(1).png';

        if ($user->profile_picture !== $defaultProfilePicturePath) {
            // Delete the file from storage
            if (\Storage::disk('s3')->exists($user->profile_picture)) {
                // Delete the file from S3
                \Storage::disk('s3')->delete($user->profile_picture);
            }

            // Reset the profile_picture field to null
            $user->profile_picture = $defaultProfilePicturePath;
            $user->save();

            return redirect()->back()->with('success', 'Profile picture has been removed and reverted to the default.');
        } else if ($user->profile_picture === $defaultProfilePicturePath) {
            return redirect()->back()->with('error', 'No profile picture to delete.');
        }
    }
}
