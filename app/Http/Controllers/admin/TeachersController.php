<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\admin\subjects;
use App\Models\admin\teachers;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\TeachersRequest;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $teachers =  teachers::with(['subject'])->where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('Name','LIKE','%'.$request->q.'%')->orWhere('Subject','LIKE','%'.$request->q.'%');
        })->orderBy('id','ASC')->paginate(10);
      
        return view('admin.teachers.index',compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = subjects::Actives()->get();
        return view('admin.teachers.create',compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeachersRequest $request)
    {
        $teacher = new teachers();
        $teacher->Name = $request->teacher;
        $teacher->Subject = $request->subject;
        $teacher->Intro = $request->intro;
        $teacher->Facebook = $request->facebook;
        $teacher->Mobile = $request->mobile;
        $teacher->Status = $request->status;
        $teacher->save();

        flash()->success(__('admin/messages.create'),'عملية ناجحة');
        return redirect()->route('admin.teachers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\teachers  $teachers
     * @return \Illuminate\Http\Response
     */
    public function show(teachers $teachers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\teachers  $teachers
     * @return \Illuminate\Http\Response
     */
    public function edit(teachers $teacher)
    {
        if(!auth()->user()->has_access_to('update',$teacher))abort(403);
        $subjects = subjects::Actives()->get();
        return view('admin.teachers.edit',compact('teacher','subjects'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\teachers  $teachers
     * @return \Illuminate\Http\Response
     */
    public function update(TeachersRequest $request, teachers $teacher)
    {
        $teacher->update([
            'Name' => $request->teacher,
            'Subject' => $request->subject,
            'Intro' => $request->intro,
            'Facebook' => $request->facebook,
            'Mobile' => $request->mobile,
            'Status' => $request->status,
        ]); 

        flash()->success(__('admin/messages.update'),'عملية ناجحة');
        return redirect()->route('admin.teachers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\teachers  $teachers
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $teacher = teachers::find($id);
        if(!auth()->user()->has_access_to('delete',$teacher))abort(403);

        $teacher->delete();
        flash()->success(__('admin/messages.delete'),'عملية ناجحة');
        return redirect()->route('admin.teachers.index');
    }
}
