<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with('inventory')->get();
        return response()->json(['products' => $products]);
    }

    public function store(Request $request){
        $product = Product::create($request->all());
        $product -> inventory()->create($request->input('inventory'));
        return response()->json($product, 201);
    }

    public function update(Request $request, $id){
        $product = Product::find($id);
        $product -> update($request->all());
        $product -> inventory()->update($request->input('inventory'));
        return response()->json(['product'=> $product]);
    }
    
    public function destroy($id){
        $product = Product::find($id);
        $product->inventory()->delete(); 
        $product->delete();
        return response()->json(['message'=>"successfully deleted "]);
    }    
}
