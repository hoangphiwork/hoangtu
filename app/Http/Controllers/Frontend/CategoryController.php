<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $cate = Category::where('slug', $slug)->first();
        if ($cate){
            $products = Product::where('cate_id', $cate->id)->paginate(16);
            $category = Category::find($cate->id);
            return view('frontend.page.category', compact('products', 'category'));
        }else{
            abort(404);
        }

    }
}
