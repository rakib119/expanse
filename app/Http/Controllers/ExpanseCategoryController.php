<?php

namespace App\Http\Controllers;

use App\Models\ExpanseCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ExpanseCategoryController extends Controller
{

    public function index()
    {
        $categories = ExpanseCategory::where('company_id', auth()->id())->orderBy('id', 'desc')->get();
        return view('company.expanse-category.index', compact('categories'));
    }


    public function create()
    {
        return view('company.expanse-category.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|max:255'
        ]);
        ExpanseCategory::insert([
            'e_cat_name' => $request->category,
            'company_id' => auth()->id(),
            'created_by' => auth()->id(),
            'created_at' => Carbon::now()
        ]);
        return redirect()->route('category-expanse.index')->with('success', 'success');
    }


    public function show(ExpanseCategory $expanseCategory)
    {
        //
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $expanseCategory = ExpanseCategory::find($id);
        return view('company.expanse-category.edit', compact('expanseCategory'));
    }


    public function update(Request $request, $id)
    {
        $expanseCategory = ExpanseCategory::find($id);
        if (auth()->id()  == $expanseCategory->company_id) {
            $request->validate([
                'category' => 'required|max:255'
            ]);
            $expanseCategory->e_cat_name = $request->category;
            $expanseCategory->updated_by =  auth()->id();
            $expanseCategory->save();
            return redirect()->route('category-expanse.index')->with('success', 'success');
        } else {
            abort(403);
        }
    }


     
}
