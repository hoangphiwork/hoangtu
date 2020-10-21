<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $product_new = Product::orderBy('id','desc')->take(8)->get();
        $product = Product::where('sale', '>', 0)->orderBy('sale', 'desc')->take(4)->get();

        return view('frontend.page.home', compact('product', 'product_new'));
    }

    public function search(Request $request)
    {
        $data['products'] = Product::where('name','like','%'.$request['search'].'%')->paginate(16);
        $data['search'] = $request['search'];
        return view('frontend.page.search',$data);
    }
}
