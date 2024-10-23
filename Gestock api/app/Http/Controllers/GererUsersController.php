<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GererUsersController extends Controller
{
    public function show_all(Request $request){
        $user = Auth::user();
            $users = User::with('permissions')->get();
            return response()->json($users, 200);
       
    }

    public function show(Request $request, $id){
        $user = Auth::user();
            $User = User::find($id);
            if ($User) {
                return response()->json($User, 200);
            }
            return response()->json(['error' => 'User not found'], 404);
       
    }

    public function store(Request $request){
        $user = Auth::user();
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            $newUser = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

        
    }

    public function update(Request $request, $id){
        $user = Auth::user();
            $User = User::find($id);
            if (!$User) {
                return response()->json(['error' => 'User not found'], 404);
            }

            $validatedData = $request->validate([
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|string|email|max:255|unique:users,email,' . $id,
                'password' => 'sometimes|string|min:8',
            ]);

            if (isset($validatedData['password'])) {
                $validatedData['password'] = Hash::make($validatedData['password']);
            }

            $User->update($validatedData);

            return response()->json($User, 200);
      
    }

    public function destroy($id){
        $user = Auth::user();
            $User = User::findOrFail($id);
            $User->delete();
            return response()->json(['success' => 'User deleted successfully'], 200);
      
    }
}