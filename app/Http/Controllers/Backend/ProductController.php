<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\Repository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    protected $product;
    protected $category;

    public function __construct(Product $product, Category $category)
    {
        $this->product = new Repository($product);
        $this->category = new Repository($category);
    }

    public function index()
    {
        $products = $this->product->all();
        return view('backend.page.product.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->category->all();
        return view('backend.page.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if(!File::isDirectory('upload')){
            File::makeDirectory('upload', 0777, true, true);
        }

        if(!File::isDirectory('upload/product')){
            File::makeDirectory('upload/product', 0777, true, true);
        }
        $path = public_path('upload/product/');

        $slug = Str::slug($request['name']);
        $current_date_time = Carbon::now()->format('d-m-Y');
        $name_photo = $slug.'-'.$current_date_time."-".Str::random(8);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $photo = $name_photo."-".$name;
            while (file_exists($path.'/'.$photo)) {
                $photo = $slug['slug'].'-'.$current_date_time."-".Str::random(5)."-". $photo;
            }
            $file -> move($path,$photo);
            $imageName = $photo;
        }else {
            $imageName = "";
        }

        $input = [
            'name' => $request['name'],
            'slug' => $slug,
            'image' => $imageName,
            'price' => $request['price'],
            'cost' => $request['price'] * 1.2,
            'des' => $request['des'],
            'amount' => $request['amount'],
            'cate_id' => $request['cate_id']
        ];

        $this->product->create($input);
        return redirect()->route('product.index')->with('notice', 'Thêm thành công sản phẩm '.$request['name']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $product = $this->product->show($id);
        $categories = $this->category->all();
        if (! $product) {
            return view('backend.page.error.404');
        }
        return view('backend.page.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = $this->product->show($id);
        $path = public_path('upload/product/');

        $slug = Str::slug($request['name']);
        $current_date_time = Carbon::now()->format('d-m-Y');
        $name_photo = $slug.'-'.$current_date_time."-".Str::random(8);
        if ($request->hasFile('image')) {
            File::delete($path.'/'.$product->image);
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $photo = $name_photo."-".$name;
            while (file_exists($path.'/'.$photo)) {
                File::delete($path.'/'.$photo);
                $photo = $slug['slug'].'-'.$current_date_time."-".Str::random(5)."-". $photo;
            }
            $file -> move($path,$photo);
            $imageName = $photo;
        }else {
            $imageName = $request['iconname'];
        }

        $input = [
            'name' => $request['name'],
            'slug' => $slug,
            'image' => $imageName,
            'price' => $request['price'],
            'cost' => $request['cost'],
            'des' => $request['des'],
            'amount' => $request['amount'],
            'cate_id' => $request['cate_id'],
            'status' => $request['status']
        ];

        $this->product->update($input, $id);
        return redirect()->route('product.index')->with('notice', 'Cập nhật thành công sản phẩm '.$request['name']);
    }

    public function destroy($id)
    {
        $pd = $this->product->show($id);
        if (! $pd){
            return view('backend.page.error.404');
        }
        $path = public_path('upload/product/');
        if (file_exists($path.$pd->image)) {
            File::delete($path.$pd->image);
        }
        $pd->delete($id);
        return back()->with('notice', 'Xóa thành công sản phẩm');
    }
}
