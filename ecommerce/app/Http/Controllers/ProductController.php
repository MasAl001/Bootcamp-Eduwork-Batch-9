<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)
                        ->with('productCategory')
                        ->firstOrFail();
        $productRecommendations = Product::where('product_category_id', $product->product_category_id)
                                ->where('id', '!=', $product->id)
                                ->inRandomOrder()
                                ->take(4)
                                ->get();
        return view('product', 
                    [
                    'title' => $product->name,
                    'product' => $product
                    ],
                    compact('product', 'productRecommendations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
