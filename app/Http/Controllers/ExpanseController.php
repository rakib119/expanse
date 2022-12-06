<?php

namespace App\Http\Controllers;

use App\Models\Expanse;
use App\Models\ExpanseCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ExpanseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expanses = Expanse::join('expanse_categories', 'expanse_categories.id', '=', 'expanses.cat_id')
            ->where('expanses.company_id', auth()->id())
            ->select('expanses.remarks', 'expanses.id', 'expanses.amount', 'expanse_categories.e_cat_name as category')
            ->orderBy('expanses.id', 'desc')
            ->get();
        return view('company.expanse.index', compact('expanses'));
    }


    public function create()
    {
        $categories =  ExpanseCategory::where('company_id', auth()->id())->orderBy('id', 'desc')->get(['e_cat_name', 'id']);
        return view('company.expanse.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'amount' => 'required|numeric',
            'remarks' => 'nullable',
        ]);
        Expanse::insert([
            'cat_id' => $request->category,
            'amount' => $request->amount,
            'remarks' => $request->remarks,
            'company_id' => auth()->id(),
            'created_by' => auth()->id(),
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('expanse.index')->with('success', 'Exapanse added successfully');
    }
 
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $expanse = Expanse::findOrFail($id);
        $categories =  ExpanseCategory::where('company_id', auth()->id())->orderBy('id', 'desc')->get(['e_cat_name', 'id']);
        return view('company.expanse.edit', compact('categories', 'expanse'));
    }


    public function update(Request $request, Expanse $expanse)
    {
        $request->validate([
            'category' => 'required',
            'amount' => 'required|numeric',
            'remarks' => 'nullable',
        ]);
        $expanse->cat_id = $request->category;
        $expanse->amount = $request->amount;
        $expanse->remarks = $request->remarks;
        $expanse->updated_by = auth()->id();
        $expanse->save();
        return redirect()->route('expanse.index')->with('success', 'Exapanse updated successfully');
    }


}
