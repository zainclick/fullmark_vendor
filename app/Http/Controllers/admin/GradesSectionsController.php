<?php

namespace App\Http\Controllers\admin;
use App\Models\invoices;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\admin\gradesSections;
use App\Http\Requests\admin\GradesSectionsRequest;

class GradesSectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $grades_Sections =  gradesSections::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('Name','LIKE','%'.$request->q.'%');
        })->orderBy('id','ASC')->paginate(10);
      
        return view('admin.grades_sections.index',compact('grades_Sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.grades_sections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradesSectionsRequest $request)
    {

        $grades_Sections = new gradesSections();
        $grades_Sections->Name = ['en' => $request->name_en,'ar' => $request->name_ar];
        $grades_Sections->Status = $request->status;
        $grades_Sections->save();

        flash()->success(__('admin/messages.create'),'عملية ناجحة');
        return redirect()->route('admin.grades_sections.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\gradesSections  $gradesSections
     * @return \Illuminate\Http\Response
     */
    public function show(gradesSections $gradesSections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\gradesSections  $gradesSections
     * @return \Illuminate\Http\Response
     */
    public function edit(gradesSections $gradesSection)
    {
        if(!auth()->user()->has_access_to('update',$gradesSection))abort(403);

        return view('admin.grades_sections.edit',compact('gradesSection'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\gradesSections  $gradesSections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, gradesSections $gradesSections)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\gradesSections  $gradesSections
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $grade = gradesSections::find($id);
        if(!auth()->user()->has_access_to('delete',$grade))abort(403);

        $grade->delete();
        
        flash()->success(__('admin/messages.delete'),'عملية ناجحة');
        return redirect()->route('admin.grades_sections.index');
    }
}
