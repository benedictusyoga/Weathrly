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

    public function manageuser(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must log in to access this page.');
        }

        $user = Auth::user();
        if ($user->role === 'user') {
            return redirect()->intended('/landing');
        }

        $search = $request->input('search'); // Get search query
        $sortColumn = $request->input('sort', 'id'); // Default sort column
        $sortDirection = $request->input('direction', 'asc'); // Default sort direction

        $users = customer::where('role', 'user')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%");
            })
            ->orderBy($sortColumn, $sortDirection) // Apply sorting
            ->paginate(10);

        return view('admin.manageuser', compact('users', 'sortColumn', 'sortDirection'));
    }



    public function deleteuser($id)
    {
        $user = customer::find($id);

        if ($user) {
            if ($user->role === 'user') {
                $defaultProfilePicturePath = 'profile_pictures/user(1).png';
                if ($user->profile_picture && $user->profile_picture !== $defaultProfilePicturePath) {
                    // Delete the previous profile picture from S3
                    \Storage::disk('s3')->delete($user->profile_picture);
                }
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
