<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminview()
    {
        if (!Auth::check()) {
            // Redirect to login if not authenticated
            return redirect()->route('login')->with('error', 'You must log in to access this page.');
        }
        $user = Auth::user(); // Get the authenticated user
        if ($user->role === 'user') {
            return redirect()->intended('/landing'); // Redirect to admin dashboard
        }
        return view('admin.dashboard');
    }

    public function manageuser()
    {
        if (!Auth::check()) {
            // Redirect to login if not authenticated
            return redirect()->route('login')->with('error', 'You must log in to access this page.');
        }
        $user = Auth::user(); // Get the authenticated user
        if ($user->role === 'user') {
            return redirect()->intended('/landing'); // Redirect to admin dashboard
        }
        $users = customer::where('role', 'user')->get();
        return view('admin.manageuser', compact('users'));
    }

    public function deleteuser($id)
    {
        $user = customer::find($id);

        if ($user) {
            if ($user->role === 'user') {
                $user->delete();
                return redirect()->route('manageuser')->with('success', 'User berhasil dihapus');
            } else {
                return redirect()->route('manageuser')->with('error', 'Admin cannot be deleted');
            }
        } else {
            return redirect()->route('manageuser')->with('error', 'User not found');
        }
    }
}
