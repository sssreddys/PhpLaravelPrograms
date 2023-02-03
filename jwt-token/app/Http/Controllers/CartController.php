<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    

    public function index()
    {
        //
        $cart = Cart::all();
        return response()->json([
            'status' => 'success',
            'cart' => $cart,
        ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        

        $request->validate([
            'customer_id' => 'required|string|max:255',
            'product_id' => 'required|string|max:255',
            'quantity' => 'required|string|max:255',
        ]);

        $cart = Cart::create([
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Cart created successfully',
            'cart' => $cart,
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(cart $id)
    {
        //

        $cart = Cart::find($id);
        return response()->json([
            'status' => 'success',
            'cart' => $cart,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //

        $request->validate([
            'customer_id' => 'required|string|max:255',
            'product_id' => 'required|string|max:255',
            'quantity' => 'required|string|max:255',
        ]);

        $cart = Cart::find($id);
        $cart->customer_id = $request->customer_id;
        $cart->product_id = $request->product_id;
        $cart->quantity = $request->quantity;
        $cart->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Cart updated successfully',
            'cart' => $cart,
        ]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $cart = Cart::find($id);
        $cart->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Cart deleted successfully',
            'cart' => $cart,
        ]);



    }
}
