<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $favorite=Favorite::all();
            return response()->json(['success' => true, 'data'=>$favorite]);
        }
        catch(\Exception $e){
            return response()->json(['success' => false, 'message' => $e]);
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
        try{
            $data=$request->all();
            $favorite=Favorite::where('pr_fk','=',$request->pr_fk)->first();
            if($favorite){
            return response()->json(['status'=>false,"error"=>"alredy exist"]);
            }
            $favorite=Favorite::create($data);
            return response()->json(['status'=>true,'data'=>$favorite]);
        }
        catch(\Exception $e){
            return response()->json(['status'=>false,"error"=>$e->getMessage()]);
        }
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorite $favorite)
    {
        //
    }
}
