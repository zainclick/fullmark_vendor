<?php

namespace App\Http\Controllers;

use App\Models\unites;
use App\Helpers\MainHelper;
use Illuminate\Http\Request;

class UnitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $unites =  unites::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('Name','LIKE','%'.$request->q.'%')->orWhere('Slug','LIKE','%'.$request->q.'%');
        })->orderBy('id','DESC')->paginate(10);

        return view('admin.unites.index',compact('unites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.unites.create');
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
            'slug_ar'=>"required|max:190|unique:stores,Slug",
            'slug_en'=>"required|max:190|unique:stores,Slug",

        ]);
        $unites = unites::create([
            "Name"=>['en'=>$request->name_en,'ar' =>$request->name_ar],
            "Slug"=>['en'=>$request->slug_en,'ar' =>$request->slug_ar],
            'User_Id'=>auth()->user()->id,
        ]);
     
        flash()->success(__('admin/unites/messages.create'),'عملية ناجحة');
        return redirect()->route('admin.unites.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\unites  $unites
     * @return \Illuminate\Http\Response
     */
    public function show(unites $unites)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\unites  $unites
     * @return \Illuminate\Http\Response
     */
    public function edit(unites $unite)
    {
        if(!auth()->user()->has_access_to('update',$unite))abort(403);
        return view('admin.unites.edit',compact('unite'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\unites  $unites
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, unites $unite)
    {
        $request->merge([
            'slug'=>\MainHelper::slug($request->slug)
        ]);

        $request->validate([
            'name_ar'=>"required|max:190|unique:stores,Name,".$unite->id,
            'name_en'=>"required|max:190|unique:stores,Name,".$unite->id,
            'slug_ar'=>"required|max:190|unique:stores,Slug,".$unite->id,
            'slug_en'=>"required|max:190|unique:stores,Slug,".$unite->id,

        ]);
        $unite->update([
            "Name"=>['en'=>$request->name_en,'ar' =>$request->name_ar],
            "Slug"=>['en'=>$request->slug_en,'ar' =>$request->slug_ar],
            'User_Id'=>auth()->user()->id,
        ]);
     
        flash()->success(__('admin/unites/messages.update'),'عملية ناجحة');
        return redirect()->route('admin.unites.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\unites  $unites
     * @return \Illuminate\Http\Response
     */
    public function destroy(unites $unite)
    {
        if(!auth()->user()->has_access_to('delete',$unite))abort(403);
        $unite->delete();
        flash()->success(__('admin/unites/messages.delete'));
        return redirect()->route('admin.unites.index');
    }
}
