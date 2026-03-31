<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')->get();
        $products = Product::all();

        return view('orders.index', compact('orders', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required'
        ]);

        Order::create([
            'customer_name' => $request->customer_name
        ]);

        return back()->with('success', 'Tạo đơn thành công');
    }

    public function addItem(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        OrderItem::create($request->all());

        return back()->with('success', 'Thêm sản phẩm');
    }

    public function destroyItem(OrderItem $item)
    {
        $item->delete();
        return back()->with('success', 'Đã xóa');
    }
}