<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::join('product_categories', 'products.cat_id', '=', 'product_categories.id')
            ->where('products.company_id', auth()->id())->orderBy('products.id', 'desc')
            ->select('products.id', 'products.name', 'products.price', 'product_categories.p_cat_name')
            ->get();
        return view('company.product.index', compact('products'));
    }


    public function create()
    {
        $categories = ProductCategory::where('company_id', auth()->id())
            ->select('p_cat_name', 'id')
            ->get();
        return view('company.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'category' => 'required',
            'price' => 'required',
        ]);
        Product::insert([
            'name' => $request->name,
            'cat_id' => $request->category,
            'price' => $request->price,
            'company_id' => auth()->id(),
            'created_by' => auth()->id(),
        ]);
        return redirect()->route('product.index')->with('success', 'Product added successfully');
    }


    public function show(Product $product)
    {
        //
    }


    public function edit($id)
    {
        $categories = ProductCategory::where('company_id', auth()->id())->select('p_cat_name', 'id')->get();
        $id = Crypt::decrypt($id);
        $product = Product::find($id);
        return view('company.product.edit', compact('product', 'categories'));
    }


    public function update(Request $request, Product $product)
    {
        if (auth()->id() == $product->company_id) {
            $request->validate([
                'name' => 'required|max:255',
                'category' => 'required',
                'price' => 'required',
            ]);
            $product->name = $request->name;
            $product->cat_id = $request->category;
            $product->price = $request->price;
            $product->updated_by = auth()->id();
            $product->save();
            return redirect()->route('product.index')->with('success', 'Product updated successfully');
        } else {
            abort(403);
        }
    }


    public function destroy(Product $product)
    {
        //
    }
}
