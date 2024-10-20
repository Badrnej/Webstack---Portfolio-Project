<?php

namespace App\Http\Controllers;

use App\Models\client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{

    public function store(Request $request) {
        $user = Auth::user();
    
        $validatedData = $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);
    
        $clientData = [
            'name' => $validatedData['firstName'] . ' ' . $validatedData['lastName'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
        ];
    
        $client = Client::create($clientData);
    
        return response()->json($client, 201);
    }

    public function show_all(Request $reques){
        $clients = Client::all();
        return response()->json($clients);

    }

    public function show(Request $reques){
        $id=$reques->id;
        $client=client::find($id);
        if($client){
            return response()->json([
                $client
                ],200);
        }
    }

    public function update(Request $request, $id) {
        $user = Auth::user();
        $client = Client::findOrFail($id);
    
        $validatedData = $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email|unique:clients,email,' . $id,
            'phone' => 'required|string',
            'address' => 'required|string',
            'siret' => 'nullable|string',
        ]);
    
        $clientData = [
            'name' => $validatedData['firstName'] . ' ' . $validatedData['lastName'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'siret' => $validatedData['siret'] ?? null,
        ];
    
        $client->update($clientData);
    
        return response()->json($client);
    }

    public function destroy($id){
        $user = Auth::user();
            $client = client::findOrFail($id);
            $client->delete();
            return [
                'success' => 'client deleted successfully'
            ];
    }

}
