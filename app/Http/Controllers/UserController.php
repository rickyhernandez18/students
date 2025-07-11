<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(){
        //$users = User::all();
        $users = User::orderBy('id','desc')->get();
        //$users = User::withTrashed()->orderBy('id','desc')->get();
        return view('users.users',compact('users'));
    }

    public function create(){
        return view('users.add');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:Admin,Customer',
            'password' => 'required|string|min:6',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $filename = null;

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads',$filename); 
        }

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => bcrypt($validated['password']),
            'photo' => $filename
        ]);

        //php artisan storage:link connect public\storage to storage\app/public

        return redirect()->route('users.index')->with('success','User added successfully!');
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('users.edit',compact('user'));
    }

    public function update(Request $request, string $id){
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required|in:Admin,Customer',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $filename = $user->photo;

        if($request->hasFile('photo')){
            if($user->photo && Storage::exists('public/uploads/'. $user->photo))
            {
                Storage::delete('pulic/uploads/'.$user->photo);
            } 

            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads',$filename); 
        }

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'photo' => $filename
        ]);

        //php artisan storage:link connect public\storage to storage\app/public

        return redirect()->route('users.index')->with('success','User updated successfully!');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        
        if($user->photo && Storage::exists('public/uploads/'.$user->photo)){
            Storage::delete('public/uploads/'.$user->photo);
        }

        $user->delete();
        //$user->restore();
        return response()->json(['success'=>'User deleted successfully!']);
    }
}
