<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::paginate(8); // Fetch products with pagination (10 per page)
        return view('home',
            ['title' => 'Home'],
            compact('products')
        );
    }
}
