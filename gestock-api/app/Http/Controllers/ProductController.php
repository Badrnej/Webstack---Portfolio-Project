<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function store(Request $request){
        $user = Auth::user();
        if ($user->can('gere les produit')) {
            $validateDta=$request->validate([
                'name'=>'required|string',
                'qaliti' => 'required|string',
                'price' => 'required|string',
                'in_category'=>'required|integer',
                'in_fournisseur' => 'required|integer',
                'in_user' => 'required|integer',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
            ]);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('img'), $imageName);
                $validateDta['image'] = 'img/' . $imageName;
            }
    
            $Product=Product::create($validateDta);
            if($Product){
                return response()->json([
                'success'=>'Product created successfully'
            ],200);
            }else{
                return response()->json([
                    'error'=>'Product not created'
                ],500);
            }
        }else{
            return response()->json([
                'error'=>'Non autorisé'
            ],500);
        }
    }

    public function show_all(Request $reques){
        $Product=Product::paginate(10);
        return response()->json([
            $Product
        ],200);
    } 

    public function show(Request $reques){
        $id=$reques->id;
        $Product=Product::find($id);
        if($Product){
            return response()->json([
                $Product
                ],200);
        }
    }

    public function update(Request $reques,$id){
        $user = Auth::user();
        if ($user->can('gere les produit')) {
            $Product = Product::findOrFail($id);

            $validatedData = $reques->validate([
                'name' => 'nullable|string',
                'qaliti' => 'nullable|string',
                'price' => 'nullable|string',
                'in_category' => 'nullable|integer',
                'in_fournisseur' => 'nullable|integer',
                'in_user' => 'nullable|integer',
            ]);
            $Product->update($validatedData);
            return response()->json($Product);
        }else{
            return response()->json([
                'error'=>'Non autorisé'
            ],500);
        }
        
    }

    public function destroy($id){
        $user = Auth::user();
        if ($user->can('gere les produit')) {
            $Product = Product::findOrFail($id);
            $Product->delete();
            return [
                'success' => 'Product deleted successfully'
            ];
        }else{
            return response()->json([
                'error'=>'Non autorisé'
            ],500);
        }
        
    }
}