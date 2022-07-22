<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\admin\subjects;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\SubjectsRequest;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subjects =  subjects::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('Name','LIKE','%'.$request->q.'%');
        })->orderBy('id','ASC')->paginate(10);
      
        return view('admin.subjects.index',compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectsRequest $request)
    {
        $subjects = new subjects();
        $subjects->Name = ['en' => $request->name_en,'ar' => $request->name_ar];
        $subjects->Status = $request->status;
        $subjects->save();

        flash()->success(__('admin/messages.create'),'عملية ناجحة');
        return redirect()->route('admin.subjects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function show(subjects $subjects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function edit(subjects $subject)
    {
        if(!auth()->user()->has_access_to('update',$subject))abort(403);

        return view('admin.subjects.edit',compact('subject'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectsRequest $request, subjects $subject)
    {
        $subject->update([

            'Name' => ['en' => $request->name_en,'ar' => $request->name_ar],
            'Status' => $request->status,
        ]);

        flash()->success(__('admin/messages.update'),'عملية ناجحة');
        return redirect()->route('admin.subjects.index');
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $subject = subjects::find($id);
        if(!auth()->user()->has_access_to('delete',$subject))abort(403);
        $subject->delete();

        flash()->success(__('admin/messages.delete'),'عملية ناجحة');
        return redirect()->route('admin.subjects.index');
    }
}
