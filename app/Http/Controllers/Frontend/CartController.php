<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Detail;
use App\Models\Order;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        return view('frontend.page.cart');
    }

    public function create($id){
        $product = Product::find($id);
        \Cart::add([
            'id' => $id,
            'name' => $product->name,
            'quantity' => 1,
            'price' => $product->cost,
            'attributes' => [
                'images' => $product->image
            ]
        ]);
        return redirect()->route('cart.index');
    }

    public function update(Request $request){
        \Cart::update($request->id, array('quantity' => $request->quantity - \Cart::get($request->id)->quantity));
    }

    public function destroy($id){
        if($id=="DelAll"){
            \Cart::clear();
        }else{
            \Cart::remove($id);
        }
        return redirect()->route('cart.index');
    }

    public function store(Request $request){
        if(!\Cart::isEmpty()){
            $email_data['infor'] = $request->all();
            $email_data['carts'] = \Cart::getContent();
            $email_data['total'] = \Cart::getTotal();

            $order = new Order();
            $order->name = $request->name;
            $order->phone = $request->phone;
            $order->customer_address = $request->add;
            $order->cost_total = $email_data['total'];
            $order->status = 1;
            $order->save();

            foreach($email_data['carts'] as $detail){
                $dt = new Detail();
                $dt->order_id = $order->id;
                $dt->product_id = $detail->id;
                $dt->count = $detail->quantity;
                $dt->save();
            }

            \Cart::clear();
            return redirect('complete/'.$order->id."/".$order->name.".html");
        }else{
            return back()->with('errorcart','Giỏ Hàng Trống');
        }
    }

    public function complete($id){
        return view('frontend.page.complete');
    }

}
