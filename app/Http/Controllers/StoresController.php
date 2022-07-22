<?php

namespace App\Http\Controllers;

use App\Models\stores;
use App\Models\unites;
use App\Models\Category;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stores =  stores::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('Name','LIKE','%'.$request->q.'%')->orWhere('Slug','LIKE','%'.$request->q.'%');
        })->orderBy('id','DESC')->paginate(10);

        return view('admin.stores.index',compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.stores.create');
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
            'name_ar'=>"required|max:190|unique:stores,Name->ar",
            'name_en'=>"required|max:190|unique:stores,Name->en",
            'slug_ar'=>"required|max:190|unique:stores,Slug",
            'slug_en'=>"required|max:190|unique:stores,Slug",

        ]);
        $category = Stores::create([
            "Name"=>['en'=>$request->name_en,'ar' =>$request->name_ar],
            "Slug"=>['en'=>$request->slug_en,'ar' =>$request->slug_ar],
            'User_Id'=>auth()->user()->id,
        ]);
     
        flash()->success(__('admin/stores/messages.create'),'عملية ناجحة');
        return redirect()->route('admin.stores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\stores  $stores
     * @return \Illuminate\Http\Response
     */
    public function show(stores $stores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\stores  $stores
     * @return \Illuminate\Http\Response
     */
    public function edit(stores $store)
    {
        if(!auth()->user()->has_access_to('update',$store))abort(403);
        return view('admin.stores.edit',compact('store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\stores  $stores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, stores $store)
    {
        $request->merge([
            'slug'=>\MainHelper::slug($request->slug)
        ]);

        $request->validate([
            'name_ar'=>"required|max:190|unique:stores,Name,".$store->id,
            'name_en'=>"required|max:190|unique:stores,Name,".$store->id,
            'slug_ar'=>"required|max:190|unique:stores,Slug,".$store->id,
            'slug_en'=>"required|max:190|unique:stores,Slug,".$store->id,

        ]);
        $store->update([
            "Name"=>['en'=>$request->name_en,'ar' =>$request->name_ar],
            "Slug"=>['en'=>$request->slug_en,'ar' =>$request->slug_ar],
            'User_Id'=>auth()->user()->id,
        ]);
     
        flash()->success(__('admin/stores/messages.update'),'عملية ناجحة');
        return redirect()->route('admin.stores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\stores  $stores
     * @return \Illuminate\Http\Response
     */
    public function destroy(stores $store)
    {
        if(!auth()->user()->has_access_to('delete',$store))abort(403);
        $store->delete();
        flash()->success(__('admin/stores/messages.delete'));
        return redirect()->route('admin.stores.index');
    }
}
