<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FactureController extends Controller
{
    public function store(Request $request){
        $user = Auth::user();
        if ($user->can('gere les Factures')) {
            $validateDta=$request->validate([
                'price_totale'=>'required|numeric',
                'les_prodact' => 'required|string',
                'in_client' => 'required|integer',
                'in_user'=>'required|integer',
            ]);
    
            $Facture=Facture::create($validateDta);
            if($Facture){
                return response()->json([
                'success'=>'Facture created successfully'
            ],200);
            }else{
                return response()->json([
                    'error'=>'Facture not created'
                ],500);
            }
        }else{
            return response()->json([
                'error'=>'Non autorisé'
            ],500);
        }
    }

    public function show_all(Request $request) {
        $factures = Facture::all();
    
        // Check if the returned data is an array or a single object
            return response()->json($factures, 200);
        
        
    }
    public function show(Request $reques){
        $id=$reques->id;
        $Facture=Facture::find($id);
        if($Facture){
            return response()->json(
                $Facture
                ,200);
        }
    }

    public function update(Request $request,$id){
        $user = Auth::user();
        if ($user->can('gere les Factures')) {
            $Facture = Facture::findOrFail($id);

            $validatedData = $request->validate([
                'price_totale'=>'nullable|numeric',
                'les_prodact' => 'nullable|string',
                'in_client' => 'nullable|integer',
                'in_user'=>'nullable|integer',
            ]);
            $Facture->update($validatedData);
            return response()->json($Facture);
        }else{
            return response()->json([
                'error'=>'Non autorisé'
            ],500);
        }
        
    }

    public function destroy($id){
        $user = Auth::user();
        if ($user->can('gere les Factures')) {
            $Facture = Facture::findOrFail($id);
            $Facture->delete();
            return [
                'success' => 'Facture deleted successfully'
            ];
        }else{
            return response()->json([
                'error'=>'Non autorisé'
            ],500);
        }
        
    }
}
