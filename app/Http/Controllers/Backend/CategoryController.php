<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    protected $model;

    public function __construct(Category $category)
    {
        $this->model = new Repository($category);
    }

    public function index()
    {
        $categories = $this->model->all();
        return view('backend.page.category.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.page.category.create');
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request['name'],
            'slug' => Str::slug($request['name']),
            'description' => $request['description']
        ];
        $validator = Validator::make($data, [
            'name' => 'required',
        ], [
            'name.required' => 'Tên danh mục sản phẩm là trường bắt buộc'
        ]);
        if ($validator->validated()){
            $this->model->create($data);
        }
        return redirect()->route('category.index')->with('notice', 'Thêm thành công loại sản phẩm có tên là '.$data['name']);
    }

    public function edit($id)
    {
        $category = $this->model->show($id);
        if (! $category){
            return view('backend.page.error.404');
        }
        return view('backend.page.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = $this->model->show($id);
        if (! $category){
            return view('backend.page.error.404');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => 'Tên danh mục sản phẩm là trường bắt buộc'
        ]);
        if ($validator->validated()){
            $category->fill($request->all())->save();
        }
        return redirect()->route('category.index')->with('notice', 'Cập nhật thành công loại sản phẩm '.$request['name']);
    }

    public function destroy($id)
    {
        $category = $this->model->show($id);
        if (! $category){
            return view('backend.page.error.404');
        }
        $category->delete($id);
        return back()->with('notice', 'Xóa thành công loại sản phẩm');
    }
}
