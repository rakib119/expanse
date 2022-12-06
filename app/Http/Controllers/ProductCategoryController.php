<?php

namespace App\Http\Controllers;


use App\Models\ProductCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductCategoryController extends Controller
{

    public function index()
    {
        $categories = ProductCategory::where('company_id', auth()->id())->orderBy('id', 'desc')->get();
        return view('company.product-category.index', compact('categories'));
    }


    public function create()
    {
        return view('company.product-category.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|max:255'
        ]);
        ProductCategory::insert([
            'p_cat_name' => $request->category,
            'company_id' => auth()->id(),
            'created_by' => auth()->id(),
            'created_at' => Carbon::now()
        ]);
        return redirect()->route('category-product.index')->with('success', 'success');
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $ProductCategory = ProductCategory::find($id);
        return view('company.product-category.edit', compact('ProductCategory'));
    }


    public function update(Request $request, $id)
    {
        $ProductCategory = ProductCategory::find($id);
        if (auth()->id()  == $ProductCategory->company_id) {
            $request->validate([
                'category' => 'required|max:255'
            ]);
            $ProductCategory->p_cat_name = $request->category;
            $ProductCategory->updated_by =  auth()->id();
            $ProductCategory->save();
            return redirect()->route('category-product.index')->with('success', 'success');
        } else {
            abort(403);
        }
    }



}
