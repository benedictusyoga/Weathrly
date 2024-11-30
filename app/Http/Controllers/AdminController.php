<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminview(){
        return view('admin.dashboard');
    }

    public function manageuser(){
        $users = customer::where('role', 'user')->get();
        return view('admin.manageuser',compact('users'));
    }

    public function deleteuser($id){
        $user = customer::find($id);

        if($user) {
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
