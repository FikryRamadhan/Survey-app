<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index(){
        $data = User::all();

        return view('admin.users.index', [
            'users' => $data
        ]);
    }

    public function store(Request $request){
        // dd($request);
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:6',
                'password_confirmation' => 'required|same:password',
                'role' => 'required'
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);

            return redirect()->route('user.index')->with('success', 'Create data successful!');
        } catch (Exception $e) {
            return redirect()->route('user.index')->with('error', $e->getMessage());
        }     
    }

    public function delete(User $user){
        try {
            $user->delete();
            return redirect()->route('user.index')->with('success', 'Delete data successful!');
        } catch (Exception $e) {
            return redirect()->route('user.index')->with('error', $e->getMessage());
        }   
    }
}
