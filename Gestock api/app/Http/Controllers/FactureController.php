<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FactureController extends Controller
{
    public function store(Request $request){
        try {
            Log::info('Starting facture creation', ['request' => $request->all()]);
            
            $user = Auth::user();
       

            $validatedData = $request->validate([
                'price_totale' => 'required|numeric',
                'les_prodact' => 'required|string',
                'in_client' => 'required|integer',
            ]);
            
            $validatedData['in_user'] = $user->id;
            
            Log::info('Creating facture with data', ['data' => $validatedData]);
            
            $facture = Facture::create($validatedData);
            $facture->load(['client', 'user']);
            
            Log::info('Facture created successfully', ['facture_id' => $facture->id]);
            
            return response()->json($facture, 201);
            
        } catch (\Exception $e) {
            Log::error('Error creating facture', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'error' => 'Failed to create facture',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show_all(Request $request) {
        try {
            Log::info('Fetching all factures');
            $factures = Facture::all();
            return response()->json($factures, 200);
        } catch (\Exception $e) {
            Log::error('Error fetching factures', [
                'error' => $e->getMessage()
            ]);
            return response()->json(['error' => 'Failed to fetch factures'], 500);
        }
    }

    public function show(Request $request){
        try {
            $id = $request->id;
            Log::info('Fetching facture', ['id' => $id]);
            
            $facture = Facture::with(['client', 'user'])->find($id);
            
            if (!$facture) {
                Log::warning('Facture not found', ['id' => $id]);
                return response()->json(['error' => 'Facture not found'], 404);
            }
            
            return response()->json($facture, 200);
            
        } catch (\Exception $e) {
            Log::error('Error fetching facture', [
                'error' => $e->getMessage(),
                'id' => $request->id
            ]);
            return response()->json(['error' => 'Failed to fetch facture'], 500);
        }
    }

    public function update(Request $request, $id){
        try {
            Log::info('Starting facture update', ['id' => $id, 'request' => $request->all()]);
            
            $user = Auth::user();
        
            $facture = Facture::findOrFail($id);

            $validatedData = $request->validate([
                'price_totale' => 'sometimes|numeric',
                'les_prodact' => 'sometimes|string',
                'in_client' => 'sometimes|integer',
                'status' => 'sometimes|string|in:Payée,En attente,En retard'
            ]);

            $facture->update($validatedData);
            $facture->load(['client', 'user']);
            
            Log::info('Facture updated successfully', ['facture_id' => $facture->id]);
            
            return response()->json($facture, 200);
            
        } catch (\Exception $e) {
            Log::error('Error updating facture', [
                'error' => $e->getMessage(),
                'id' => $id
            ]);
            return response()->json(['error' => 'Failed to update facture'], 500);
        }
    }

    public function destroy($id){
        try {
            Log::info('Starting facture deletion', ['id' => $id]);
            
            $user = Auth::user();
            if (!$user->can('gere les Factures')) {
                Log::warning('Unauthorized facture deletion attempt', ['user_id' => $user->id]);
                return response()->json(['error' => 'Non autorisé'], 403);
            }

            $facture = Facture::findOrFail($id);
            $facture->delete();
            
            Log::info('Facture deleted successfully', ['id' => $id]);
            
            return response()->json([
                'success' => 'Facture deleted successfully'
            ], 200);
            
        } catch (\Exception $e) {
            Log::error('Error deleting facture', [
                'error' => $e->getMessage(),
                'id' => $id
            ]);
            return response()->json(['error' => 'Failed to delete facture'], 500);
        }
    }
}