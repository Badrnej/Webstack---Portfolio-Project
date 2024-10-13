<?php

namespace App\Http\Controllers;

use App\Models\commende;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommendeController extends Controller
{
    public function store(Request $request){
        $user = Auth::user();
        if ($user->can('gere les Commandes')) {
            $validateDta=$request->validate([
                'status'=>'required|string',
                'lest_product' => 'required|string',
                'in_client' => 'required|integer',
                'in_user'=>'required|integer',
            ]);
    
            $commende=commende::create($validateDta);
            if($commende){
                return response()->json([
                'success'=>'commende created successfully'
            ],200);
            }else{
                return response()->json([
                    'error'=>'commende not created'
                ],500);
            }
        }else{
            return response()->json([
                'error'=>'Non autorisé'
            ],500);
        }
    }

    public function show_all(Request $reques){
        $commende=commende::paginate(10);
        return response()->json([
            $commende
        ],200);
    } 

    public function show(Request $reques){
        $id=$reques->id;
        $commende=commende::find($id);
        if($commende){
            return response()->json([
                $commende
                ],200);
        }
    }

    public function update(Request $request,$id){
        $user = Auth::user();
        if ($user->can('gere les Commandes')) {
            $commende = commende::findOrFail($id);

            $validatedData = $request->validate([
                'status'=>'nullable|string',
                'lest_product' => 'nullable|string',
                'in_client' => 'nullable|integer',
                'in_user'=>'nullable|integer',
            ]);
            $commende->update($validatedData);
            return response()->json($commende);
        }else{
            return response()->json([
                'error'=>'Non autorisé'
            ],500);
        }
        
    }

    public function destroy($id){
        $user = Auth::user();
        if ($user->can('gere les Commandes')) {
            $commende = commende::findOrFail($id);
            $commende->delete();
            return [
                'success' => 'commende deleted successfully'
            ];
        }else{
            return response()->json([
                'error'=>'Non autorisé'
            ],500);
        }
        
    }
}
