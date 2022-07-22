<?php

namespace App\Http\Controllers;

use App\Models\taxes;
use App\Helpers\MainHelper;
use Illuminate\Http\Request;

class TaxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $taxes =  taxes::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('Name','LIKE','%'.$request->q.'%')->orWhere('Slug','LIKE','%'.$request->q.'%');
        })->orderBy('id','DESC')->paginate(10);

        return view('admin.taxes.index',compact('taxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.taxes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
            'Slug'=>\MainHelper::slug($request->slug)
        ]);

        $request->validate([
            'name_ar'=>"required|max:190|unique:stores,Name",
            'name_en'=>"required|max:190|unique:stores,Name",
            'value'=>"required|numeric|between:0,99.99",
            'slug_ar'=>"required|max:190|unique:stores,Slug",
            'slug_en'=>"required|max:190|unique:stores,Slug",

        ]);
        $taxes = taxes::create([
            "Name"=>['en'=>$request->name_en,'ar' =>$request->name_ar],
            "Value" => $request->value,
            "Slug"=>['en'=>$request->slug_en,'ar' =>$request->slug_ar],
            'User_Id'=>auth()->user()->id,
        ]);
     
        flash()->success(__('admin/taxes/messages.create'),'عملية ناجحة');
        return redirect()->route('admin.taxes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\taxes  $taxes
     * @return \Illuminate\Http\Response
     */
    public function show(taxes $taxes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\taxes  $taxes
     * @return \Illuminate\Http\Response
     */
    public function edit(taxes $tax)
    {

        if(!auth()->user()->has_access_to('update',$tax))abort(403);
        return view('admin.taxes.edit',compact('tax'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\taxes  $taxes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, taxes $tax)
    {
        $request->merge([
            'Slug'=>\MainHelper::slug($request->slug)
        ]);

        $request->validate([
            'name_ar'=>"required|max:190|unique:stores,Name,".$tax->id,
            'name_en'=>"required|max:190|unique:stores,Name,".$tax->id,
            'value' => "required|numeric|between:0,99.99",
            'slug_ar'=>"required|max:190|unique:stores,Slug,".$tax->id,
            'slug_en'=>"required|max:190|unique:stores,Slug,".$tax->id,

        ]);
        $tax->update([
            "Name"=>['en'=>$request->name_en,'ar' =>$request->name_ar],
            'Value' => $request->value,
            "Slug"=>['en'=>$request->slug_en,'ar' =>$request->slug_ar],
            'User_Id'=>auth()->user()->id,
        ]);
     
        flash()->success(__('admin/taxes/messages.update'),'عملية ناجحة');
        return redirect()->route('admin.taxes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\taxes  $taxes
     * @return \Illuminate\Http\Response
     */
    public function destroy(taxes $tax)
    {
        if(!auth()->user()->has_access_to('delete',$tax))abort(403);
        $tax->delete();
        flash()->success(__('admin/taxes/messages.delete'));
        return redirect()->route('admin.taxes.index');
    }
}
