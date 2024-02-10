<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;

use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::table('role_user')
        ->join('users', 'role_user.user_id', '=', 'users.id')
        ->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->select('users.*', 'roles.name as role_name')
        ->get();
        $roles = Role::all();
        return view('user',['users'=>$users,'roles'=>$roles]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'role_id'=>'required',
        ]);
        
        // Enregistrer l'utilisateur
        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->save();
        $user_id = $users->id;
        $role_id = $request->role_id;
        $userRole = new UserRole();
        $userRole->user_id = $user_id;
        $userRole->role_id = $role_id;
        $userRole->save();
        
        return redirect('/user');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::findOrFail($id);
        $roles=Role::all();
        return view("editUser", ["user" => $users,'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = User::findOrFail($id);
        $users->name = $request->input("name");
        $users->email = $request->input("email");
        $users->role = $request->input("role");
        $users->save();
        session()->flash('status', 'utilisateur modifier avec successe');
        return redirect()->route("books.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    {
        $user->delete();
        return redirect()->route('user.index');
    }
}
