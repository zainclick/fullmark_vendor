<?php

namespace App\Http\Controllers\admin;
use App\Models\admin\grades;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\GradesRequest;
use App\Models\admin\gradesSections;

class GradesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $grades =  grades::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('Name','LIKE','%'.$request->q.'%');
        })->orderBy('id','ASC')->paginate(10);
      
        return view('admin.grades.index',compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades_sections = gradesSections::Actives()->get();
        return view('admin.grades.create',compact('grades_sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradesRequest $request)
    {
        $grades = new grades();
        $grades->Name = ['en' => $request->name_en,'ar' => $request->name_ar];
        $grades->Grade_Section = $request->gardes_section;
        $grades->Status = $request->status;
        $grades->save();
        
        flash()->success(__('admin/messages.create'),'عملية ناجحة');
        return redirect()->route('admin.grades.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\grades  $grades
     * @return \Illuminate\Http\Response
     */
    public function show(grades $grades)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\grades  $grades
     * @return \Illuminate\Http\Response
     */
    public function edit(grades $grade)
    {
        if(!auth()->user()->has_access_to('update',$grade))abort(403);
        $grades_sections = gradesSections::Actives()->get();
        return view('admin.grades.edit',compact('grade','grades_sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\grades  $grades
     * @return \Illuminate\Http\Response
     */
    public function update(GradesRequest $request, grades $grade)
    {
        $grade->update([

            'Name' => ['en' => $request->name_en,'ar' => $request->name_ar],
            'Grade_Section' => $request->gardes_section,
            'Status' => $request->status,
        ]);

        flash()->success(__('admin/messages.update'),'عملية ناجحة');
        return redirect()->route('admin.grades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\grades  $grades
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $grade = grades::find($id);
        if(!auth()->user()->has_access_to('delete',$grade))abort(403);

        $grade->delete();
        flash()->success(__('admin/messages.delete'),'عملية ناجحة');
        return redirect()->route('admin.grades.index');
    }
}
