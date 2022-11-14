<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show(Product $product)
    {
        //
    }


    public function edit(Product $product)
    {
        //
    }


    public function update(Request $request, Product $product)
    {
        //
    }


    public function destroy(Product $product)
    {
        //
    }
}
