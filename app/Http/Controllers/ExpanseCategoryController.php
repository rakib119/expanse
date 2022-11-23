<?php

namespace App\Http\Controllers;

use App\Models\ExpanseCategory;
use Illuminate\Http\Request;

class ExpanseCategoryController extends Controller
{

    public function index()
    {
        $categories = ExpanseCategory::where('company_id',auth()->id())->get();
       return view('company.expanse-category.index',compact('categories'));
    }


    public function create()
    {
        return view('company.expanse-category.create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show(ExpanseCategory $expanseCategory)
    {
        //
    }

    public function edit(ExpanseCategory $expanseCategory)
    {
        //
    }


    public function update(Request $request, ExpanseCategory $expanseCategory)
    {
        //
    }


    public function destroy(ExpanseCategory $expanseCategory)
    {
        //
    }
}
