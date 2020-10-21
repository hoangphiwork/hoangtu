<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    protected $model;

    public function __construct(User $user)
    {
        $this->model = new Repository($user);
    }

    public function index()
    {
        if (Auth::check()){
            return redirect()->route('dashboard');
        }else{
            $user = $this->model->all();
            return view('backend.auth.login', compact('user'));
        }
    }

    public function auth(Request $request)
    {
        $validator = Validator::make($request->only('email', 'password'), [
           'email' => 'required|email',
           'password' => 'required|min:6'
        ]);

        $credentials = [
            'email' => $request['email'],
            'password' => $request['password']
        ];

        if ($validator->validated()){
            if (Auth::attempt($credentials)){
                return redirect()->route('dashboard');
            }else{
                return back()->with('notice', 'Tài khoản hoặc mật khẩu không chính xác');
            }
        }
    }

    public function create()
    {
        return view('backend.auth.register');
    }

    public function store(Request $request)
    {
        $info = [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ];

        $validator = Validator::make($info, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ],[
            'name.min' => 'Họ tên phải lớn hơn 3 kí tự',
            'email.unique' => 'Email đã tồn tại',
            'password.min' => 'Mật khẩu phải lớn hơn 6 kí tự'
        ]);
        if ($validator->validated()){
            $this->model->create($info);
        }
        return redirect()->route('login.index')->with('notice', 'Đăng kí thành công. Đăng nhập để tiếp tục');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.index')->with('notice', 'Đăng xuất thành công.');
    }
}
