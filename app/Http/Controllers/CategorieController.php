<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
        $categorie = Categorie::all();
        return response()->json(['status' => 'success', 'data' => $categorie]);
        }
        catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e]);
        }
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
        try {
            $request->validate([
                'cat_name' => 'required|string|max:50',
                'cat_name_en' => 'required|string|max:50',
                'cat_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            $imageName = time() . '.' . $request->file('cat_image')->extension();
            $request->file('cat_image')->move(public_path('categories'), $imageName);
            $catImagePath = 'categories/' . $imageName;

            // $catImagePath = $request->file('cat_image')->store('categorie', 'public');

            $categorie = Categorie::create([
                'cat_name' => $request->cat_name,
                'cat_name_en' => $request->cat_name_en,
                'cat_image' => $catImagePath
            ]);
            return response()->json(['status' => 'success','message' => 'Category created successfully','data' => $categorie], 201);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error','message' => 'Validation failed','errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error','message' => 'Failed to create category','error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie $categorie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        //
    }
}
