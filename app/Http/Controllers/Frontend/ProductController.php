<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $product = Product::where('slug', $slug)->first();
        if ($product) {
            return view('frontend.page.product_detail', compact('product'));
        } else {
            abort(404);
        }
    }

    public function getAll()
    {
        $products = Product::paginate(16);
        return view('frontend.page.product_all', compact('products'));
    }
}
