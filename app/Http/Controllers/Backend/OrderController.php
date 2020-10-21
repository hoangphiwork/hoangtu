<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Detail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function getOrder()
    {
        $order = Order::where('status', 1)->orderBy('created_at', 'DESC')->get();
        $detail = Detail::all();
        $product = Product::all();
        return view('backend.page.order.index', compact('order', 'detail', 'product'));
    }

    public function getDelivery()
    {
        $order = Order::where('status', 2)->orderBy('created_at', 'DESC')->get();
        $detail = Detail::all();
        $product = Product::all();
        return view('backend.page.order.delivery', compact('order', 'detail', 'product'));
    }

    public function getShipped()
    {
        $order = Order::where('status', '>', 2)->orderBy('created_at', 'DESC')->get();
        $detail = Detail::all();
        $product = Product::all();
        return view('backend.page.order.shipped', compact('order', 'detail', 'product'));
    }

    public function deliveryOrder($id)
    {
        $status = Order::find($id);
        $st = $status->status;
        if ($st == 1) {
            $status->status = 2;
            $status->save();
            return redirect()->route('order.index')->with('notice', 'Đang giao hàng đơn #' . $id);
        }
    }

    public function deliveredOrder($id)
    {
        $status = Order::find($id);
        $st = $status->status;
        $detail = Detail::all();
        foreach ($detail as $dt) {
            if ($dt->order_id == $id) {
                $idProduct = $dt->product_id;
                $product = Product::find($idProduct);
                if ($dt->product_id == $product->id) {
                    $count = ($product->amount) - ($dt->count);
                    $sale = ($product->sale) + ($dt->count);
                    DB::table('products')->where('id', $idProduct)
                        ->update(['amount' => $count, 'sale' => $sale]);
                }
            }
        }
        if ($st == 2) {
            $status->status = 3;
            $status->save();
            return redirect()->route('order.delivery')->with('notice', 'Đã giao hàng đơn #' . $id);
        }
    }

    public function cancelOrder($id)
    {
        $status = Order::find($id);
        $st = $status->status;

        if ($st  == 1) {
            $status->status = 4;
            $status->save();
            return redirect()->route('order.index')->with('notice', 'Đã huỷ đơn #' . $id);
        }

        if ($st  == 2) {
            $status->status = 4;
            $status->save();
            return redirect()->route('order.delivery')->with('notice', 'Đã huỷ đơn #' . $id);
        }
    }

    public function getDetailOrder($id)
    {
        $order = Order::find($id);
        $detail = Detail::where('order_id', $order->id)->get();
        $product = Product::all();
        return view('backend.page.order.detail', compact('order', 'detail', 'product'));
    }
}
