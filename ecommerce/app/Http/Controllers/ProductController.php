<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       $products = Product::with('productCategory');

        if($request->has('search') && $request->search != '') {
            $products = $products->where('name', 'like', '%' . $request->search . '%')
                        ->orWhereHas('productCategory', function($query) use ($request) {
                            $query->where('name', 'like', '%' . $request->search . '%');
                        });
        }
        
        if($request->has('order_by') && $request->order_by != '' && in_array($request->order_by, ['name', 'price', 'stock'])) {
            $orderDirection = $request->has('order_direction') && in_array($request->order_direction, ['asc', 'desc']) ? $request->order_direction : 'asc';
            $products = $products->orderBy($request->order_by, $orderDirection);
        }
        
        $products = $products->paginate(10);
        return view('admin.products.index', compact('products'));
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
