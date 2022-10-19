<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::get();
        $products = Product::select('id', 'name')
                                ->get();

        return view('pages.order.index', compact('orders', 'products'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'total' => ['required', 'integer']
        ]);


        $order = $request->user()
                ->orders()
                ->create([
                    'total' => 0,
                    'status' => Order::UNPAID
                ])
                ->products()
                ->attach(
                    $request->input('product_id'),
                    ['amount' => $request->input('total')]
                );

        return redirect()->back();
    }
}
