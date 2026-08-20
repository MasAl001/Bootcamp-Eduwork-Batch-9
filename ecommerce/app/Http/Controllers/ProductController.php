<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
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
        $productCategories = ProductCategory::all();
        return view('admin.products.create', compact('productCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        dd($request->all());
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'product_category_id' => 'required|exists:product_categories,id',
            'image' => 'required|string', // Base64 image
        ]);

        $imagePath = null;
        
        // Handle base64 cropped image
        if ($validated['image'] && strpos($validated['image'], 'data:image') === 0) {
            // Extract base64 data
            $imageData = substr($validated['image'], strpos($validated['image'], ',') + 1);
            $imageData = base64_decode($imageData);
            
            // Generate unique filename
            $filename = 'product_' . time() . '_' . uniqid() . '.jpg';
            $path = storage_path('app/public/products');
            
            // Create directory if it doesn't exist
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            
            // Save the image
            file_put_contents($path . '/' . $filename, $imageData);
            $imagePath = 'products/' . $filename;
        }

        // Create product
        Product::create([
            'name' => $validated['name'],
            'slug' => \Illuminate\Support\Str::slug($validated['name']),
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'product_category_id' => $validated['product_category_id'],
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
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
        $productCategories = ProductCategory::all();
        return view('admin.products.edit', compact('product', 'productCategories'));
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
