<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data['order'] = Order::whereDay('created_at', Carbon::now()->day)->where('status', 1)->count();
        $data['money'] = Order::whereDay('created_at', Carbon::now()->day)->where('status', 1)->sum('cost_total');
        $data['money_receive'] = $data['money'] * 0.2;

        $data['order_month'] = Order::whereMonth('created_at', Carbon::now()->month)->where('status', 3)->count();
        $data['order_month_false'] = Order::whereMonth('created_at', Carbon::now()->month)->where('status', 4)->count();
        $data['money_month'] = Order::whereMonth('updated_at', Carbon::now()->month)->where('status', 3)->sum('cost_total');
        $data['money_month_receive'] = $data['money_month'] * 0.2;
        $products = Product::all();
        return view('backend.page.dashboard.index', compact('data', 'products'));
    }

    public function getFormChangePass()
    {
        $user = Auth::user();
        return view('backend.auth.change_pass', compact('user'));
    }

    public function changePass(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6|max:32',
            're-password' => 'required|same:password'
        ], [
            'password.required' => 'Bạn chưa nhập mật khẩu',
            're-password.required' => 'Bạn chưa nhập lại mật khẩu',
            'password.min' => 'Mật khẩu phải lớn hơn 6 ký tự',
            'password.max' => 'Mật khẩu phải nhở hơn 32 ký tự',
            're-password.same' => 'Mật khẩu không trùng khớp.'
        ]);

        $user = Auth::user();
        $user['password'] = bcrypt($request['password']);
        $user->save();
        $name = $user['name'];
        return redirect()->route('dashboard')->with('notice', 'Đổi mật khẩu thành công cho tài khoản ' . $name . '.');
    }
}
