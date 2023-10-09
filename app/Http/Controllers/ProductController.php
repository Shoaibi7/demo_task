<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::orderBy('id','DESC')->get();
       return view('product.index',compact('products'));
    }
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required',
            // Add more validation rules for other fields
        ]);

        $product = new Product();
        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        $product->save();
    

        return response()->json(['message' => 'Product data saved successfully']);
    }
    public function edit(Product $product){

        return response()->json($product);
    }
    public function update(Request $request,Product $product)
    {
        
        $rules = [
            'name' => 'required|string|max:255',
            'price' => 'required',
        ];
        
        $validatedData = $this->validate($request, $rules);

    $product->update($validatedData);
    

        return response()->json(['success' => true]);
    }
        public function destroy(Product $product)
    {
    
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }

    public function stripe(){
        return view('payment.stripe');
    }
}
