<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();

        return view('pages.product.products', ['products' => $products]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:25'],
            'details' => ['required', 'string'],
            'stock' => ['required', 'integer'],
            'price' => ['required', 'integer']
        ]);

        Product::create([
            'name' => $request->input('name'),
            'details' => $request->input('details'),
            'stock' => $request->input('stock'),
            'price' => $request->input('price')
        ]);

        return redirect()
                ->back()
                ->with('success', 'Data produk berhasil disimpan');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => ['required', 'exists:products,id']
        ]);
        
        $product = Product::find($request->input('id'));
        $product->delete();
        
        return redirect()
                ->back()
                ->with('success', 'Data produk berhasil hapus');
    }

    public function show($id)
    {
        $product = Product::find($id);

        return view('pages.product.products-edit', ['product' => $product]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:25'],
            'details' => ['required', 'string'],
            'stock' => ['required', 'integer'],
            'price' => ['required', 'integer']
        ]);
        
        $product = Product::find($id);
        $product->update([
            'name' => $request->input('name'),
            'details' => $request->input('details'),
            'stock' => $request->input('stock'),
            'price' => $request->input('price')
        ]);

        return redirect()
                ->route('products')
                ->with('success', 'Data dengan id ' . $id . ' produk berhasil update');
    }
}
