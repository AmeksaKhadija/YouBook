<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserRole;

use App\Models\User;

class AuthController extends Controller
{

    public function signup(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);

    $user = new User();
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));
    $user->save();
    $user_id = $user->id;
    $userRole = new UserRole();
    $userRole->user_id = $user_id;
    $userRole->role_id=1;
    $userRole->save();

    return redirect()->route('signin')->with('success', 'Votre compte a été créé avec succès. Connectez-vous maintenant.');
}

    
    public function showsignup()
    {
        return view("signup");
    }


    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Invalid email or password');
        }
       
        $roles = $user->roles()->pluck('name')->toArray(); 
            session(['user_id' => $user->id, 'user_roles' => $roles]);


            if (in_array('bibliothécaire', $roles)) {
                return redirect('books');
            } else {
                return redirect('AllBooks');
            }
       
    }

    public function showsignin()
    {
        return view("signin");
    }

}