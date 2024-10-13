<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function GererFournisseur($id){
        $user = Auth::user();
        if ($user->can('gere les Permission')) {
            $permission = Permission::where('name', 'gere les Fournisseurs')->first();
            $user = User::find($id);
            $user->givePermissionTo($permission);
            return response()->json(['message' => 'ajoutée avec succès']);
        }else{
            return response()->json([
                'error'=>'Non autorisé'
            ],500);
        }
        
    }

    public function GererClient($id){
        $user = Auth::user();
        if ($user->can('gere les Permission')) {
            $permission = Permission::where('name', 'gere les Clients')->first();
            $user = User::find($id);
            $user->givePermissionTo($permission);
            return response()->json(['message' => 'ajoutée avec succès']);
        }else{
            return response()->json([
                'error'=>'Non autorisé'
            ],500);
        }
        
    }

    public function GererUsrs($id){
        $user = Auth::user();
        if ($user->can('gere les Permission')) {
            $permission = Permission::where('name', 'gere les Users')->first();
            $user = User::find($id);
            $user->givePermissionTo($permission);
            return response()->json(['message' => 'ajoutée avec succès']);
        }else{
            return response()->json([
                'error'=>'Non autorisé'
            ],500);
        }
        
    }

    public function GererPermission($id){
        $user = Auth::user();
        if ($user->can('gere les Permission')) {
            $permission = Permission::where('name', 'gere les Permission')->first();
            $user = User::find($id);
            $user->givePermissionTo($permission);
            return response()->json(['message' => 'ajoutée avec succès']);
        }else{
            return response()->json([
                'error'=>'Non autorisé'
            ],500);
        }
        
    }
}
