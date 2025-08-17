<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $cart = cart::with('product')->get();
            return response()->json(['success' => true, 'data' => $cart], 200);
        }
        catch(\Exception $e){
            return response()->json([ 'success' => false, 'error' => $e->getMessage()], 500);
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
            $cart =cart::where('pr_fk', $request->pr_fk)->where('user_fk', $request->user_fk)->first();
            
            if($cart){
                $cart->quantity += 1;
                $cart->save();
            }
            else
            $cart=cart::create($request->all());
            return response()->json(['success' => true, 'data' => $cart], 200);
        }
        catch(\Exception $e){
            return response()->json([ 'success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try{
            
            $cart=cart::find($id);
            if($request->action=='plus')
            $cart->quantity += 1;
            else if($request->action=='minus' && $cart->quantity>1 )
            $cart->quantity -= 1;
            $cart->save();
            return response()->json(['success' => true, 'data' => $cart,'action'=>$request->action], 200);
        }
        catch(\Exception $e){
            return response()->json([ 'success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $cart = cart::find($id);
            $cart->delete();
            return response()->json(['success' => true,'message' => 'cart deleted successfully'], 200);
        }
        catch(\Exception $e){
            return response()->json([ 'success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
