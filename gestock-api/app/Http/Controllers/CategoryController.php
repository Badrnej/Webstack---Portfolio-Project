<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function store(Request $reques){
        $user = Auth::user();
        if ($user->can('gere les Categories')) {
            $validateDta=$reques->validate([
                'name'=>'required|string',
            ]);

            $Category=Category::create($validateDta);
            if($Category){
                return response()->json([
                'success'=>'Category created successfully'
            ],200);
            }else{
                return response()->json([
                    'error'=>'Category not created'
                ],500);
            }
        }else{
            return response()->json([
                'error'=>'Non autorisé'
            ],500);
        }
        
        
    }

    public function show_all(Request $reques){
        $Category=Category::get();
        return response()->json([
            $Category
        ],200);
    } 

    public function show(Request $reques){
        $id=$reques->id;
        $Category=Category::find($id);
        if($Category){
            return response()->json([
                $Category
                ],200);
        }
    }

    public function update(Request $reques,$id){
        $user = Auth::user();
        if ($user->can('gere les Categories')) {
            $Category = Category::findOrFail($id);
            $validatedData = $reques->validate([
                'name' => 'nullable|string',
            ]);
            $Category->update($validatedData);
            return response()->json($Category);
        }else{
            return response()->json([
                'error'=>'Non autorisé'
            ],500);
        }
        
    }

    public function destroy($id){
        $user = Auth::user();
        if ($user->can('gere les Categories')) {
            $Category = Category::findOrFail($id);
            $Category->delete();
            return [
                'success' => 'Category deleted successfully'
            ];
        }else{
            return response()->json([
                'error'=>'Non autorisé'
            ],500);
        }
        
    }
}
