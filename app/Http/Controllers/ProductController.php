<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::get();

        return view('products', ['products' => $products]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'details' => ['required'],
            'stock' => ['required'],
            'price' => ['required']
        ]);

        Product::create([
            'name' => $request->input('name'),
            'details' => $request->input('details'),
            'stock' => $request->input('stock'),
            'price' => $request->input('price')
        ]);

        return redirect()
                ->back()
                ->with('success', 'Data produk berhasil disimpan');  ;
    }
}
