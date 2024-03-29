<?php
namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{   


    public function index(Request $request)
    {   
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {   
        $request['created_by'] = auth()->user()->id;
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
